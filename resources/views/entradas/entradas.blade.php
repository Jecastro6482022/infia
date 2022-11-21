@extends('plantilla')

<!--estilo css -->
@section('estilos')
{{asset('css/tablas.css')}}
@stop

<!--link nav -->
@section('link')
{{ route('reg_entrada')}}
@stop

<!-- palabra nav -->
@section('palabra-accion')
{{'Registrar'}}
@stop


<!-- Titulo -->
@section('titulo')
{{ 'Entradas'}}
@stop

@section('seccion')
<div class="tabla">
    <div class="alingdownload">
        <div class="downloads">
            <button class="btn_download">
                <a href="{{route('csv_entrada')}}">
                    <span>CSV</span>
                </a>
            </button>
            <button class="btn_download">
                <a href="{{route('excel_entrada')}}">
                    <span>EXCEL</span>
                </a>
            </button>
            <button class="btn_download">
                <a href="{{route('pdf_entrada')}}">
                    <span>PDF</span>
                </a>
            </button>
            <button class="btn_download">
                <a href="{{route('print_entrada')}}" target="_blank"><span>IMPRIMIR</span>
                </a>
            </button>
        </div>
        <input class="form" id="myInput" type="text" placeholder="Buscar ...">
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Codigo registro</th>
                <th>Tipo registro</th>
                <th>Codigo articulo</th>
                <th>Descripcion articulo</th>
                <th>Casual de salida</th>
                <th>Numero de factura</th>
                <th>Cantidad</th>


            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($entradas as $entrada)
            <tr>
                <td data-label="codigoR">{{$entrada->cod_registro}}</td>
                <td data-label="tipo">{{$entrada->tipo}}</td>
                <td data-label="codigoA">{{$entrada->cod_articulo}}</td>
                <td data-label="descripcionA">{{$entrada->descripcion_articulo}}</td>
                <td data-label="causal">{{$entrada->causal}}</td>
                <td data-label="numeroF">{{$entrada->num_factura}}</td>
                <td data-label="cantidad">{{$entrada->cantidad}}</td>

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
