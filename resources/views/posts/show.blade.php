<x-app-layout>
    <div class="container py-8 px-8 mx-auto">
        <h1 class="text-4xl font-bold text-blue-600">{{ $post->name }}</h1>

        <div class="text-lg text-gray-500 mb-2">
            {!! $post->extract !!}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Contenido principal ----------------------------------------------------------------------- --}}
            <div class="lg:grid-cols-2">
                <figure>
                    @if ($post->image)
                        <img class="w-full object-cover object-center rounded"
                            src="{{ $post->image ? asset('storage/' . $post->image->url) : asset('/riders/LOGO_RAIDERS.PNG') }}">
                    @else
                        <img class="w-full object-cover object-center rounded" src='/riders/LOGO_RAIDERS.PNG'
                            alt="">
                    @endif
                </figure>

                <div class="text-base text-gray-500 mt-4">
                    {!! $post->body !!}
                </div>

                {{-- Mostrar los comentarios existentes --}}
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                        <div class="flex items-center mb-2">
                            
                            <div class="ml-4">
                                @foreach ($comentarios as $comentario)
                                
                                    @foreach ($users as $user)                                  
                                        @if ($user->id == $comentario->user_id)                                      
                                            <p class="text-blue-500">Publicado por: {{ $user->name }}</p>
                                            <p class="text-gray-700 border border-gray-900 px-3 py-2 bg-gray-200">
                                                {{ $comentario->body }}</p>                                           
                                        @endif
                                    @endforeach                                   
                                @endforeach
                            </div>
                        </div>
                    </div>

                {{-- Formulario para agregar un nuevo comentario --}}
                <form method="POST" action="{{ route('posts.storeComment', $post) }}">
                    @csrf
                    <div class="card-body mt-3">
                        <label class="font-bold" for="body">Escribe tu comentario:</label>
                        <textarea name="body" id="body" rows="3"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                        @error('body')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-sm text-sm"
                        type="submit">Enviar comentario</button>
                </form>

            </div>

            {{-- Contenido relacionado --}}
            <aside>

                <h1 class="text-2xl font-bold text-gray-500 mb-4">Más posts de el
                    <span class="italic text-blue-400">{{ $post->category->name }}
                    </span>
                </h1>

                <ul class="grid grid-cols-3 gap-3">
                    @foreach ($similares as $similar)
                        <li class="mb-4 relative">
                            <a class="flex" href="{{ route('posts.show', $similar) }}">
                                @if ($similar->image)
                                    <img class="" src="{{ asset('storage/' . $similar->image->url) }}">
                                @else
                                    <img class="w-full object-cover object-center" src='/riders/LOGO_RAIDERS.PNG'>
                                @endif
                                <div class="absolute inset-2">
                                    <span
                                        class="bg-black bg-opacity-50 text-white px-1 py-1">{{ $similar->name }}</span>
                                </div>

                            </a>
                        </li>
                    @endforeach
                </ul>

            </aside>

        </div>
    </div>
</x-app-layout>
