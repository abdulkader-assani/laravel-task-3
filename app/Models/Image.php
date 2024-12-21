<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Image extends Model
{
    public $fillable = [
        'post_id',
        'image'
    ];

    public function posts(){
        return $this->belongsTo(Post::class);
    }
}
