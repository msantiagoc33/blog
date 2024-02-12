<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Relacion muchos a muchos.  Un tag puede pertenecer a muchos posts
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
