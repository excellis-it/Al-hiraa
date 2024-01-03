<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return back()->with('error','Your account is not active. Please contact admin.');
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
}
