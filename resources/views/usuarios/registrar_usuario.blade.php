@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/forms.css')}}
@stop

<!-- link nav -->
@section('link')
{{''}}
@stop

<!-- palabra nav -->
@section('palabra-accion')
{{''}}
@stop

<!--link nav2 -->
@section('link2')
{{ route('ver_usuario')}}
@stop

<!-- palabra nav2 -->
@section('palabra-accion2')
{{'Ver'}}
@stop

<!-- Script js -->

<!-- Titulo -->
@section('titulo')
{{ 'Registrar Usuario'}}
@stop



@section('seccion')
<form class="registrar_usuario" action="{{route('post_reg_usuario')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2 class="form_titulo">Registrar Usuarios</h2>
    <div class="form_container">
        <div class="from_group">
            <input type="number" id="cedula" class="from_input" placeholder=" " name="cedula" required maxlength="10">
            <label for="tipo" class="from_label" >ID</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="nombres" class="from_input" placeholder=" " name="nombres" required pattern="^[A-Za-z ]+" maxlength="25">
            <label for="tipo" class="from_label" >Nombres</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="apellidos" class="from_input" placeholder=" " name="apellidos" required maxlength="25" pattern="^[A-Za-z ]+">
            <label for="tipo" class="from_label" >Apellidos</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="telefono" class="from_input" placeholder=" " name="telefono" required maxlength="10" minlength="10" pattern="^[0-9]+">
            <label for="tipo" class="from_label" >Teléfono</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="text" id="direccion" class="from_input" placeholder=" " name="direccion" required maxlength="30">
            <label for="tipo" class="from_label" >Dirección</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="password" id="Contraseña" class="from_input" placeholder=" " name="contraseña" required minlength="6">
            <label for="tipo" class="from_label" >Contraseña</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="email" id="email" class="from_input" placeholder=" " name="email" required>
            <label for="tipo" class="from_label" >E-mail</label>
            <span class="from_line"></span>
        </div>
        <div class="from_group">
            <input type="date" id="fecha" class="from_input" placeholder="Fecha de ingreso" name="fecha" required>
        </div>
        <div class="from_group">
            <select name="rol" id="rol" required>
                <option value="">Seleccione rol</option>
                @foreach ($roles as $rol)
                <option value="{{$rol->cod_rol}}">{{$rol->cod_rol }} - {{$rol->nom_rol}}</option>
                @endforeach
            </select>
        </div>
        <button class="form_submit" type='submit'> Registrar </button>
        <button class="form_submit"><a href="{{ route('crear_rol')}}"> Crear rol </a></button>
    </div>
</form>
@if (session('guardado'))
<script>
    guardado('Registro Exitoso', '<?php echo session('guardado') ?>');
</script>
@endif

@if (session('error'))
<script>
    warning('Advertencia', '<?php echo session('error') ?>');
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
