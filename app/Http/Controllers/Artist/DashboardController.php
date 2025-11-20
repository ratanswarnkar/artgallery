<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('artist.dashboard');
    }
}
