<?php

namespace App\Http\Controllers\UserAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user_admin.dashboard');
    }
}
