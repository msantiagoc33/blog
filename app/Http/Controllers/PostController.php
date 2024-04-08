<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Image;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\NuevoCommentCorreo;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 2)->latest('id')->paginate(8);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // esta autorización que está en PostPilicy restringe la vista de los post que no estan publicados.
        $this->authorize('published', $post);

        // sellecciona todos los post del mismo usuario 
        $similares = Post::where('category_id', $post->category_id)
            ->where('status', 2)
            ->where('id', '!=', $post->id)
            ->latest('id')
            ->get();

        // Obtener todos los comentarios asociados al post
        $comentarios = Comment::where('post_id', $post->id)
            ->latest('id')
            ->get();
           
        $users = User::all(); // Obtener el usuario autenticado

        return view('posts.show', compact('post', 'similares', 'comentarios', 'users'));
    }

    public function storeComment(Request $request, Post $post)
    {
        // Validar los datos del comentario
        $request->validate([
            'comentario' => 'required|string|max:255',
        ]);
       
        // Crear el comentario asociado al post
        $post->comments()->create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'body' => strip_tags($request->comentario),
        ]);

        /** 
         * Enviar un correo a todos los riders informando de que se ha creado un nuevo comentario
         * **************************************************************************************
         */

         $nombreUsuario = Auth::user()->name;

         $nombreUsuario_mensaje = $nombreUsuario . ' ha COMENTADO el POST llamado ' . $post->name;
 
         $mailComentario = [
             'from' => $nombreUsuario_mensaje,
             'title' => 'Correo del blog de los Riders'
         ];
 
         $users = User::all();
 
         foreach ($users as $usuario) {
             Mail::to($usuario->email)->queue(new NuevoCommentCorreo($mailComentario));
         }

        return back()->with('success', 'Tu comentario ha sido publicado e informado a todos los riders por correo.');
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->where('status', 2)
            ->latest('id')
            ->paginate(4);

        return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag)
    {
        $posts =  $tag->posts()->where('status', 2)->latest('id')->paginate(4);
        return view('posts.tag', compact('posts', 'tag'));
    }

    public function imagenes()
    {
        $imagenes = Image::paginate(10);

        return view('posts.imagenes', compact('imagenes'));
    }
}
