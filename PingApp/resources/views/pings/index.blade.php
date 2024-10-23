<!-- resources/views/pings/index.blade.php -->
@extends('layouts.app')

@section('title', 'Pings')

@section('content')
    <h1>Pings</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('pings.create') }}" class="btn btn-primary">Create Ping</a>
    <table class="table">
        <thead>
            <tr>
                <th>IP/Dominio</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pings as $ping)
                <tr id="ping-{{ $ping->id }}">
                    <td>{{ $ping->ip_dominio }}</td>
                    <td>{{ $ping->nombre }}</td>
                    <td class="ping-status">{{ $ping->estado ? 'Online' : 'Offline' }}</td>
                    <td>
                        <button class="btn btn-info" onclick="checkPing({{ $ping->id }}, '{{ $ping->ip_dominio }}')">Check Status</button>
                        <a href="{{ route('pings.edit', $ping->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pings.destroy', $ping->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function checkPing(pingId, ip) {
            fetch(`/ping?ip=${ip}`)
                .then(response => response.json())
                .then(data => {
                    if (data.estado !== undefined) {
                        const statusCell = document.querySelector(`#ping-${pingId} .ping-status`);
                        statusCell.textContent = data.estado ? 'Online' : 'Offline';
                    } else {
                        alert('Error checking ping status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
