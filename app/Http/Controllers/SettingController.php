<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Models\CandidatePosition;
use App\Models\City;
use App\Models\Cms;
use App\Models\ContactUs;
use App\Models\IpRestriction;
use App\Models\Source;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Twilio\Rest\Accounts\V1\Credential\UpdateAwsOptions;

class SettingController extends Controller
{
    use ImageTrait;

    // public function socialMedia()
    // {
    //     return view('settings.social-media');
    // }

    public function support()
    {
        if (Auth::user()->can('Manage Support')) {
            return view('settings.support');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function members()
    {
        if (Auth::user()->can('Manage Team')) {
            $members = User::where('role_type', '!=', 'ADMIN')->orderBy('id', 'desc')->paginate(15);
            $roles = Role::where('name', '!=', 'ADMIN')->get();
            return view('settings.members.list')->with(compact('members', 'roles'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function membersStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'phone' => 'required|numeric|digits:10',
            'role_type' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->password   = bcrypt($request->password);
        $user->phone      = $request->phone;
        $user->role_type  = $request->role_type;

        if ($request->role_type == 'VENDOR') {
            // AL-VN-00001
            $lastVendor = User::where('role_type', 'VENDOR')->orderBy('id', 'desc')->first();
            if ($lastVendor) {
                if ($lastVendor->code == null) {
                    $lastVendor->code = 'AL-VN-00000';
                }
                $lastVendorId = explode('-', $lastVendor->code);
                $vendorId = $lastVendorId[2] + 1;
                $vendorId = str_pad($vendorId, 5, '0', STR_PAD_LEFT);
                $user->code = 'AL-VN-' . $vendorId;
            } else {
                $user->code = 'AL-VN-00001';
            }
        } elseif($request->role_type == 'ASSOCIATE') {
            // AL-AS-00001
            $lastAssociate = User::where('role_type', 'ASSOCIATE')->orderBy('id', 'desc')->first();
            if ($lastAssociate) {
                if ($lastAssociate->code == null) {
                    $lastAssociate->code = 'AL-AS-00000';
                }
                $lastAssociateId = explode('-', $lastAssociate->code);
                $associateId = $lastAssociateId[2] + 1;
                $associateId = str_pad($associateId, 5, '0', STR_PAD_LEFT);
                $user->code = 'AL-AS-' . $associateId;
            } else {
                $user->code = 'AL-AS-00001';
            }
        }

        if ($request->hasFile('profile_picture')) {
            $user->profile_picture = $this->imageUpload($request->file('profile_picture'), 'profile');
        }

        $user->save();

        $user->assignRole($request->role_type);

        $maildata = [
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => Ucfirst($request->role_type),
        ];

        Mail::to($request->email)->send(new RegistrationMail($maildata));
        session()->flash('message', 'Members added successfully');
        return response()->json(['message' => 'Members added successfully', 'status' => 'success']);
    }

    public function membersDelete($id)
    {
        if (Auth::user()->can('Delete Team')) {
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('message', 'Member deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function membersStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_active = $request->status;
        $user->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function membersEdit($id)
    {
        $member = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'ADMIN')->get();
        $edit = true;
        return response()->json(['view' => view('settings.members.edit', compact('member', 'edit', 'roles'))->render(), 'status' => 'success']);
    }

    public function membersUpdate(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'role_type' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'phone' => 'required|numeric|digits:10',
            //if password is not null then confirm password is required
            'confirm_password' => $request->password ? 'required|same:password' : 'nullable',
        ]);

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;
        $user->role_type  = $request->role_type;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                $currentImageFilename = $user->profile_picture; // get current image name
                Storage::delete('app/' . $currentImageFilename);
            }
            $user->profile_picture = $this->imageUpload($request->file('profile_picture'), 'profile');
        }

        $user->save();

        $user->syncRoles($request->role_type);
        session()->flash('message', 'Members updated successfully');
        return response()->json(['message' => 'Members updated successfully']);
    }

    public function memberFilter(Request $request)
    {
        $members = User::query();
        if ($request->search) {
            $members->whereRaw("CONCAT(first_name, ' ', last_name) LIKE '%" . $request->search . "%'")
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
        }
        $members = $members->orderBy('id', 'desc')->where('role_type', '!=', 'ADMIN')->paginate(15);
        return response()->json(['view' => view('settings.members.filter', compact('members'))->render()]);
    }

    public function userAccess()
    {
        if (Auth::user()->can('Manage User Access')) {
            $roles = Role::where('name', '!=', 'ADMIN')->get();
            $permissions = Permission::all()->pluck('name', 'id')->toArray();
            return view('settings.user-access.list')->with(compact('roles', 'permissions'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function userAccessStore(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);

        $name             = $request['role_name'];
        $role             = new Role();
        $role->name       = $name;
        $permissions      = $request['permissions'];
        $role->save();

        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role = Role::where('name', '=', $name)->first();
                $role->givePermissionTo($p);
            }
        }
        session()->flash('message', 'User access added successfully');
        return response()->json(['message' => 'User access added successfully', 'status' => 'success']);
    }

    public function userAccessEdit($id)
    {
        if (Auth::user()->can('Edit User Access')) {
            $role = Role::findOrFail($id);
            $user = Auth::user();
            $permissions = new Collection();
            foreach ($user->roles as $role1) {
                $permissions = $permissions->merge($role1->permissions);
            }
            $permissions = $permissions->pluck('name', 'id')->toArray();
            $edit = true;
            // return $role->permissions;
            return response()->json(['view' => view('settings.user-access.edit', compact('user', 'edit', 'role', 'permissions'))->render(), 'status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => __('Permission denied.')]);
        }
    }

    public function userAccessUpdate(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'role_name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required'
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->role_name;
        $permissions = $request['permissions'];
        $role->save();

        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }

        session()->flash('message', 'User access updated successfully');
        return response()->json(['message' => 'User access updated successfully']);
    }

    public function userAccessDelete($id)
    {
        if (Auth::user()->can('Delete User Access')) {
            $id = Crypt::decrypt($id);
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->back()->with('message', 'User access deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function positions()
    {
        if (Auth::user()->can('Manage Position')) {
            $positions = CandidatePosition::orderBy('id', 'desc')->paginate(15);
            return view('settings.positions.list')->with(compact('positions'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function positionsFilter(Request $request)
    {
        $positions = CandidatePosition::query();
        if ($request->search) {
            $positions->where('name', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->status != null) {
            $positions->where('is_active', $request->status);
        }

        $positions = $positions->orderBy('id', 'desc')->paginate(15);



        return response()->json(['view' => view('settings.positions.filter', compact('positions'))->render()]);
    }

    public function positionsStore(Request $requset)
    {
        $requset->validate([
            'position_name' => 'required|unique:candidate_positions,name',
            'position_status' => 'required|in:1,0'
        ]);

        $position = new CandidatePosition();
        $position->user_id = Auth::user()->id;
        $position->name = $requset->position_name;
        $position->is_active = $requset->position_status;
        $position->save();
        session()->flash('message', 'Position added successfully');
        return response()->json(['message' => 'Position added successfully', 'status' => 'success']);
    }

    public function positionsEdit($id)
    {
        $position = CandidatePosition::findOrFail($id);
        $edit = true;
        return response()->json(['view' => view('settings.positions.edit', compact('position', 'edit'))->render(), 'status' => 'success']);
    }

    public function positionsUpdate(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'position_name' => 'required',
            'position_status' => 'required|in:1,0'
        ]);

        $position = CandidatePosition::findOrFail($id);
        $position->user_id = Auth::user()->id;
        $position->name = $request->position_name;
        $position->is_active = $request->position_status;
        $position->update();
        return response()->json(['view' => view('settings.positions.position-action', compact('position'))->render(), 'status' => 'success', 'id' => $id]);
    }

    public function positionsDelete($id)
    {
        if (Auth::user()->can('Delete Position')) {
            $id = Crypt::decrypt($id);
            $position = CandidatePosition::findOrFail($id);
            $position->delete();
            return redirect()->back()->with('message', 'Position deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function contactUs()
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $contactUs = ContactUs::orderBy('id', 'desc')->paginate(15);
            return view('settings.contact-us.list')->with(compact('contactUs'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function contactUsFilter(Request $request)
    {
        if ($request->ajax()) {
            $contactUs = ContactUs::query();
            if ($request->search) {
                $contactUs->whereRaw("CONCAT(first_name, ' ', last_name) LIKE '%" . $request->search . "%'")
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
            }
            $contactUs = $contactUs->orderBy('id', 'desc')->paginate(15);
            return response()->json(['view' => view('settings.contact-us.filter', compact('contactUs'))->render()]);
        }
    }

    public function cms()
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $cms =  Cms::orderBy('id', 'desc')->paginate(15);
            return view('settings.cms.list')->with(compact('cms'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function cmsFilter(Request $request)
    {
        $cms = Cms::query();
        if ($request->search) {
            $cms->where('page_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('slug', 'LIKE', '%' . $request->search . '%');
        }
        $cms = $cms->orderBy('id', 'desc')->paginate(15);

        return response()->json(['view' => view('settings.cms.filter', compact('cms'))->render()]);
    }

    public function cmsDelete($id)
    {
        if (Auth::user()->hasRole('ADMIN')) {
            Cms::find($id)->delete();
            return redirect()->back()->with('error', 'Page has been deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function cmsStore(Request $request)
    {
        $request->validate([
            'page_name' => 'required|unique:cms',
            'slug' => 'required|unique:cms',
            'content' => 'required',
            'title' => 'required',
            'is_active' => 'required',
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $cms = new Cms();
            $cms->create($request->all());
            session()->flash('message', 'Page added successfully');
            return response()->json(['message' => 'Page added successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }

    public function cmsEdit($id)
    {
        $cms = Cms::findOrFail($id);
        $edit = true;
        return response()->json(['view' => view('settings.cms.edit', compact('cms', 'edit'))->render(), 'status' => 'success']);
    }

    public function cmsUpdate(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $request->validate([
            'page_name' => 'required|unique:cms,page_name,' . $id,
            'slug' => 'required|unique:cms,slug,' . $id,
            'content' => 'required',
            'title' => 'required',
            'is_active' => 'required',
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $cms = Cms::find($id);
            $cms->update($request->all());
            session()->flash('message', 'Page updated successfully');
            return response()->json(['message' => 'Page updated successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }

    public function sources()
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $sources =  Source::orderBy('id', 'desc')->paginate(15);
            return view('settings.sources.list')->with(compact('sources'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function sourcesFilter(Request $request)
    {
        $sources = Source::query();
        if ($request->search) {
            $sources->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $sources = $sources->orderBy('id', 'desc')->paginate(15);

        return response()->json(['view' => view('settings.sources.filter', compact('sources'))->render()]);
    }

    public function sourcesDelete($id)
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $id = Crypt::decrypt($id);
            $source = Source::findOrFail($id);
            $source->delete();
            return redirect()->back()->with('message', 'Source deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function sourcesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sources',
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $source = new Source();
            $source->create($request->all());
            session()->flash('message', 'Source added successfully');
            return response()->json(['message' => 'Source added successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }


    public function sourcesEdit($id)
    {
        $source = Source::findOrFail($id);
        $edit = true;
        return response()->json(['view' => view('settings.sources.edit', compact('source', 'edit'))->render(), 'status' => 'success']);
    }

    public function sourcesUpdate(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $request->validate([
            'name' => 'required|unique:sources,name,' . $id,
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $source = Source::find($id);
            $source->update($request->all());
            session()->flash('message', 'Source updated successfully');
            return response()->json(['message' => 'Source updated successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }

    public function cities()
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $cities =  City::orderBy('id', 'desc')->paginate(20);
            return view('settings.cities.list')->with(compact('cities'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function citiesFilter(Request $request)
    {
        $cities = City::query();
        if ($request->search) {
            $cities->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $cities = $cities->orderBy('id', 'desc')->paginate(20);

        return response()->json(['view' => view('settings.cities.filter', compact('cities'))->render()]);
    }

    public function citiesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities',
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $city = new City();
            $city->create($request->all());
            session()->flash('message', 'City added successfully');
            return response()->json(['message' => 'City added successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }

    public function citiesEdit($id)
    {
        $city = City::findOrFail($id);
        $edit = true;
        return response()->json(['view' => view('settings.cities.edit', compact('city', 'edit'))->render(), 'status' => 'success']);
    }

    public function citiesUpdate(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $request->validate([
            'name' => 'required|unique:cities,name,' . $id,
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $city = City::find($id);
            $city->update($request->all());
            session()->flash('message', 'City updated successfully');
            return response()->json(['message' => 'City updated successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }


    public function citiesDelete($id)
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $id = Crypt::decrypt($id);
            $city = City::findOrFail($id);
            $city->delete();
            return redirect()->back()->with('message', 'City deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function ipRestrictions()
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $ipRestrictions =  IpRestriction::orderBy('id', 'desc')->paginate(20);
            return view('settings.ip-restrictions.list')->with(compact('ipRestrictions'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function ipRestrictionsFilter(Request $request)
    {
        $ipRestrictions = IpRestriction::query();
        if ($request->search) {
            $ipRestrictions->where('ip_address', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->status != null) {
            $ipRestrictions->where('is_active', $request->status);
        }
        $ipRestrictions = $ipRestrictions->orderBy('id', 'desc')->paginate(20);

        return response()->json(['view' => view('settings.ip-restrictions.filter', compact('ipRestrictions'))->render()]);
    }

    public function ipRestrictionsStore(Request $request)
    {
        $request->validate([
            'ip_address' => 'required|unique:ip_restrictions',
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $ipRestriction = new IpRestriction();
            $ipRestriction->create($request->all());
            session()->flash('message', 'IP Restriction added successfully');
            return response()->json(['message' => 'IP Restriction added successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }

    public function ipRestrictionsEdit($id)
    {
        $ipRestriction = IpRestriction::findOrFail($id);
        $edit = true;
        return response()->json(['view' => view('settings.ip-restrictions.edit', compact('ipRestriction', 'edit'))->render(), 'status' => 'success']);
    }

    public function ipRestrictionsUpdate(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $request->validate([
            'ip_address' => 'required|unique:ip_restrictions,ip_address,' . $id,
        ]);

        if (Auth::user()->hasRole('ADMIN')) {
            $ipRestriction = IpRestriction::find($id);
            $ipRestriction->update($request->all());
            session()->flash('message', 'IP Restriction updated successfully');
            return response()->json(['message' => 'IP Restriction updated successfully', 'status' => 'success']);
        } else {
            return response()->json(['error' => 'Permission denied', 'status' => 'error']);
        }
    }


    public function ipRestrictionsDelete($id)
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $id = Crypt::decrypt($id);
            $ipRestriction = IpRestriction::findOrFail($id);
            $ipRestriction->delete();
            return redirect()->back()->with('message', 'IP Restriction deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

}

