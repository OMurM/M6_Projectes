<!-- resources/views/pings/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Ping')

@section('content')
    <h1>Create Ping</h1>

    <!-- If there are validation errors, display them -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ip_dominio">IP or Domain:</label>
            <input type="text" name="ip_dominio" id="ip_dominio" class="form-control" value="{{ old('ip_dominio') }}" placeholder="Enter IP address or domain">
        </div>
        <div class="form-group">
            <label for="nombre">Name:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Enter a name">
        </div>
        <button type="submit" class="btn btn-primary">Create Ping</button>
    </form>
@endsection
