<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        // Esto hará que cada vez que se cree un  nuevo post se asigne 
        // a la variable user_id el id del usuario autenticado.
        // Y así evitar mandar el id desde el formulario
        // El if es para que no corra este comando si estamos creando un
        // post desde la consola pues daría un error al no existir $post.
        if (! \App::runningConsoleCommand()) {
            $post->user_id = auth()->user()->id;
        }
    }


    public function deleting(Post $post): void
    {
        // Si exise una imagen es este post entonces que se elimine.
        if($post->image){
            Storage::delete($post->image->url);
        }
    }

}