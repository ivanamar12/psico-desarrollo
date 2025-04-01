<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BlockUserAfterAttempts
{
    public function handle(Request $request, Closure $next)
    {
        // Obtener el usuario autenticado (si existe)
        $user = $request->user();

        // Verificar si el usuario existe y tiene 3 o más intentos fallidos
        if ($user && $user->failed_attempts >= 3) {
            // Asignar rol "bloqueado" (requiere Spatie)
            $user->assignRole('bloqueado');
            
            // Cerrar sesión forzadamente
            Auth::logout();
            
            // Redirigir al login con mensaje de error
            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Cuenta bloqueada. Usa la recuperación por preguntas de seguridad.']);
        }

        // Continuar la solicitud si no está bloqueado
        return $next($request);
    }
}