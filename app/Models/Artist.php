<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artist extends Model
{
    protected $fillable = [
    'name',
    'username',
    'slug',
    'email',
    'phone',
    'bio',
    'photo',
    'status',
];


    // Auto-set slug on creating
    protected static function booted()
    {
        static::creating(function ($artist) {
            if (empty($artist->slug)) {
                $artist->slug = Str::slug($artist->name) . '-' . Str::random(6);
            }
        });
    }

    public function isBlocked()
    {
        return $this->status === 'blocked';
    }
}
