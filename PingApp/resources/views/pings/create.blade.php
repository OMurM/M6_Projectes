<!DOCTYPE html>
<html>
<head>
    <title>Crear Ping</title>
</head>
<body>
    <h1>Crear Nuevo Ping</h1>

    <form action="{{ route('pings.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>

        <label for="ip_dominio">IP/Dominio:</label>
        <input type="text" name="ip_dominio" required>
        <br>

        <button type="submit">Crear Ping</button>
    </form>

    <a href="{{ route('pings.index') }}">Volver a la lista de Pings</a>
</body>
</html>
