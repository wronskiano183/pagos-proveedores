<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra la pantalla de inicio de sesión
    public function create()
    {
        return view('auth.login');
    }

    // Procesa el inicio de sesión
    public function store(Request $request)
    {
        // 1) Validamos que vengan correo y contraseña
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2) Auth::attempt revisa si coinciden con un usuario de la base de datos.
        //    Compara la contraseña encriptada automaticamente
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // medida de seguridad contra robo de sesión
            return redirect()->intended(route('dashboard'));
        }

        // 3) Si no coinciden, regresamos con un mensaje de error
        return back()->withErrors([
            'email' => 'El correo o la contraseña no son correctos.',
        ])->onlyInput('email');
    }

    // Cierra la sesión
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
