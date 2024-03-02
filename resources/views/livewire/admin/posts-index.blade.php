<div class="card">
    
    @if($posts->count())   
        <div class="card-body">
            <table class="table table-striped" id="posts">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->name}}</td>
                            <td width='10px'><a href="{{route('admin.posts.edit', $post)}}" class="btn btn-primary btn-sm">Editar</a></td>
                            <td width='10px'>
                                <form action="{{route('admin.posts.destroy', $post)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
    <div class="card-body">
        <strong>No hay registros</strong>
    </div>
    @endif
</div>
