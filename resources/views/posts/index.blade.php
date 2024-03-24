<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <article class="w-full h-40 bg-cover bg-center ml-3 @if($loop->first) md:col-span-2 @endif"
                    style="background-image: url({{ $post->image ? asset('storage/' . $post->image->url) : asset('/riders/LOGO_RAIDERS.PNG') }})">

                    <div class="w-full h-full px-8 flex flex-col justify-center">
                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{route('posts.tag', $tag)}}" 
                                    class="mb-2 inline-block px-3 h-6 bg-gray-500 text-gray rounded-full">{{ $tag->name}}
                                </a>
                            @endforeach
                        </div>
                        <h1 class="text-4xl leading-8 font-bold text-blue-500">
                            <a href="{{route('posts.show', $post)}}">{{ $post->name}}</a>
                        </h1>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>