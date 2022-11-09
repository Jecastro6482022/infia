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
    <div class="alingdownload">
        <div class="downloads">
            <button class="btn_download">
                <a href="{{route('csv_inventario')}}">
                    <span>CSV</span>
                </a>
            </button>
            <button class="btn_download">
                <a href="{{route('excel_inventario')}}">
                    <span>EXEL</span>
                </a>
            </button>
            <button class="btn_download">
                <a href="{{route('pdf_inventario')}}">
                    <span>PDF</span>
                </a>
            </button>
            <button class="btn_download">
                <a href="{{route('print_inventario')}}" target="_blank"><span>IMPRIMIR</span>
                </a>
            </button>
        </div>
        <input class="form" id="myInput" type="text" placeholder="Buscar ...">
    </div>
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
                <td data-label="Codigo articulo"></td>
                <td data-label="Tipo articulo"></td>
                <td data-label="Descripcion articulo"></td>
                <td data-label="Stock"></td>

                </form>
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
        $(document).ready(function() {
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
