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

            $vistaActual = $request->route()->getName(); 
            $ayudasVistas = $user->interactive_help;
            if (is_string($ayudasVistas)) {
                $ayudasVistas = json_decode($ayudasVistas, true);
            }
            if (!is_array($ayudasVistas)) {
                $ayudasVistas = [];
            }
            if (!in_array($vistaActual, $ayudasVistas)) {
                session(['mostrar_ayuda' => true]);

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
