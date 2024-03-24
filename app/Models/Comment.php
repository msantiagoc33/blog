<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body','user_id'];

    /**
    * Relacion uno a muchos
    */
   public function posts(){
       return $this->belongsTo(Post::class);
   }

       // Relación uno a muchos con el modelo Comment
       public function user()
       {
           return $this->belongsTo(User::class);
       }
}
