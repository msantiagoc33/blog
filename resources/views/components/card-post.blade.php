@props(['post']) {{--  Para recibir la variable --}}
<article class="mb-4 bg-white shadow rounded-lg overflow-hidden">
    
    @if($post->image)
        <img class="w-full h-40 object-cover object-center" src={{Storage::url($post->image->url)}} alt="">
    @else
        <img class="w-full h-70 object-cover object-center" src="/riders/LOGO_RAIDERS.PNG" alt="">
    @endif

    <div class="px-6 py-2">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{route('posts.show', $post)}}">{{$post->name}}</a>
        </h1>
        <div class="text-gray-700 text-base">
            {!!$post->extract!!}
        </div>
    </div>

    <div class="px-6 pt-4 pb-2 mb-2">
        @foreach ($post->tags as $tag)
        <a href="{{route('posts.tag', $tag)}}" class="bg-gray-200 mr-2 inline-black  rounded-full px-3 py-1 text-sm text-gray-700">
            {{$tag->name}}</a>
        @endforeach
    </div>
</article> 