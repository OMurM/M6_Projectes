<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/basic_all.css') }}">
    <title>@yield('title', 'Mi Aplicación')</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('pings.index') }}">Lista de Pings</a></li>
            <li><a href="{{ route('pings.create') }}">Agregar Ping</a></li>
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
