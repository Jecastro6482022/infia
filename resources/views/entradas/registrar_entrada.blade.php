@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/forms.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('ver_entrada')}}
@stop

<!-- palabra nav -->
@section('palabra-accion')
{{'Ver'}}
@stop


<!-- Titulo -->
@section('titulo')
{{ 'Registrar entrada'}}
@stop

@section('seccion')
<form class="registrar_usuario" action="{{route('post_reg_entrada')}}" method="POST" enctype="multipart/form-data">
@csrf
    <h2 class="form_titulo">Registrar entrada</h2>
    <div class="form_container">
        <div class="from_group">
            <select name="cod_articulo" class="from_group">
                <option value=""><button href="{{route('reg_articulo')}}" ><a >Seleccione un Artículo</a></button></option>
                @foreach ($articulos_view as $articulo)
                <option value="{{$articulo->cod_articulo}}">{{$articulo->cod_articulo }} - {{$articulo->nom_articulo}} - {{$articulo->color_articulo}} - {{$articulo->tipo_articulo}}</option>
                @endforeach
            </select>
        </div> 
        <div class="from_group">
            <select name="causal" id="causal">
                <option selected>Causal entrada</option>
                <option value="Factura de compra - Materia prima o insumos">Factura de compra - Materia prima o insumos</option>
                <option value="Devolucion - producto">Devolucion - producto</option>
                <option value="Confección Satelite - producto">Confección Satelite - producto</option>
            </select>                  
        </div>
        <div class="from_group">
            <select name="num_factura" class="from_group">
                <option selected>Seleccione una factura</option>
                <option value="">No aplica</option>
                @foreach ($facturas_view as $factura)
                <option value="{{$factura->num_factura}}">{{$factura->num_factura}} - {{$factura->tipo_factura}} </option>
                @endforeach
            </select>
        </div>
        <div class="from_group">
            <input type="number"  class="from_input" placeholder=" " name="cantidad" 
            required maxlength="10" minlength="10">
            <label for="tipo" class="from_label" >Cantidad</label>
            <span class="from_line"></span>
        </div>
        <input type="submit" value="Registrar" class="form_submit" class="gap" name="Registrar">
        <input type="reset" value="Limpiar" class="form_submit" class="gap" name="Limpiar">

    </div>
</form>
@if (session('guardado'))
<script>
    guardado('Registro Exitoso', '<?php echo session('guardado') ?>');
</script>
@endif

@if (session('error'))
<script>
    error('Dato Errado', '<?php echo session('error') ?>');
</script>
@endif

@if ($errors->any())
@foreach ($errors->all() as $message)
<script>
    error('Dato Errado', 'Dejo algún campo sin seleccionar')
</script>
@endforeach

@endif 


@stop

