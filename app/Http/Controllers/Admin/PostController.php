<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\NuevoPostCorreo;

use App\Http\Requests\PostRequest;
use App\Models\Image;

class PostController extends Controller
{

    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * El método pluck crear un array sólo con los campos, 'name',  que introduzco como parámetros del objeto.
         * Pero necesito un formato de clave-valor para poderlo utilizar en Collectio, para ello agrego
         * otro parámetro que será la llave del valor, en este caso el 'id'
         */
        $categories = Category::pluck('name', 'id');

        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    { 

        $post = Post::create($request->all());

        if($request->file('file')){
            $url =  Storage::put('posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }
        /**
         * Si estamos enviando información de etiquetas, tambien tenemos que añadir
         * las mismas a la tabla post_tag, asi que comprobamos si hay tags y entonces
         * llamamos a la relación que tiene posts con tags() y el método attach para 
         * incluir los valores de las etiquetas.
         * Finalmente llamamos al formulario de editar post con los valores que hemos creado
         */
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        /** 
         * Enviar un correo a todos los riders informando de que se ha creado un nuevo post
         */
        
        $nombreUsuario = Auth::user()->name;
      
        $nombreUsuario_mensaje = $nombreUsuario.' ha creado un nuevo post en el blog.';

        $extracto = $request->extract;

        $extracto = strip_tags($extracto);  // Le quita el código html al texto

        $mailData = [
            'from' => $nombreUsuario_mensaje,
            'title' => 'Correo del blog de los Riders',
            'body' => $extracto,
        ];

        $users = User::all();

        foreach ($users as $usuario) {
            Mail::to($usuario->email)->queue(new NuevoPostCorreo($mailData));
        }
        
        return redirect()->route('admin.posts.index', $post)->with('Se ha enviado un correo a todos los riders informando del nuevo post.');
    }

    public function storeImage(PostRequest $request)
    { 
        if($request->file('file')){
            $url =  Storage::put('posts', $request->file('file'));
           File::create([
                'url' => $url
           ]);
        }

        $images = Image::all();

        return redirect()->route('admin.images.index', compact('images'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('author', $post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author', $post);

        $post->update($request->all());

        if($request->file('file')){
            $url = Storage::put('posts', $request->file('file'));

            // Si ya había una imagen anterior, la eliminamos
            if($post->image){
                Storage::delete($post->image->url);

                // Y ahora registramos la nueva imagen
                $post->image->update([
                    'url' => $url
                ]);
            // Si no había imagen previa, grabamos la imagen   
            // Grabamos en la tabla images la url de la imagen y 
            // de $post tomamos el id que se graba en el campo  imageable_id
            // de la tabla images
            }else{
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }
        
        if($request->tags){
            $post->tags()->sync($request->tags); 
        }

        return redirect()->route('admin.posts.index')->with('info', 'Post actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // elimina si es una usuario autorizado. Se puede ver en el fichero PostPolicy.php de Policies
        $this->authorize('author', $post);

        // Elimino el registro de la tabla images
        if($post->image){
            $post->image->delete();
        }

        $post->delete();

        return redirect()->route('admin.posts.index', $post)->with('info', 'Post eliminado');
    }
}
