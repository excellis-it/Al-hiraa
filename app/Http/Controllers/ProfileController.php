<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use ImageTrait;

    public function profile()
    {
        if (Auth::user()->can('Manage Profile')) {
            return view('profile');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function changePassword()
    {
        return view('change-password');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'phone' => 'nullable|numeric',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'account' => 'nullable',
            'role_type' => 'nullable',
            'timezone' => 'nullable',
            'currency' => 'nullable',
            'application_language' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone  = $request->phone;
        $user->city  = $request->city;
        $user->state  = $request->state;
        $user->country  = $request->country;
        $user->account  = $request->account;
        $user->timezone  = $request->timezone;
        $user->currency  = $request->currency;
        $user->application_language  = $request->application_language;
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                $currentImageFilename = $user->profile_picture; // get current image name
                Storage::delete('app/'.$currentImageFilename);
            }
            $user->profile_picture = $this->imageUpload($request->file('profile_picture'), 'profile');
        }
        $user->save();

        return redirect()->back()->with('message','Profile updated successfully');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8|password:' . Auth::user()->password,
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|min:8|same:new_password',

        ],[
            'old_password.password'=> 'Old password is not correct',
        ]);

        $data = User::find(Auth::user()->id);
        $data->password = Hash::make($request->new_password);
        $data->update();
        return redirect()->back()->with('message', 'Password updated successfully.');
    }
}
