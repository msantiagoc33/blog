<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    
    public function author(User $user, Post $post)
    {
        // si el id del usuario es igual al id del usuario registrado devolvera true.
        if ($user->id == $post->user_id) {
            return true;
        } else {
            return false;
        }
    }

    public function published(?User $user, Post $post)
    {
        if ($post->status == 2) {
            return true;
        }else{
            return false;
        }
    }
}
