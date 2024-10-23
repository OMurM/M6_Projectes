<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/partials/basic.css') }}">
</head>
<body>
    @include('partials.home.header')  <!-- Incluir el header -->

    <div class="container">
        <h1>Bienvenido a la Aplicación de Pings</h1>
        <h2>Selecciona una opción del menú</h2>
    </div>

    @include('partials.home.footer')  <!-- Incluir el footer -->
</body>
</html>
