<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin'; // optional, if you use guard
    protected $fillable = ['name','email','password','status'];

    protected $hidden = ['password'];
}
