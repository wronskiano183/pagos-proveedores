@extends('layouts.app')
@section('title', 'Cambiar contraseña')

@section('content')
<h1 class="h3 mb-4">Cambiar contraseña</h1>

<div class="row">
    <div class="col-md-6">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Contraseña actual</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="form-text">Mínimo 8 caracteres.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar nueva contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary">Actualizar contraseña</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
