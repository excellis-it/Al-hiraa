<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginCheck(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'], // 'exists:users,email
            'password' => ['required'],
        ]);
        if (auth()->attempt($credentials)) {
            if (auth()->user()->is_active == 1) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            } else {
                auth()->logout();
                return back()->with('error', 'Your account is not active. Please contact admin.');
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgetPasswordShow()
    {
        return view('auth.forgot-password');
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
        ]);
        // return $validator->errors();
        $count = User::where('email', $request->email)->count();
        if ($count > 0) {
            $user = User::where('email', $request->email)->first();
            PasswordReset::where('email', $request->email)->delete();
            $id = Crypt::encrypt($user->id);
            $token = Str::random(20) . 'pass' . $user->id;
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $details = [
                'id' => $id,
                'token' => $token
            ];

            Mail::to($request->email)->send(new SendCodeResetPassword($details));
            return redirect()->back()->with('message', "Please! check your mail to reset your password.");
        } else {
            return redirect()->back()->with('error', "Couldn't find your account!");
        }
    }

    public function resetPassword($id, $token)
    {
        // return "dfs";
        $user = User::findOrFail(Crypt::decrypt($id));
        $resetPassword = PasswordReset::where('email', $user->email)->first();
        $newTime = Carbon::parse($resetPassword->created_at)->addMinutes(60)->format('h:i A');

        if ($newTime > date('h:i A')) {

            $id = $id;
            return view('auth.reset-password')->with(compact('id'));
        } else {
            abort(404);
        }
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);
        
        try {
            if ($request->id != '') {
                $id = Crypt::decrypt($request->id);
                User::where('id', $id)->update(['password' => bcrypt($request->password)]);
                $now_time = Carbon::now()->toDateTimeString();
                return redirect()->route('login')->with('message', 'Password has been changed successfully.');
            } else {
                abort(404);
            }
        }
        catch (\Throwable $th) {
            return redirect()->route('login')->with('message', 'Something went wrong.');
        }

    }
}
