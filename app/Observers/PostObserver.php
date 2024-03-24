<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Los observes, para que funcionen hay que registrarlos.
     * Se registran en el método boot() de App\Providers\EventServiceProvider
     * Post::observe(PostObserver::class);
     * En ese archivo hay que importar el modelo y el observer
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
        // Si el método se llamará deleted(), se ejecutaría despues de eliminado el post
        // Llamándose deleting(), se ejecutará justo antes de eliminarse el post
        // En este caso va a eliminar la imagen asociada antes de borrar el post.

        // Si exise una imagen en este post entonces que se elimine.
        if ($post->image) {
            Storage::delete($post->image->url);
        }
    }
}
