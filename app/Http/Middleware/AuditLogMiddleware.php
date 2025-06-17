<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuditLogMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $response = $next($request);
    $route = Route::currentRouteName();

    $description = $this->descriptions[$route] ?? null;

    if ($description && Auth::user()) {
      AuditLog::create([
        'user_id' => Auth::user()->id,
        'action' => $description,
      ]);
    }

    return $response;
  }

  protected $descriptions = [
    // Representantes
    'representantes.store' => 'Crear nuevo representante',
    'representantes.update' => 'Actualizar representante',
    'representantes.destroy' => 'Eliminar representante',

    // Pacientes
    'paciente.store' => 'Crear nuevo paciente',
    'paciente.update' => 'Actualizar paciente',
    'paciente.destroy' => 'Eliminar paciente',

    // Citas
    'citas.store' => 'Agendar nueva cita',
    'citas.update' => 'Actualizar cita',

    // Historias Clínicas
    'historias.store' => 'Crear nueva historia clínica',
    'historias.destroy' => 'Eliminar historia clínica',

    // Pruebas
    'pruebas.storePrueba' => 'Crear nueva prueba',
    'pruebas.destroy' => 'Eliminar prueba',

    // Perfil
    'perfil.update' => 'Actualizar perfil de usuario',
    'perfil.delete' => 'Eliminar cuenta de usuario',

    // Notificaciones
    'notificaciones.marcar-todas' => 'Marcar todas las notificaciones como leídas',
    'notificaciones.destroy' => 'Eliminar notificación',

    // Auditoría (GET)
    'bitacora.index' => 'Ver bitácora de auditoría',
  ];
}
