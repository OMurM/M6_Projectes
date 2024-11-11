<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Ping App</title>
    <link rel="stylesheet" href="{{ asset('css/basic_all.css') }}">
</head>
<body>
    <h1>App Pings</h1>
    <nav>
        <ul>
            <li><a href="{{ route('allpings') }}">Ver Pings</a></li>
            <li><a href="{{ route('pings.create') }}">Agregar Nuevo Ping</a></li>
        </ul>
    </nav>
</body>
</html>
