<div class="from-group">
    {!! Form::label('name', null) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del post ...']) !!}

    @error('name')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="from-group">
    {!! Form::label('slug', null) !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug del  post ...', 'readonly']) !!}

    @error('slug')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>

{{-- Combo --}}
<div class="form-group">
    {!! Form::label('category_id', 'Categoría') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

    @error('category_id')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
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

<div class="row">
    <div class="col">
        <div class="image-wrapper">
            @isset($post->image)
                <img id="logoRiders" src="{{ Storage::url($post->image->url)}}">
            @else
                <img id="logoRiders" src="/riders/LOGO_RAIDERS.PNG" alt="">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrará en el post') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div>

        <p>Selecciona aquí la imágen que quieres que tenga el post que vas a escribir. En caso de que no subas
            ninguna imagen, se tomará por defecto la imágen de la izquierda, el logo de los Cabesas Riders.</p>
    </div>
</div>

{{-- Textarea  --}}
<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

    @error('extract')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo de post') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

    @error('body')
        <small class="font-weight-bold text-danger">{{ $message }}</small>
    @enderror
</div>
