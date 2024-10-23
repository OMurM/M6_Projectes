<!-- resources/views/pings/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Ping')

@section('content')
    <h1>Create a New Ping</h1>
    <form action="{{ route('pings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ip_dominio">IP/Dominio</label>
            <input type="text" class="form-control" name="ip_dominio" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
