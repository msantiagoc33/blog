<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

   protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Relacion uno a muchos inversa
     * Establecemos las relacion que tiene el post con user y category
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación de muchos a muchos, un post tiene muchos tags y un tabs pertenece a muchos posts
     */
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Relación uno a uno polimórfica
    */    
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

     /**
     * Relacion uno a muchos inversa
     * Establecemos las relacion que tiene el post con comentarios
     */
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
 