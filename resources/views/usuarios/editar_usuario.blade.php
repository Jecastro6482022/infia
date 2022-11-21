@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/forms.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('reg_usuario')}}
@stop

<!-- palabra nav -->
@section('palabra-accion')
{{'Registrar'}}
@stop

<!--link nav2 -->
@section('link2')
{{ route('ver_usuario')}}
@stop

<!-- palabra nav2 -->
@section('palabra-accion2')
{{'Ver'}}
@stop


<!-- Titulo -->
@section('titulo')
{{ 'Editar usuario'}}
@stop

@section('seccion')
    <form class="registrar_usuario" action="{{route('update_usuario',$usuario)}}" method="POST">
        @csrf
        @method('PATCH')
        <h2 class="form_titulo">Editar usuario</h2>
        <div class="form_container">
            <div class="from_group"  style="display:none">
                <input type="text" id="ID" class="from_input" placeholder=" " name="id_user" readonly maxlength="10" value="{{$usuario->id_user}}">
                <label for="tipo" class="from_label" >ID</label>
            </div>
            <div class="from_group">
                <input type="text" id="cedula" class="from_input" placeholder=" " name="cedula" required  pattern="^[0-9]+" maxlength="10" value="{{$usuario->cedula}}">
                <label for="tipo" class="from_label" >Cédula</label>
            </div>
            <div class="from_group">
                <input type="text" id="nombre" class="from_input" placeholder=" " name="nombres" required pattern="^[A-Za-z ]+" maxlength="25" value="{{$usuario->nom_user}}">
                <label for="tipo" class="from_label" >Nombres</label>
            </div>
            <div class="from_group">
                <input type="text" id="apellido" class="from_input" placeholder=" " name="apellidos" required maxlength="25" pattern="^[A-Za-z ]+" value="{{$usuario->apellidos_user}}">
                <label for="tipo" class="from_label" >Apellidos</label>
            </div>
            <div class="from_group">
                <input type="text" id="telefono" class="from_input" placeholder=" " name="telefono" required maxlength="10" minlength="10" pattern="^[0-9]+" value="{{$usuario->telefono_user}}">
                <label for="tipo" class="from_label" >Teléfono</label>
            </div>
            <div class="from_group">
                <input type="text" id="direccion" class="from_input" placeholder=" " name="direccion" required maxlength="30" value="{{$usuario->direccion_user}}">
                <label for="tipo" class="from_label" >Dirección</label>
            </div>
            <div class="from_group">
                <input type="password" id="Contraseña" class="from_input" placeholder=" " name="contraseña" required minlength="6" value="{{$usuario->contraseña_user}}">
                <label for="tipo" class="from_label" >Contraseña</label>
            </div>
            <div class="from_group">
                <input type="email" id="e_mail" class="from_input" placeholder=" " name="email" required value="{{$usuario->email_user}}">
                <label for="tipo" class="from_label" >E-mail</label>
            </div>
            <div class="from_group">
                <input type="date" id="fecha_ingreso" class="from_input" placeholder="Fecha de ingreso" name="fecha" required value="{{$usuario->fecha_ingreso}}">
            </div>
            <div class="from_group">
                <select name="rol" id="rol" required>
                    <option selected value="{{$usuario->cod_rol}}">{{$usuario->cod_rol}} </option>
                    @foreach ($roles as $rol)
                    <option value="{{$rol->cod_rol}}">{{$rol->cod_rol }} - {{$rol->nom_rol}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="form_submit" name="registrarArt">Editar</button>
        </div>
    </form>
    @if (session('actualizado'))
    <script>
        guardado('Actualizacion Exitosa', '<?php echo session('actualizado') ?>');
    </script>
    @endif
    @if (session('error'))
    <script>
        error('Error', '<?php echo session('error') ?>');
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
