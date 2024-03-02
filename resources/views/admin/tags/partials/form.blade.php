

<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la etiqueta ...']) !!}
</div>
@error('name')
    <small class="text-danger">{{$message}}</small>
@enderror

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug de la etiqueta ...',
    'readonly']) !!}
</div>
@error('slug')
    <small class="text-danger">{{$message}}</small>
@enderror

<div class="form-group">
    {!! Form::label('color', 'Color:') !!}
    {!! Form::select('color', $colors, null, ['class' => 'form-control']) !!}
</div>
@error('color')
    <small class="text-danger">{{$message}}</small>
@enderror