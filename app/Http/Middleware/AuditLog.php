<?php

namespace App\Http\Middleware;

use App\Models\AuditLog as ModelsAuditLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuditLog
{
  public function handle(Request $request, Closure $next)
  {
    $response = $next($request);

    if (!Auth::check()) {
      return $response;
    }

    // Obtener el nombre de la ruta actual y el método HTTP
    $routeName = Route::currentRouteName() ?? 'unknown';
    $method = $request->method(); // GET, POST, PUT, DELETE

    // Guardar en la bitácora
    ModelsAuditLog::create([
      'user_id' => Auth::id(),
      'action' => "$method $routeName", // Ejemplo: "POST crear_paciente"
    ]);

    return $response;
  }
}

