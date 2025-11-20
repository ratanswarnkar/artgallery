<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable;

    // explicit table name (keeps things safe)
    protected $table = 'admin_users';

    // fillable fields
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'status',
    ];

    // hide sensitive fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // cast types (optional)
    protected $casts = [
        // 'status' => 'boolean',
    ];
}
