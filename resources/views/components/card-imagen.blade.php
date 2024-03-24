@props(['imagen']) {{--  Para recibir la variable --}}
<article class="mb-4 bg-white shadow rounded-lg overflow-hidden">
    <img class="card-img-top" src="{{ asset('storage/' . $imagen->url) }}">
    </div>
</article>
