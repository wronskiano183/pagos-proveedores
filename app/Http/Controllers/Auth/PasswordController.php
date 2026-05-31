<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    // Muestra el formulario para cambiar contraseña
    public function edit()
    {
        return view('auth.password');
    }

    // Guarda la nueva contraseña
    public function update(Request $request)
    {
        $data = $request->validate([
            // 'current_password' verifica que la contraseña actual sea la correcta
            'current_password' => ['required', 'current_password'],
            // 'confirmed' obliga a que coincida con el campo password_confirmation
            'password'         => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.current_password' => 'La contraseña actual no es correcta.',
        ]);

        // Hash::make encripta la contraseña antes de guardarla (nunca se guarda en texto plano)
        $request->user()->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('ok', 'Contraseña actualizada correctamente.');
    }
}
