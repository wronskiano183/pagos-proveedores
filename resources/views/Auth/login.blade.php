<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión · Ferretería San Juan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: radial-gradient(circle at 50% 30%, #20222a, var(--negro-osc)) !important;
        }

        .login-box { width: 100%; max-width: 420px; }

        /* Logo grande, directo sobre el fondo oscuro */
        .login-logo { text-align: center; margin-bottom: 1.5rem; }
        .login-logo img {
            max-width: 800px;
            width: 80%;
            height: auto;
        }

        /* Tarjeta blanca para que el formulario se lea bien */
        .login-box .card {
            border: none;
            border-top: 4px solid var(--rojo);
            border-radius: 16px;
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.45);
        }

        .login-titulo { font-weight: 800; letter-spacing: -0.01em; }
        .login-sub { color: #6b7280; font-size: 0.88rem; }

        .login-box .btn-primary { padding: 0.6rem; font-size: 1.02rem; }

        .login-footer {
            text-align: center;
            margin-top: 1.4rem;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.45);
        }
    </style>
</head>
<body>
    <div class="login-box">
        <!-- Logo grande sobre el fondo oscuro -->
        <div class="login-logo">
            <img src="{{ asset('img/LogoN1.jpg') }}" alt="Ferretería San Juan">
        </div>

        <div class="card">
            <div class="card-body p-4 p-md-5">
                <h1 class="h4 text-center login-titulo mb-1">Bienvenido</h1>
                <p class="text-center login-sub mb-4">Ingresa para administrar tus pagos</p>

                @if ($errors->any())
                    <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="email" class="form-control form-control-lg"
                               value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-check mb-4">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Mantener sesión iniciada</label>
                    </div>
                    <button class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>

        <div class="login-footer">© {{ date('Y') }} Ferretería San Juan</div>
    </div>
</body>
</html>
