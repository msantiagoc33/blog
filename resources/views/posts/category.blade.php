<x-app-layout>
    <div class="max-w-xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
        <h1 class="text-center text-2xl font-bold mb-4">Miembro: <span class="text-weight-bold"><em>{{ $category->name }}</em></span></h1>
        @foreach ($posts as $post)
            <x-card-post :post='$post' />
        @endforeach

        <div>
            {{$posts->links()}}
        </div> 
    </div>
</x-app-layout>