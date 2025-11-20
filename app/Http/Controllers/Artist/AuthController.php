<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('artist.auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('artist')->attempt($request->only('email','password'))) {
            return redirect()->route('artist.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid login details']);
    }

    public function logout()
    {
        Auth::guard('artist')->logout();
        return redirect()->route('artist.login');
    }
}
