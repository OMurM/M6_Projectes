<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link rel="stylesheet" href="{{ asset('css/partials/app.css') }}">  <!-- Updated CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Optional Bootstrap CSS -->
</head>
<body class="d-flex flex-column min-vh-100">  <!-- Use Flexbox for the layout -->

    <x-navigation-menu />  <!-- Include the Navigation Menu component -->

    <div class="container flex-fill">  <!-- Make the container flexible -->
        @yield('content')  <!-- Content section where child views will be rendered -->
    </div>

    <x-footer />  <!-- Include the Footer component -->
    
    <script src="{{ asset('js/app.js') }}"></script> <!-- Include your JavaScript file -->
</body>
</html>
