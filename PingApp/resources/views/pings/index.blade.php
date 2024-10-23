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
                    <td class="ping-ip">{{ $ping->ip_dominio }}</td>
                    <td class="ping-nombre">{{ $ping->nombre }}</td>
                    <td class="ping-status">
                        {{ $ping->estado ? 'Online' : 'Offline' }}
                    </td>
                    <td>
                        <button class="btn btn-success check-status" data-id="{{ $ping->id }}">Check Status</button>
                        <button class="btn btn-warning edit-btn" data-id="{{ $ping->id }}">Edit</button>
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

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Ping</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        <input type="hidden" name="id" id="pingId">
                        <div class="form-group">
                            <label for="ip_dominio">IP/Dominio:</label>
                            <input type="text" class="form-control" id="ip_dominio" name="ip_dominio" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
