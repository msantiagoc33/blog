<x-app-layout>
    <div class="container py-8 mx-auto">
        <h1 class="text-4xl font-bold text-gray-600">{{ $post->name }}</h1>
        <div class="text-lg text-gray-500 mb-2">
            {!! $post->extract !!}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Contenido principal  --}}
            <div class="lg:grid-cols-2">
                <figure>
                    @if ($post->image)
                        <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($post->image->url) }}"
                            alt="">
                    @else
                        <img class="w-full h-70 object-cover object-center" src="/riders/LOGO_RAIDERS.PNG" alt="">
                    @endif
                </figure>

                <div class="text-base text-gray-500 mt-4">
                    {!! $post->body !!}
                </div>
            </div>
            {{-- Contenido relacionado --}}
            <aside>
                <h1 class="text-2xl font-bold text-gray-500 mb-4">Más en <span
                        class="italic">{{ $post->category->name }}</span></h1>
                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-4">
                            <a class="flex" href="{{ route('posts.show', $similar) }}">
                                @if ($similar->image)
                                    <img class="w-36 h-20 object-cover object-center"
                                        src="{{ Storage::url($similar->image->url) }}" alt="">
                                @else
                                    <img class="w-full h-20 object-cover object-center" src="/riders/LOGO_RAIDERS.PNG"
                                        alt="">
                                @endif

                                <span class="ml-2 text-gray-600">{{ $similar->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>
</x-app-layout>
