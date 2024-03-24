<div class="card">

    @if ($posts->count())
        <div class="card-body">
            <table class="table table-striped" id="posts">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                    @foreach ($posts as $post)
                        <tr>

                            <td class="text-center">{{ ++$indice }}</td>

                            <td>{{ $post->name }}</td>

                            @if ($post->image)
                                <td>
                                    <img class="w-full object-cover object-center"
                                        src="{{ asset('storage/' . $post->image->url) }}" width="50px">
                                </td>
                            @else
                                <td>
                                    <img class="w-full h-40 object-cover object-center" src='/riders/LOGO_RAIDERS.PNG' width="50px">
                                </td>
                            @endif

                            <td width="10px" style="text-align: right">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                            </td>

                            <td width='10px' style="text-align: right">
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                       
                </tbody>

            </table>
            <div class="mt-4">
                {{ $posts->links('vendor.livewire.bootstrap')}}
            </div>
        </div>
    @else
        <div class="card-body">
            <strong>No hay registros</strong>
        </div>
    @endif
</div>
