<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('user_admin')->check()) {
            return redirect()->route('user_admin.login');
        }

        return $next($request);
    }
}
