<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        // return $categories;
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        /**
         * Como el envío de imágenes no es obligatorio, compruebo si se ha enviado
         * una imagen para proceder a su grabación y ademas de mover la imagen a su ubicación
         * definitiva, tengo que relacionar la imagen con el post que acabo de crear.
         * La relación de la imagen con el post es una relación polimórfica que hicimos
         * en el modelo Post ($this->morphOne(Image::class, 'imageable'))
         */
        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            // Crea un registro en la table images y le añade el id del post y del modelo de este post
            $post->image()->create(['url' => $url]);
        }
        /**
         * Si estamos enviando información de etiquetas, tambien tenemos que añadir
         * las mismas a la tabla post_tag, asi que comprobamos si hay tags y entonces
         * llamamos a la relación que tiene posts con tags() y el método attach para 
         * incluir los valores de las etiquetas.
         * Finalmente llamamos al formulario de editar post con los valores que hemos creado
         */
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post);
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
        // comprueba con PostPolicy si el usuario puede editar este post.
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
        // comprueba con PostPolicy si el usuario puede actualizar este post.
        $this->authorize('author', $post);

        $post->update($request->all());

        // Si he añadido una imágen...
        if ($request->file('file')) {
            // Grabo la url de la imagen en esta variable
            $url = Storage::put('posts', $request->file('file'));

            // Si hay una imagen previa...
            if ($post->image) {
                // La borro
                Storage::delete($post->image->url);
                // Y luego actualizo el campo url con la url de la imagen nueva
                $post->image->update(['url' => $url]);
                // Si no había imagen previa...    
            } else {
                // Grabo la url de la imagen
                $post->image()->create(['url' => $url]);
            }
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se ha actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // comprueba con PostPolicy si el usuario puede eliminar este post.
        $this->authorize('author', $post);

        $post->delete();
        return redirect()->route('admin.posts.index', $post)->with('info', 'El post se ha eliminado.');
    }
}
