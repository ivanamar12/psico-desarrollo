<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateLastActivity
{
    /**
     * Maneja la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            try {
                $user = Auth::user();

                // Verificar si el modelo puede ser actualizado
                if ($user->isDirty('last_activity')) {
                    Log::info("No se actualizó last_activity porque ya tenía cambios pendientes.");
                } else {
                    $user->update(['last_activity' => now()]);
                    Log::info("Se actualizó last_activity para el usuario ID: " . $user->id);
                }

            } catch (\Exception $e) {
                Log::error("Error al actualizar last_activity: " . $e->getMessage());
            }
        }

        return $next($request);
    }
}
