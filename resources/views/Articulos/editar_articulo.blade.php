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
<!--link nav2 -->
@section('link2')
{{ route('reg_articulo')}}
@stop
<!-- palabra nav2 -->
@section('palabra-accion2')
{{'Registrar'}}
@stop
<!-- Titulo -->
@section('titulo')
{{ 'Editar Articulo'}}
@stop

@section('seccion')
<form class="registrar_usuario" action="{{route('update_articulo', $articulo)}}" method="POST">
    @csrf @method('PATCH')
    <div class="form_container">
        <h2 class="form_titulo">Editar articulo</h2>
        <div class="from_group">
            <select name="tipo" id="tipo" > 
                <option value="{{$articulo->tipo_articulo}}">{{$articulo->tipo_articulo}}</option>
                <option value="Producto terminado">Producto terminado</option>
                <option value="Materia prima">Materia prima</option>
                <option value="Insumo">Insumo</option>
            </select> 
        </div>
        <div class="from_group">
            <input type="text" id="Nombre" class="from_input" placeholder=" " name="nombre" value="{{$articulo->nom_articulo}}">
            <label for="tipo" class="from_label" >Nombre</label>
        </div>
        <div class="from_group">
            <input type="text" id="Material" class="from_input" placeholder=" " name="material" value="{{$articulo->material_articulo}}">
            <label for="tipo" class="from_label" >Material</label>
        </div>
        <div class="from_group">
            <select name="linea" id="linea">
                <option value="{{$articulo->talla_articulo}}">{{$articulo->talla_articulo}}</option>
                <option value="No">No aplica</option>
                <option value="Adulto">Adulto</option>
                <option value="Niño">Niño</option>
            </select> 
        </div>
        <div class="from_group">
            <select name="talla" id="talla">
                <option value="{{$articulo->linea}}">{{$articulo->linea}}</option>
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
                <option value="{{$articulo->unidad_medida}}">{{$articulo->unidad_medida}}</option>
                <option value="Unidad">Unidad</option>
                <option value="Centímetros">Centímetros</option>
                <option value="Metros">Metros</option>
            </select> 
        </div>
        <div class="from_group">
            <input type="text" id="Color" class="from_input" value="{{$articulo->color_articulo}}" placeholder=" " name="color">
            <label for="tipo" class="from_label" >Color</label>
        </div>
        <div class="from_group">
            <input type="text" id="descripción" class="from_input" placeholder=" " value="{{$articulo->descripcion_articulo}}" name="descripcion">
            <label for="tipo" class="from_label" >Descripción</label>
        </div>
        <button type="submit" class="form_submit" name="registrarArt">Editar</button>
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
