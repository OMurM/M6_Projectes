<!-- resources/views/home.blade.php -->
@extends('layouts.app')  <!-- Extend the layout -->

@section('title', 'Home')  <!-- Set the page title -->

@section('content')  <!-- Define the content section -->
    <h1>2DAM M6_Projects</h1>
    <h2>Select a project on the menu to go</h2>

    <div>
        <a href="{{ route('pings.index') }}" class="btn btn-primary">Ping</a>
    </div>
@endsection
