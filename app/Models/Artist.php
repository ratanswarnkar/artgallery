<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Artist extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'artists';

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'photo',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        // 'status' => 'boolean',
    ];
}
