<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; 

    protected $fillable = ['name', 'slug'];

    /**
     * Esta función se utiliza para que en la url salga el slug en lugar del numero id del registro
     */
    public function getRouteKeyName(){
        return 'slug';
    }
        /**
     * Relacion uno a muchos
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
