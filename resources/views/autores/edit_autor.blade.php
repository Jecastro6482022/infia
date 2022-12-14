@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/forms.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('autores.index')}}
@stop
<!-- palabra nav -->
@section('palabra-accion')
{{'Ver'}}
@stop
<!--link nav2 -->
@section('link2')
{{ route('autores.store')}}
@stop
<!-- palabra nav2 -->
@section('palabra-accion2')
{{'Registrar'}}
@stop
<!-- Titulo -->
@section('titulo')
{{ 'Editar autor'}}
@stop

@section('seccion')
<form class="registrar" action="{{route('autores.update',$autor->id)}}" method="post">
    @method('PATCH') 
            @csrf
    <div class="form_container">
        <h2 class="form_titulo">Editar autor</h2>
        <div class="from_group" >
            <input type="text" id="id" class="from_input"  name="id_autor" 
            required maxlength="10" value="{{$autor->id_autor}}">
            <label for="tipo" class="from_label" >Id</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="nombre" class="from_input"  name="nombre" 
            required value="{{$autor->nombre}}">
            <label for="tipo" class="from_label" >Nombre</label>
            <span class="from_line"></span>
        </div>
        <button name="registrar" type="submit" class="form_submit"><strong>Editar autor</strong></button>
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
