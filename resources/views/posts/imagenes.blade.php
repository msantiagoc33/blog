<x-app-layout>
    <div class="container mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($imagenes as $imagen)
                <div class="w-full md:max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ asset('storage/' . $imagen->url) }}" alt="{{ $imagen->nombre }}">
                    {{-- <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $imagen->nombre }}</div>
                    </div> --}}
                </div>
            @endforeach
            <div>
                {{$imagenes->links()}}
            </div>
        </div>
    </div>

</x-app-layout>
