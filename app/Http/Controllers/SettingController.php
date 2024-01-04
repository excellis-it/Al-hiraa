<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationMail;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    use ImageTrait;

    public function socialMedia()
    {
        return view('settings.social-media');
    }

    public function support()
    {
        return view('settings.support');
    }

    public function members()
    {
        $members = User::where('role_type','!=', 'ADMIN')->paginate(15);
        $roles = Role::where('name','!=', 'ADMIN')->get();
        return view('settings.members.list')->with(compact('members','roles'));
    }

    public function membersStore(Request $request)
    {
        // return $request->all();
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
            'name' => $user->first_name.' '.$user->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => Ucfirst($request->role_type),
        ];

        Mail::to($request->email)->send(new RegistrationMail($maildata));

        return response()->json(['message' => 'Members added successfully']);
    }

    public function membersDelete($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('message','Member deleted successfully');
    }
}
