<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
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
            $members = User::where('role_type', '!=', 'ADMIN')->orderBy('id','desc')->paginate(15);
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'role_type' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->password   = bcrypt($request->password);
        $user->phone      = $request->phone;
        $user->role_type  = $request->role_type;
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
        if (Auth::user()->can('Delete Members')) {
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('message', 'Member deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
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
            //if password is not null then confirm password is required
            'confirm_password' => $request->password ? 'required|same:password' : 'nullable',
        ]);

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
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
        // return $request->all();
        $members = User::query();
        if ($request->search) {
            $members->whereRaw("CONCAT(first_name, ' ', last_name) LIKE '%" . $request->search . "%'")
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
        }
        $members = $members->orderBy('id','desc')->where('role_type', '!=', 'ADMIN')->paginate(15);
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
}
