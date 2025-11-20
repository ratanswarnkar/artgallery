<?php

namespace App\Http\Controllers\UserAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('user_admin.auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('user_admin')->attempt($request->only('email','password'))) {
            return redirect()->route('user_admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('user_admin')->logout();
        return redirect()->route('user_admin.login');
    }
}
