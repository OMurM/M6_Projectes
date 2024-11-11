@extends('layouts.app')

@section('title', 'Lista de Pings')

@section('content')
    <h1>Lista de Pings</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>IP/Dominio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pings as $ping)
                <tr>
                    <td>{{ $ping->id }}</td>
                    <td>{{ $ping->ip_dominio }}</td>
                    <td>{{ $ping->estado ? 'Vivo' : 'Muerto' }}</td>
                    <td>
                        <form action="{{ route('pings.validate', $ping->id) }}" method="POST">
                            @csrf
                            <button type="submit">Validar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pings.create') }}">Agregar Nuevo Ping</a>
@endsection
