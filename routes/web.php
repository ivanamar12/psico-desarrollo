<?php

use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\AplicarPruebaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ValidacionController;

Route::middleware('guest')->group(function () {
  Route::get('/', function () {
    return view('welcome');
  })->name('index');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/**
 * Auth Routes 
 */
require __DIR__ . '/auth.php';

/**
 * Specialist Routes 
 */
require __DIR__ . '/specialist.php';

/**
 * Secretary Routes 
 */
require __DIR__ . '/secretary.php';

Route::middleware(['auth', 'role:ADMIN'])->group(function () {
  // Audit Logs
  Route::get('bitacora', [AuditLogController::class, 'index'])
    ->name('bitacora.index');
});

Route::middleware('auth', 'update_last_activity')->group(function () {

  Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
  Route::post('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');

  Route::get('/perfil/list', [PerfilController::class, 'list'])->name('perfil.list');
  Route::get('/perfil/show/{id}', [PerfilController::class, 'show']);
  Route::get('/perfil/edit/{id}', [PerfilController::class, 'edit']);

  Route::delete('perfil/delete/{id}', [PerfilController::class, 'destroy'])->name('perfil.delete');

  Route::get('/notificaciones', [NotificacionController::class, 'getNotifications'])->name('notificaciones.get');
  Route::post('/notificaciones/leer/{id}', [NotificacionController::class, 'markAsRead'])->name('notificaciones.leer');
  Route::post('/notificaciones/leer-todas', [NotificacionController::class, 'markAllAsRead'])->name('notificaciones.leer_todas');
  Route::delete('/notificaciones/eliminar/{id}', [NotificacionController::class, 'deleteNotification'])->name('notificaciones.eliminar');

  Route::get('representantes', [RepresentativeController::class, 'index'])
    ->name('representantes.index');

  // Ruta para almacenar un nuevo representantes
  Route::post('representantes', [RepresentativeController::class, 'store'])
    ->name('representantes.store');

  // Ruta para eliminar un representante
  Route::delete('representantes/{id}', [RepresentativeController::class, 'destroy'])
    ->name('representantes.destroy');

  // Ruta para mostrar el formulario de edición de un representante
  Route::get('representantes/{id}/edit', [RepresentativeController::class, 'edit'])
    ->name('representantes.edit');

  // Ruta para actualizar un representante
  Route::put('representantes/{id}', [RepresentativeController::class, 'update'])
    ->name('representantes.update');

  // Ruta para obtener una secretaria específico en formato JSON
  Route::get('representantes/{id}', [RepresentativeController::class, 'show'])
    ->name('representantes.show');

  // Ruta para la lista de paciente
  Route::get('paciente', [PacienteController::class, 'index'])
    ->name('paciente.index');

  // Ruta para almacenar un nuevo paciente
  Route::post('paciente', [PacienteController::class, 'store'])
    ->name('paciente.store');

  // Ruta para eliminar un paciente
  Route::delete('paciente/{id}', [PacienteController::class, 'destroy'])
    ->name('paciente.destroy');

  // Ruta para mostrar el formulario de edición de un paciente
  Route::get('pacientes/{id}/edit', [PacienteController::class, 'edit'])
    ->name('paciente.edit');

  // Ruta para obtener un paciente específico en formato JSON
  Route::get('paciente/{id}', [PacienteController::class, 'show'])
    ->name('paciente.show');

  // Ruta para pacientes y especialistas
  Route::get('citas', [CitaController::class, 'index'])
    ->name('citas.index');

  // Ruta para mostrar las citas 
  Route::get('citas/web', [CitaController::class, 'indexWeb'])
    ->name('citas.indexWeb');

  // Ruta para agendar nueva cita
  Route::post('citas', [CitaController::class, 'store'])
    ->name('citas.store');

  Route::get('citas/{id}/edit', [CitaController::class, 'edit'])
    ->name('citas.edit');

  // Ruta para actualizar el status de la cita
  Route::put('citas/{id}', [CitaController::class, 'update'])
    ->name('citas.update');

  // Ruta para descargar reporte de todas las citas
  Route::get('pdf/citas', [CitaController::class, 'generarPdfTodasLasCitas'])
    ->name('pdf.citas');

  // Ruta para descargar reporte de todas las citas del dia
  Route::get('pdf/citas_hoy', [CitaController::class, 'citasDeHoy'])
    ->name('pdf.citas_hoy');

  // Ruta para descargar reporte de una cita
  Route::get('pdf/generarPdfCita/{id}', [CitaController::class, 'generarPdfCita'])
    ->name('pdf.generarPdfCita');

  // Ruta para la lista de historias
  Route::get('historias', [HistoriaClinicaController::class, 'index'])
    ->name('historias.index');

  // Ruta para creae nueva historia
  Route::post('historias', [HistoriaClinicaController::class, 'store'])
    ->name('historias.store');

  // Rutas para especialidad
  Route::resource('especialidad', EspecialidadController::class)
    ->except(['destroy', 'show']);

  // Ruta para eliminar una historia
  Route::delete('historias/{id}', [HistoriaClinicaController::class, 'destroy'])
    ->name('historias.destroy');

  // Ruta para descargar reporte de una historia clínica
  Route::get('pdf/generarPdfHistoria/{id}', [HistoriaClinicaController::class, 'generarPdfHistoria'])
    ->name('pdf.generarPdfHistoria');

  // Ruta para la lista de pruebas
  Route::get('pruebas', [PruebaController::class, 'index'])
    ->name('pruebas.index');

  // Ruta para aplicar prueba
  Route::get('aplicar_prueba', [AplicarPruebaController::class, 'index'])
    ->name('aplicar_prueba.index');

  Route::get('aplicar-prueba/{id}', [AplicarPruebaController::class, 'obtenerPrueba']);

  Route::post('/aplicar-prueba/guardar', [AplicarPruebaController::class, 'guardarRespuestas']);

  Route::get('/calcular-edad/{id}', [AplicarPruebaController::class, 'calcularEdadPaciente']);

  Route::get('pruebas/{id}', [PruebaController::class, 'show'])
    ->name('pruebas.show')
    ->middleware('auth');

  Route::get('/obtener-fecha-nacimiento/{paciente_id}', function ($paciente_id) {
    $paciente = \App\Models\Paciente::find($paciente_id);

    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    return response()->json(['fecha_nacimiento' => $paciente->fecha_nac]);
  });

  Route::get('/aplicar-prueba/ver-respuestas/{prueba_id}', [AplicarPruebaController::class, 'verRespuestasPrueba']);

  Route::get('/resultados-pdf/{id}', [AplicarPruebaController::class, 'generarPDF'])->name('resultados.pdf');

  Route::get('/resultados/koppitz/{id}', [AplicarPruebaController::class, 'generarPDFKoppitz'])->name('resultados.koppitz.pdf');

  Route::get('/resultados/no-estandarizada/{id}', [AplicarPruebaController::class, 'generarPDFNoEstandarizada'])
    ->name('resultados.no_estandarizada.pdf');

  Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

  Route::get('/verificar-email', [ValidacionController::class, 'verificarEmail']);
});

// Grupo de rutas que utiliza el middleware 'web'
Route::middleware(['web', 'auth'])->group(function () {

  // Ruta para almacenar un nueva prueba
  Route::post('pruebas/prueba', [PruebaController::class, 'storePrueba'])
    ->name('pruebas.storePrueba');

  Route::delete('pruebas/{id}', [PruebaController::class, 'destroy'])
    ->name('pruebas.destroy');
});
