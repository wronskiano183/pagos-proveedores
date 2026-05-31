<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

/* ============================================================
   RUTAS PÚBLICAS — solo para quien NO ha iniciado sesión
   El middleware 'guest' impide entrar al login si ya estás dentro.
   El 'throttle:6,1' bloquea tras 6 intentos fallidos por minuto
   (protección contra alguien que intente adivinar la contraseña).
   ============================================================ */
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->middleware('throttle:6,1');
});

/* ============================================================
   RUTAS PROTEGIDAS — requieren haber iniciado sesión
   El middleware 'auth' es el "guardia": si no has entrado,
   te manda automáticamente al login.
   ============================================================ */
Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('proveedores', ProveedorController::class)
        ->parameters(['proveedores' => 'proveedor']);
    Route::resource('facturas', FacturaController::class);

    Route::post('facturas/{factura}/pagos', [PagoController::class, 'store'])->name('pagos.store');
    Route::delete('pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');

    // Cambiar contraseña
    Route::get('password',  [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('password',  [PasswordController::class, 'update'])->name('password.update');

    // Cerrar sesión
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});
