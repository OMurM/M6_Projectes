<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Lista de Pings</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IP/Dominio</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pings as $ping)
                <tr>
                    <td>{{ $ping->id }}</td>
                    <td>{{ $ping->ip_dominio }}</td>
                    <td>{{ $ping->nombre }}</td>
                    <td>{{ $ping->estado ? 'Activo' : 'Inactivo' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/pings/create" class="btn btn-secondary mt-3">Create ping</a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
