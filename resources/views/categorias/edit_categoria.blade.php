@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/forms.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('categorias.index')}}
@stop
<!-- palabra nav -->
@section('palabra-accion')
{{'Ver'}}
@stop
<!--link nav2 -->
@section('link2')
{{ route('categorias.store')}}
@stop
<!-- palabra nav2 -->
@section('palabra-accion2')
{{'Registrar'}}
@stop
<!-- Titulo -->
@section('titulo')
{{ 'Editar categoria'}}
@stop

@section('seccion')
<form class="registrar" action="{{route('categorias.update',$categoria->id)}}" method="post">
    @method('PATCH') 
            @csrf
    <div class="form_container">
        <h2 class="form_titulo">Editar categoria</h2>
        <div class="from_group" >
            <input type="text" id="id" class="from_input"  name="id_categoria" 
            required maxlength="10" value="{{$categoria->id_categoria}}">
            <label for="tipo" class="from_label" >Id</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="nombre" class="from_input"  name="nombre" 
            required value="{{$categoria->nombre}}">
            <label for="tipo" class="from_label" >Nombre</label>
            <span class="from_line"></span>
        </div>
        <button name="registrar" type="submit" class="form_submit"><strong>Editar categoria</strong></button>
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
