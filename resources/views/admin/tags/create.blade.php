@extends('adminlte::page')

@section('title', 'Cabesas Ridders')

@section('content_header')
    <h1>Crear etiqueta</h1>
    @stop

    @section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            {{-- Creacion de un formulario con laravel collected --}}
            {!! Form::open(['route' => 'admin.tags.store']) !!}
                @include('admin.tags.partials.form')

                {!! Form::submit('Crear etiqueta', ['Class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.tags.index') }}" class="btn btn-primary">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script>
        $(document).ready(function() {
                $("#name").stringToSlug({
                    setEvents: 'keyup keydown blur',
                    getPut: '#slug',
                    space: '-'
                });
            });
    </script>
@stop   