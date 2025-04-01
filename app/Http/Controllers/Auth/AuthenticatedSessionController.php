<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Asegúrate de importar el modelo User

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // Verificar credenciales manualmente para contar intentos fallidos
        if (!Auth::attempt($credentials)) {
            // Incrementar intentos fallidos
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->increment('failed_attempts');
            }

            return back()->withErrors([
                'email' => 'Credenciales incorrectas.',
            ]);
        }

        // Restablecer intentos fallidos si el login es exitoso
        $request->user()->update(['failed_attempts' => 0]);

        // Regenerar sesión (seguridad)
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirigir si es la primera vez
        if ($user->primera_vez) {
            return redirect()->to('/perfil');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}