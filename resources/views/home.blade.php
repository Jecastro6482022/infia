
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body>

    <h1 id="main">Menú</h1>
    <div class="usuario">
        <div class="containers">
            <div class="container_option">
                <a href="{{ route('autores.index')}}"><img src="img/icons8-persona-de-sexo-masculino-64.png" alt="usuarios"></a>
                <h2 class="titulo_usuarios">Autores</h2>
            </div>
            <div class="container_option">
               <a href="{{ route('categorias.index')}}"><img src="img/categorias.png" alt="empresas"></a>
               <h2 class="titulo_usuarios">Categorias</h2>
            </div>
            <div class="container_option">
               <a href="{{ route('peliculas.index')}}"><img src="img/peliculas.png" alt="facturas"></a>
               <h2 class="titulo_usuarios">Peliculas</h2>
            </div>
        </div>
    </div>
</body>

</html>