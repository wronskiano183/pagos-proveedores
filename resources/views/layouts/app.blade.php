<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pagos a Proveedores')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                 <img src="{{ asset('img/LogoN1.jpg') }}" alt="Logo" height="32" class="me-2">
</a>
 <!-- Título centrado -->
      <span class="navbar-text titulo-centro d-none d-lg-block fw-bold text-white fs-3">
    Pagos a Proveedores
</span>



            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('proveedores.index') }}">Proveedores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('facturas.index') }}">Facturas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('password.edit') }}">Contraseña</a></li>
                    <li class="nav-item"><form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                    <button class="btn btn-sm btn-outline-light ms-lg-2 mt-1">Cerrar sesión</button>
                    </form></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        {{-- Mensaje de éxito --}}
        @if (session('ok'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('ok') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Revisa los siguientes datos:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
