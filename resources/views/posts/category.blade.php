<x-app-layout>
    <div class="max-w-xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
        <h1 class="uppercase text-center text-4xl font-bold mb-4">Categoria: {{$category->name}}</h1>
        @foreach ($posts as $post)
            <x-card-post :post='$post' />
        @endforeach

        <div>
            {{$posts->links()}}
        </div> 
    </div>
</x-app-layout>