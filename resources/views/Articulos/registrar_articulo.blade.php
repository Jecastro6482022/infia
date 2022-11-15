@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/forms.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('ver_articulo')}}
@stop
<!-- palabra nav -->
@section('palabra-accion')
{{'Ver'}}
@stop
<!-- Titulo -->
@section('titulo')
{{ 'Registrar Articulo'}}
@stop

@section('seccion')

<form class="registrar_usuario" action="{{route('post_reg_articulos')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form_container">
        <h2 class="form_titulo">Registrar artículo</h2>
        <div class="from_group">
            <select name="tipo" id="tipo">
                <option selected>Seleccione la categoría del artículo</option>
                <option value="Producto terminado">Producto terminado</option>
                <option value="Materia prima">Materia prima</option>
                <option value="Insumo">Insumo</option>
            </select> 
        </div>
        <div class="from_group">
            <input type="text" id="Nombre" class="from_input" placeholder=" " name="nombre">
            <label for="tipo" class="from_label" >Nombre</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="material" class="from_input" placeholder=" " name="material">
            <label for="tipo" class="from_label" >Material</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <select name="linea" id="linea">
                <option selected>Seleccione línea del producto</option>
                <option value="No">No aplica</option>
                <option value="Adulto">Adulto</option>
                <option value="Niño">Niño</option>
            </select> 
        </div>
        <div class="from_group">
            <select name="talla" id="talla">
                <option selected>Seleccione talla del producto</option>
                <option value="No">No aplica</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="2XL">2XL</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="12">12</option>
                <option value="14">14</option>
                <option value="16">16</option>
            </select> 
        </div>
        <div class="from_group">
            <select name="uMedida" id="uMedida">
                <option selected>Seleccione unidad de medida</option>
                <option value="Unidad">Unidad</option>
                <option value="Centímetros">Centímetros</option>
                <option value="Metros">Metros</option>
            </select> 
        </div>
        <div class="from_group">
            <input type="text" id="Color" class="from_input" placeholder=" " name="color">
            <label for="tipo" class="from_label" >Color</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="descripción" class="from_input" placeholder=" " name="descripcion">
            <label for="tipo" class="from_label" >Descripción</label>
            <span class="from_line"></span>
        </div>
        <button type="submit" class="form_submit" name="registrarArt">Registrar Articulo</button>
    </div>
</form>
@if (session('guardado'))
<script>
    guardado('Registro Exitoso', '<?php echo session('guardado') ?>');
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
