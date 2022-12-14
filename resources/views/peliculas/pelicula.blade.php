@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/tablas.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('peliculas.create')}}
@stop
@section('palabra-accion')
{{'Registrar'}}
@stop

<!-- palabra nav -->


@section('seccion')
<div class="tabla">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id pelicula</th>
                <th>Id categoria</th>
                <th>Id autor</th>
                <th>Nombre</th>
                <th>Fecha Lanzamiento</th>
                <th>Productora</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($peliculas as $pelicula)
            <tr>
                <td data-label="id pelicula">
                    {{$pelicula->id_pelicula}}
                </td>
                <td data-label="id categoria">
                    {{$pelicula->id_categoria}}
                </td>
                <td data-label="id autor">
                    {{$pelicula->id_autor}}
                </td>
                <td data-label="Nombre">
                    {{$pelicula->nombre}}
                </td>
                <td data-label="fecha lanzamiento">
                    {{$pelicula->fecha_lanzamiento}}
                </td>
                <td data-label="Productora">
                    {{$pelicula->productora}}
                </td>
                <td data-label="Editar"><a href="{{ route('peliculas.edit', $pelicula->id) }}"><i class="bi bi-pencil-square"></i></a> </td>
                <form action="{{route('peliculas.destroy',$pelicula->id)}}" method="POST" class="eliminar_datos">
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
