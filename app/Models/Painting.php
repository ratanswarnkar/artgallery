<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    //
    
    protected $fillable = [
        'title',
        'artist_id',
        'category_id',
        'gallery_id',
        'description',
        'price',
        'image',
        'status',
    ];

    // relationships (adjust class names/namespaces as needed)
    public function artist()   { return $this->belongsTo(Artist::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function gallery()  { return $this->belongsTo(Gallery::class); }
}
