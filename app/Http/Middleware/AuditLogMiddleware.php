<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class AuditLogMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $response = $next($request);
    $route = Route::currentRouteName();

    if (!$route) return $response;

    $description = $this->descriptions[$route] ?? null;

    if ($description && Auth::check()) {
      $userId = Auth::id();
      $yaRegistrado = AuditLog::where('user_id', $userId)
        ->where('action', $description)
        ->where('created_at', '>=', Carbon::now()->subSeconds(60))
        ->exists();

      if (!$yaRegistrado) {
        AuditLog::create([
          'user_id' => $userId,
          'action' => $description,
        ]);
      }
    }

    return $response;
  }

  protected $descriptions = [
    // Especialistas
    'especialista.store' => 'Crear nuevo especialista',
    'especialista.update' => 'Actualizar especialista',
    'especialista.destroy' => 'Eliminar especialista',

    // Secretarias
    'secretaria.store' => 'Crear nueva secretaria',
    'secretaria.update' => 'Actualizar secretaria',
    'secretaria.destroy' => 'Eliminar secretaria',

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

    // Informe
    'informes.store' => 'Crear nuevo informe',

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
