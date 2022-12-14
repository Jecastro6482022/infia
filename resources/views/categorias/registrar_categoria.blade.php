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


<!-- Titulo -->
@section('titulo')
{{ 'Registrar Autor'}}
@stop

@section('seccion')
<form class="registrar" action="{{route('categorias.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form_container">
        <h2 class="form_titulo">Registrar Autor</h2>
        <div class="from_group">
            <input type="text" id="nit" class="from_input"  name="id_categoria" 
            required maxlength="10">
            <label for="tipo" class="from_label" >Id</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" name="nombre" class="from_input"  required>
            <label for="tipo" class="from_label" >Nombre</label>
            <span class="from_line"></span>
        </div>
        <button name="registrar" type="submit" class="form_submit"><strong>Registrar</strong></button>
    </div>
</form>


@if (session('error'))
<script>
    error('Advertencia', '<?php echo session('error') ?>');
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
