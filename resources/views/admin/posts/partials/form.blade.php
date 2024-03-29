{{-- Nombre --}}
<div class="from-group">
    {!! Form::label('name', null) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del post ...']) !!}

    @error('name')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- Slug --}}
<div class="from-group">
    {!! Form::label('slug', null) !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug del  post ...', 'readonly']) !!}

    @error('slug')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- Combo raider --}}
<div class="form-group">
    {{-- El campo category_id toma el valor del id del usurario que este registrado y no se ve en pantalla --}}
    {!! Form::hidden('category_id',Auth::id()) !!}
</div>

{{-- Check box --}}
<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)
        <label class="mr-3">
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{ $tag->name }}
        </label>
    @endforeach

    @error('tags')
        <br>
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- Radio buton --}}
<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label>
        {!! Form::radio('status', 1, true) !!}
        Borrador
    </label>

    <label>
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>

    @error('status')
        <br>
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- Imagen --}}
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
           @isset($post->image)
                <img  src="{{ asset('storage/' . $post->image->url) }}">
           @else
                <img id="logoRiders" src="/riders/LOGO_RAIDERS.PNG">
           @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="file">Imagen que se mostrará en el post</label>
            <input type="file" name="file" id="file" class="form-control-file" accept="image/*">

            @error('file')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <p>Selecciona aquí la imágen que quieres que tenga el post que vas a escribir. En caso de que no subas
            ninguna imagen, se tomará por defecto el logo de los Cabesas Riders.</p>
    </div>
</div>

{{-- Textarea  resumen --}}
<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

    @error('extract')
        <small class="font-weight-bold text-danger">{{ $message }}</small> 
    @enderror
</div>

{{-- Textarea  cuerpo --}}
<div class="form-group">
    {!! Form::label('body', 'Cuerpo de post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

    @error('body')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>