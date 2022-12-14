@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/tablas.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('autores.create')}}
@stop

<!-- palabra nav -->
@section('palabra-accion')
{{'Registrar'}}
@stop
@section('seccion')
<div class="tabla">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id autor</th>
                <th>nombre</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($autores as $autor)
            <tr>
                <td data-label="id">
                    {{$autor->id_autor}}
                </td>
                <td data-label="Nombre">
                    {{$autor->nombre}}
                </td>
                <td data-label="Editar"><a href="{{ route('autores.edit', $autor->id) }}"><i class="bi bi-pencil-square"></i></a> </td>
                <form action="{{route('autores.destroy',$autor->id)}}" method="POST" class="eliminar_datos">
                    @csrf
                    @method('DELETE')
                    <td class="eliminartd" data-label="">
                        <button class="btn_eliminar" type="submit">
                        <i class="bi bi-archive-fill"></i>
                        </button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
   
</div>

<!-- Script js -->
@if (session('Actualizado'))
<script>
    guardado('Actualizacion Exitosa', '<?php echo session('actualizado') ?>');
</script>
@endif
@if (session('Guardado'))
<script>
    guardado('Registro Exitoso', '<?php echo session('guardado') ?>');
</script>
@endif
@if (session('error'))
<script>
    error('Advertencia', '<?php echo session('error') ?>');
</script>
@endif


@section('script')
{{ asset('js/eliminar.js')}}
@stop
<!-- Mesajes de confirmacion y error -->
@if (session('destroy'))
<script>
    guardado('Eliminacion Exitosa', '<?php echo session('destroy') ?>');
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
