@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/reportes.css')}}
@stop

<!-- Titulo -->
@section('titulo')
{{ 'Reportes'}}
@stop

@section('seccion')
<form class="registrar_usuario" action="{{route('post_reg_salida')}}" method="POST" enctype="multipart/form-data">
@csrf
    <h2 class="form_titulo">Reportes</h2>

    <a class="form_submit" href="{{route('pdf_usuarios')}}"><img class="img" src="{{asset('img/icons8-persona-de-sexo-masculino-64.png')}}" alt="usuarios"><strong> Usuarios</strong></a>
    <button name="registrar" type="submit" class="form_submit"><img class="img" src="{{asset('img/icons8-cliente-de-empresa-60.png')}}" alt="empresas"><strong>  Empresas</strong></button>
    <button name="registrar" type="submit" class="form_submit"><img class="img" src="{{asset('img/icons8-invoices-60.png')}}" alt="facturas"><strong>  Facturas</strong></button>
    <button name="registrar" type="submit" class="form_submit"><img class="img" src="{{asset('img/icons8-suéter.png')}}" alt="articulos"><strong>  Artículos</strong></button>
    <button name="registrar" type="submit" class="form_submit"><img class="img" src="{{asset('img/icons8-producto-nuevo.png')}}" alt="invetario"><strong>  Stock</strong></button>

    </div>
</form>

@stop

