@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/forms.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('peliculas.index')}}
@stop
<!-- palabra nav -->
@section('palabra-accion')
{{'Ver'}}
@stop
<!--link nav2 -->
@section('link2')
{{ route('peliculas.store')}}
@stop
<!-- palabra nav2 -->
@section('palabra-accion2')
{{'Registrar'}}
@stop
<!-- Titulo -->
@section('titulo')
{{ 'Editar pelicula'}}
@stop

@section('seccion')
<form class="registrar" action="{{route('peliculas.update',$pelicula->id)}}" method="post">
    @method('PATCH') 
            @csrf
    <div class="form_container">
        <h2 class="form_titulo">Editar pelicula</h2>
        <div class="from_group" >
            <input type="text" id="id" class="from_input"  name="id_pelicula" 
            required maxlength="10" value="{{$pelicula->id_pelicula}}">
            <label for="tipo" class="from_label" >Id_pelicula</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group" >
            <input type="text" id="id" class="from_input"  name="id_categoria" 
            required maxlength="10" value="{{$pelicula->id_categoria}}">
            <label for="tipo" class="from_label" >Id_categoria</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group" >
            <input type="text" id="id" class="from_input"  name="id_autor" 
            required maxlength="10" value="{{$pelicula->id_autor}}">
            <label for="tipo" class="from_label" >Id_autor</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group" >
            <input type="text" id="id" class="from_input"  name="nombre" 
            required maxlength="10" value="{{$pelicula->nombre}}">
            <label for="tipo" class="from_label" >Nombre</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="date" id="nombre" class="from_input"  name="fecha" 
            required value="{{$pelicula->fecha_lanzamiento}}">
            <label for="tipo" class="from_label" >Fecha Lanzamiento</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="nombre" class="from_input"  name="productora" 
            required value="{{$pelicula->productora}}">
            <label for="tipo" class="from_label" >Productora</label>
            <span class="from_line"></span>
        </div>
        <button name="registrar" type="submit" class="form_submit"><strong>Editar pelicula</strong></button>
    </div>
</form>

@if (session('actualizado'))
<script>
    guardado('Actualizacion Exitosa', '<?php echo session('actualizado') ?>');
</script>
@endif


@if ($errors->any())
@foreach ($errors->all() as $message)
<script>
    error('Dato Errado', '<?php echo $message ?>')
</script>
@endforeach
@endif

@stop
