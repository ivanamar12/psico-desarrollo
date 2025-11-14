<?php

use App\Enums\Role;
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
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ConstanciaAsistenciaController;
use App\Http\Controllers\PdfPruebasController;
use App\Http\Controllers\ReferenciaController;

Route::middleware('guest')->group(function () {
  Route::get('/', fn() => view('welcome'))->name('index');
});

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

Route::middleware('auth')->group(function () {
  /**
   * Dashboard
   */
  Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

  Route::get('/estadisticas/escolarizacion', [DashboardController::class, 'estadisticasEscolarizacion'])
    ->name('estadisticas.escolarizacion');

  Route::get('/estadisticas/pacientes', [DashboardController::class, 'estadisticasPacientes'])
    ->name('estadisticas.pacientes');

  /**
   * Profile
   */
  Route::get('/perfil', [PerfilController::class, 'index'])
    ->name('perfil.index');

  Route::post('/perfil/update', [PerfilController::class, 'update'])
    ->name('perfil.update');

  Route::get('/perfil/list', [PerfilController::class, 'list'])
    ->name('perfil.list');

  Route::get('/perfil/show/{id}', [PerfilController::class, 'show']);

  Route::get('/perfil/edit/{id}', [PerfilController::class, 'edit']);

  Route::delete('perfil/delete/{id}', [PerfilController::class, 'destroy'])
    ->name('perfil.delete');

  /**
   * Notifications routes
   */

  Route::get('/api/notificaciones', [NotificacionController::class, 'getNotifications'])
    ->name('notificaciones.get');

  Route::get('/notificaciones', [NotificacionController::class, 'index'])
    ->name('notificaciones.index');

  Route::get('/notificaciones/redirigir/{id}', [NotificacionController::class, 'markAsReadAndRedirect'])
    ->name('notificaciones.redirigir');

  Route::post('/notificaciones/marcar-todas', [NotificacionController::class, 'markAllAsRead'])
    ->name('notificaciones.marcar-todas');

  Route::delete('/notificaciones/{id}', [NotificacionController::class, 'destroy'])
    ->name('notificaciones.destroy');

  /**
   * Representantes routes
   */
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

  /**
   * Pacientes
   */

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

  /**
   * Informes
   */
  Route::get('informes', [InformeController::class, 'index'])
    ->name('informes.index');

  Route::post('informes', [InformeController::class, 'store'])
    ->name('informes.store');

  // Informe en PDF
  Route::get('informes/{informe}/pdf', [InformeController::class, 'pdfInforme'])
    ->name('informes.pdf');

  Route::delete('informes/{informe}', [InformeController::class, 'destroy'])
    ->name('informes.destroy');

  // Ruta para descargar reporte de una historia clínica
  Route::get('informes/pdf-historia/{pacienteId}', [InformeController::class, 'pdfHistoria'])
    ->name('informes.pdf-historia');

  /**
   * Referencias
   */
  Route::get('referencias', [ReferenciaController::class, 'index'])
    ->name('referencias.index');

  Route::post('referencias', [ReferenciaController::class, 'store'])
    ->name('referencias.store');

  Route::delete('referencias/{referencia}', [ReferenciaController::class, 'destroy'])
    ->name('referencias.destroy');

  // Referencia en PDF
  Route::get('referencias/{referencia}/pdf', [ReferenciaController::class, 'pdfReferencia'])
    ->name('referencias.pdf');

  /**
   * Constancias de asistencia
   */
  Route::get('constancias-asistencia', [ConstanciaAsistenciaController::class, 'index'])
    ->name('constancias-asistencia.index');

  Route::post('constancias-asistencia', [ConstanciaAsistenciaController::class, 'store'])
    ->name('constancias-asistencia.store');

  /**
   * Citas
   */

  // Ruta para pacientes y especialistas
  Route::get('citas', [CitaController::class, 'index'])
    ->name('citas.index');

  // Ruta para mostrar las citas 
  Route::get('citas/calendario', [CitaController::class, 'calendario'])
    ->name('citas.calendario');

  // Ruta para agendar nueva cita
  Route::post('citas', [CitaController::class, 'store'])
    ->name('citas.store');

  Route::get('citas/{id}/edit', [CitaController::class, 'edit'])
    ->name('citas.edit');

  // Ruta para actualizar el status de la cita
  Route::put('citas/{id}', [CitaController::class, 'update'])
    ->name('citas.update');

  // Pdfs

  // Ruta para descargar reporte de todas las citas
  Route::get('citas/report', [CitaController::class, 'reportAll'])
    ->name('citas.report.all');

  // Ruta para descargar reporte de todas las citas del dia
  Route::get('citas/report/today', [CitaController::class, 'reportAllToday'])
    ->name('citas.report.today');

  // Rutas para PDFs de especialistas
  Route::middleware(['role:' . Role::ESPECIALISTA->value])->group(function () {
    Route::get('citas/report/specialist', [CitaController::class, 'reportAllSpecialist'])
      ->name('citas.report.all.specialist');

    Route::get('citas/report/specialist/today', [CitaController::class, 'reportAllTodaySpecialist'])
      ->name('citas.report.today.specialist');
  });

  // Ruta para descargar reporte de una cita
  Route::get('citas/report/{id}', [CitaController::class, 'report'])
    ->name('citas.report');

  /**
   * Historias
   */

  // Ruta para la lista de historias
  Route::get('historias', [HistoriaClinicaController::class, 'index'])
    ->name('historias.index');

  // Ruta para creae nueva historia
  Route::post('historias', [HistoriaClinicaController::class, 'store'])
    ->name('historias.store');

  // Ruta para eliminar una historia
  Route::delete('historias/{id}', [HistoriaClinicaController::class, 'destroy'])
    ->name('historias.destroy');

  // Ruta para descargar reporte de una historia clínica
  Route::get('historias/report/{id}', [HistoriaClinicaController::class, 'report'])
    ->name('historias.report');

  /**
   * Rutas para especialidad
   */
  Route::resource('especialidad', EspecialidadController::class)
    ->except(['create', 'destroy', 'show']);

  /**
   * Pruebas
   */

  // Ruta para la lista de pruebas
  Route::get('pruebas', [PruebaController::class, 'index'])
    ->name('pruebas.index');

  // Ruta para almacenar un nueva prueba
  Route::post('pruebas', [PruebaController::class, 'store'])
    ->name('pruebas.store');

  Route::get('pruebas/{id}', [PruebaController::class, 'show'])
    ->name('pruebas.show');

  Route::delete('pruebas/{id}', [PruebaController::class, 'destroy'])
    ->name('pruebas.destroy');

  /**
   * Aplicacion de Pruebas
   */

  // Ruta para aplicar prueba
  Route::get('aplicar-prueba', [AplicarPruebaController::class, 'index'])
    ->name('aplicar-prueba.index');

  Route::post('aplicar-prueba', [AplicarPruebaController::class, 'store'])
    ->name('aplicar-prueba.store');

  Route::get('aplicar-prueba/{id}', [AplicarPruebaController::class, 'show'])
    ->name('aplicar-prueba.show');

  // Pdfs de pruebas:
  Route::get('aplicar-prueba/report/cumanin/{id}', [PdfPruebasController::class, 'reportCumanin'])
    ->name('aplicar-prueba.report.cumanin');

  Route::get('aplicar-prueba/report/koppitz/{id}', [PdfPruebasController::class, 'reportKoppitz'])
    ->name('aplicar-prueba.report.koppitz');

  Route::get('aplicar-prueba/report/no-estandarizada/{id}', [PdfPruebasController::class, 'reportNoEstandarizada'])
    ->name('aplicar-prueba.report.no-estandarizada');

  /**
   * Para validaciones en formularios
   */
  Route::get('/verificar-email', [ValidacionController::class, 'verificarEmail']);
  Route::get('/verificar-telefono', [ValidacionController::class, 'verificarTelefono']);
  Route::get('/verificar-cedula', [ValidacionController::class, 'verificarCedula']);
});
