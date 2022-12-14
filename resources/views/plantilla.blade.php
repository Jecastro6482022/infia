<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="@yield('estilos')">
    <link rel="stylesheet" href="@yield('estilos2')">
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
            <a href="{{route('home')}}"><h1 class="title">La Tienda Web</h1></a>
        </button>
        <button class="btn_menu">
            <div class="btn_first"></div>
            <div class="btn_second"></div>
            <div class="btn_tercer"></div>
        </button>
        <nav class="nav">
            <ul class="lista">
                <li><a href="{{ route('home')}}" class="active">Menú</a></li>
                <li><a href="@yield('link')">@yield('palabra-accion')</a></li>
                <li><a href="@yield('link2')">@yield('  2')</a></li>
            </ul>
        </nav>
    </header>
    <main class="">
        <!-- seccion -->
        @yield('seccion')
        <!-- fin seccion -->
      
    </main>
    <script src="@yield('script')"></script>
    <script src="{{ asset('js/main.js')}}"></script>
</body>
</html>

