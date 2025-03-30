<?php

use App\Http\Controllers\EspecialistaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
  // Ruta para la lista de especialistas
  Route::get('especialista', [EspecialistaController::class, 'index'])
    ->name('especialista.index');

  // Ruta para obtener un especialista específico en formato JSON
  Route::get('especialistas/{id}', [EspecialistaController::class, 'show'])
    ->name('especialista.show');

  // Ruta para almacenar un nuevo especialista
  Route::post('especialista', [EspecialistaController::class, 'store'])
    ->name('especialista.store');

  // Ruta para mostrar un especialista específico
  Route::get('especialista/{id}', [EspecialistaController::class, 'show'])
    ->name('especialista.show');

  // Ruta para mostrar el formulario de edición de un especialista
  Route::get('especialista/{id}/edit', [EspecialistaController::class, 'edit'])
    ->name('especialista.edit');

  // Ruta para actualizar un especialista específico
  Route::put('especialista/{id}', [EspecialistaController::class, 'update'])
    ->name('especialista.update');

  // Ruta para eliminar un especialista específico
  Route::delete('especialista/{id}', [EspecialistaController::class, 'destroy'])
    ->name('especialista.destroy');
});
