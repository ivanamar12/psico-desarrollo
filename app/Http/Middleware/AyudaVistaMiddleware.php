<?php


namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class AyudaVistaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $vistaActual = $request->route()->getName(); // Usa el nombre de la ruta

            // ✅ Obtener el valor correctamente
            $ayudasVistas = $user->interactive_help;

            // Si es string (por si Laravel no lo casteó bien), decodifica
            if (is_string($ayudasVistas)) {
                $ayudasVistas = json_decode($ayudasVistas, true);
            }

            // Si aún no es array, forzar a array vacío
            if (!is_array($ayudasVistas)) {
                $ayudasVistas = [];
            }

            // Verificamos si ya visitó esta vista
            if (!in_array($vistaActual, $ayudasVistas)) {
                // Marcar que se debe mostrar la ayuda en esta vista
                session(['mostrar_ayuda' => true]);

                // Guardamos esta vista en el array y actualizamos al usuario
                $ayudasVistas[] = $vistaActual;
                $user->interactive_help = $ayudasVistas;
                $user->save();
            } else {
                session(['mostrar_ayuda' => false]);
            }
        }

        return $next($request);
    }
}
