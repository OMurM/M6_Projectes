<!DOCTYPE html>
<html>
<head>
    <title>Pings</title>
</head>
<body>
    <h1>Lista de Pings</h1>
    <a href="{{ route('pings.create') }}">Crear Nuevo Ping</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>IP/Dominio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pings as $ping)
                <tr>
                    <td>{{ $ping->id }}</td>
                    <td>{{ $ping->nombre }}</td>
                    <td>{{ $ping->ip_dominio }}</td>
                    <td>{{ $ping->estado ? 'Online' : 'Offline' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
