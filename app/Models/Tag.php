<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Esta función se utiliza para que en la url salga el slug en lugar del numero id del registro
     */
    public function getRouteKeyName(){
        return 'slug';
    }

    protected $fillable = [
        'name', 'slug', 'color'
    ];
    // Relacion muchos a muchos.  Un tag puede pertenecer a muchos posts
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
