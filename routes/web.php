<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\PruebasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Ruta para la lista de especialistas
Route::get('especialista', [EspecialistaController::class, 'index'])
    ->name('especialista.index')
    ->middleware('auth');

// Ruta para obtener un especialista específico en formato JSON
Route::get('especialista/{id}', [EspecialistaController::class, 'show'])
    ->name('especialista.show')
    ->middleware('auth'); 


// Ruta para almacenar un nuevo especialista
Route::post('especialista', [EspecialistaController::class, 'store'])
    ->name('especialista.store')
    ->middleware('auth');

// Ruta para mostrar un especialista específico
Route::get('especialista/{id}', [EspecialistaController::class, 'show'])
    ->name('especialista.show')
    ->middleware('auth');

// Ruta para mostrar el formulario de edición de un especialista
Route::get('especialista/{id}/edit', [EspecialistaController::class, 'edit'])
    ->name('especialista.edit')
    ->middleware('auth');

// Ruta para actualizar un especialista específico
Route::put('especialista/{id}', [EspecialistaController::class, 'update'])
    ->name('especialista.update')
    ->middleware('auth');

// Ruta para eliminar un especialista específico
Route::delete('especialista/{id}', [EspecialistaController::class, 'destroy'])
    ->name('especialista.destroy')
    ->middleware('auth');

// Ruta para la lista de secreatria
Route::get('secretaria', [SecretariaController::class, 'index'])
    ->name('secretaria.index')
    ->middleware('auth');

// Ruta para almacenar un nuevo secretaria
Route::post('secretaria', [SecretariaController::class, 'store'])
    ->name('secretaria.store')
    ->middleware('auth');

// Ruta para obtener una secretaria específico en formato JSON
Route::get('secretaria/{id}', [SecretariaController::class, 'show'])
    ->name('secretaria.show')
    ->middleware('auth'); 

// Ruta para eliminar un secretaria
Route::delete('secretaria/{id}', [SecretariaController::class, 'destroy'])
    ->name('secretaria.destroy')
    ->middleware('auth');

// Ruta para mostrar el formulario de edición de un secretaria
Route::get('secretaria/{id}/edit', [SecretariaController::class, 'edit'])
    ->name('secretaria.edit')
    ->middleware('auth');

// Ruta para actualizar un secretaria
Route::put('secretaria/{id}', [SecretariaController::class, 'update'])
    ->name('secretaria.update')
    ->middleware('auth');

// Ruta para la lista de representantes
Route::get('representantes', [RepresentativeController::class, 'index'])
->name('representantes.index')
->middleware('auth');

// Ruta para almacenar un nuevo representantes
Route::post('representantes', [RepresentativeController::class, 'store'])
    ->name('representantes.store')
    ->middleware('auth');

// Ruta para eliminar un representante
Route::delete('representantes/{id}', [RepresentativeController::class, 'destroy'])
    ->name('representantes.destroy')
    ->middleware('auth');

// Ruta para mostrar el formulario de edición de un representante
Route::get('representantes/{id}/edit', [RepresentativeController::class, 'edit'])
    ->name('representantes.edit')
    ->middleware('auth');

// Ruta para actualizar un representante
Route::put('representantes/{id}', [RepresentativeController::class, 'update'])
    ->name('representantes.update')
    ->middleware('auth');

// Ruta para obtener una secretaria específico en formato JSON
Route::get('representantes/{id}', [RepresentativeController::class, 'show'])
    ->name('representantes.show')
    ->middleware('auth'); 

// Ruta para la lista de paciente
Route::get('paciente', [PacienteController::class, 'index'])
    ->name('paciente.index')
    ->middleware('auth');

// Ruta para almacenar un nuevo paciente
Route::post('paciente', [PacienteController::class, 'store'])
    ->name('paciente.store')
    ->middleware('auth');

// Ruta para eliminar un paciente
Route::delete('paciente/{id}', [PacienteController::class, 'destroy'])
    ->name('paciente.destroy')
    ->middleware('auth');

// Ruta para mostrar el formulario de edición de un paciente
Route::get('paciente/{id}/edit', [PacienteController::class, 'edit'])
    ->name('paciente.edit')
    ->middleware('auth');

// Ruta para pacientes y especialistas
Route::get('citas', [CitaController::class, 'index'])
    ->name('citas.index')
    ->middleware('auth');

// Ruta para mostrar las citas 
Route::get('citas/web', [CitaController::class, 'indexWeb'])
    ->name('citas.indexWeb')
    ->middleware('auth');

// Ruta para agendar nueva cita
Route::post('citas', [CitaController::class, 'store'])
    ->name('citas.store')
    ->middleware('auth');

    Route::get('citas/{id}/edit', [CitaController::class, 'edit'])
    ->name('citas.edit')
    ->middleware('auth');

// Ruta para actualizar el status de la cita
Route::put('citas/{id}', [CitaController::class, 'update'])
    ->name('citas.update')
    ->middleware('auth');

// Ruta para descargar reporte de todas las citas
Route::get('pdf/citas', [CitaController::class, 'generarPdfTodasLasCitas'])
    ->name('pdf.citas')
    ->middleware('auth');

// Ruta para descargar reporte de todas las citas del dia
Route::get('pdf/citas_hoy', [CitaController::class, 'citasDeHoy'])
    ->name('pdf.citas_hoy')
    ->middleware('auth');

// Ruta para descargar reporte de una cita
Route::get('pdf/generarPdfCita/{id}', [CitaController::class, 'generarPdfCita'])
    ->name('pdf.generarPdfCita')
    ->middleware('auth');

// Ruta para la lista de historias
Route::get('historias', [HistoriaClinicaController::class, 'index'])
    ->name('historias.index')
    ->middleware('auth');

// Ruta para creae nueva historia
Route::post('historias', [HistoriaClinicaController::class, 'store'])
    ->name('historias.store')
    ->middleware('auth');

// Ruta para almacenar una nueva especialidad
Route::post('especialidad', [EspecialidadController::class, 'store'])
    ->name('especialidad.store')
    ->middleware('auth'); 

// Ruta para eliminar una historia
Route::delete('historias/{id}', [HistoriaClinicaController::class, 'destroy'])
    ->name('historias.destroy')
    ->middleware('auth');
    
// Ruta para descargar reporte de una historia clínica
Route::get('pdf/generarPdfHistoria/{id}', [HistoriaClinicaController::class, 'generarPdfHistoria'])
    ->name('pdf.generarPdfHistoria')
    ->middleware('auth');

// Ruta para la lista de pruebas
Route::get('pruebas', [PruebasController::class, 'index'])
    ->name('pruebas.index')
    ->middleware('auth');
