<!-- resources/views/components/navigation-menu.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pings.index') }}">Crude Application Php (2DAM-M6-UF2-Sprint3)</a>
            </li>
            <li class="nav-item">
                <button id="theme-toggle" class="btn btn-outline-light">Toggle Theme</button>
            </li>
        </ul>
    </div>
</nav>
