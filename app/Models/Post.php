<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Post extends Model
{
    public $fillable = [
        'title',
        'description',
        'cover'
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }
}
