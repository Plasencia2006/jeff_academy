<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jeff Academy - Formando Futuros Campeones')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Bootstrap JS (necesario para los modales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    @stack('styles')
</head>
<body>


    <!-- Mensajes de sesión (toast fijo, no desplaza el contenido) -->
    <div style="position: fixed; top: 20px; right: 20px; z-index: 1080; width: 360px; max-width: calc(100% - 40px);">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Contenido Principal -->
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Auto-cerrar cualquier alerta después de 4 segundos (incluye mensajes de bienvenida y de estadísticas)
        window.addEventListener('load', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alertEl) {
                setTimeout(function() {
                    alertEl.classList.remove('show');
                    setTimeout(function(){ alertEl.remove(); }, 300);
                }, 4000);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>