<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RICK & MORTY PRUEBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">    
</head>
<body>
    <nav class="navbar mb-4">
        <div class="container-fluid div-nav">
            <a class="navbar-brand" href="{{ route('characters.index') }}">RICK & MORTY</a>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    
</body>
</html>
