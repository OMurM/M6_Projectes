<!-- resources/views/pings/create.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ping</title>
    <link rel="stylesheet" href="{{ asset('css/basic_all.css') }}">
</head>
<body>
    <h1>Agregar Nuevo Ping</h1>

    <!-- Mostrar errores de validación -->
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pings.store') }}" method="POST">
        @csrf
        <label for="ip_dominio">IP/Dominio:</label>
        <input type="text" id="ip_dominio" name="ip_dominio" required>
        <br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>

        <button type="submit">Agregar Ping</button>
    </form>

    <a href="{{ route('allpings') }}">Volver a la lista de Pings</a>
</body>
</html>
