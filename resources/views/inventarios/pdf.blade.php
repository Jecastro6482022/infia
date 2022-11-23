<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Stock</title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/swetalerts.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>

    <header>
        <button class="logo">
            <a href="{{ route('main')}}"><img height="70vw" src="{{ asset('img\Logo letra blanca.png')}}" alt="logo"></a>
        </button>
        <button class="btn_menu">
            <div class="btn_first"></div>
            <div class="btn_second"></div>
            <div class="btn_tercer"></div>
        </button>
        <h1 style="color:#ffffffff">Reporte de Stock</h1>
        <nav class="nav">
            <ul class="lista">
                <li><a >Fecha reporte:</a><a>{{$date = now()}}</a></li>
            </ul>
        </nav>
    </header>
    <main class="">
        <div class="tabla">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nit</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>E-mail</th>
                        <th>Id User</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                
                    <tr>
                        <td data-label="Cedula"></td>
                        <td data-label="Cedula"></td>
                        <td data-label="Nombre"></td>
                        <td data-label="Apellido"></td>
                        <td data-label="Telefono"></td>
                        <td data-label="Direccion"></td>
                        <td data-label="E-mail"></td>
                        <td data-label="Rol"></td>
                        <td data-label="Item"></td>
                    </tr>
        
                </tbody>
            </table>
        </div>

        <div class="tabla">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Total Empresas</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td data-label="totalEmpresas"></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

</html>
