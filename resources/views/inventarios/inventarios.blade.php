@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/tablas.css')}}
@stop

<!-- Titulo -->
@section('titulo')
{{ 'Inventario'}}
@stop

@section('seccion')
<div class="tabla">
    <input class="form" id="myInput" type="text" placeholder="Buscar ...">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Codigo articulo</th>
                <th>Tipo articulo</th>
                <th>Descripcion articulo</th>
                <th>Stock</th>

            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($cantidadEntradas as $inventario)
            <tr>
                <td data-label="codigo">
                    {{$inventario["codigo"]}}
                </td>
                <td data-label="Nombre">
                    {{$inventario["tipoArticulo"]}}
                </td>
                <td data-label="Teléfono">
                    {{$inventario["descArticulo"]}}
                </td>
                <td data-label="Dirección">
                    {{$inventario["cantidad"]}}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
</div>
@stop