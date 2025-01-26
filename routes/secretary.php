<?php

use App\Http\Controllers\SecretariaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
  // Ruta para la lista de secreatria
  Route::get('secretaria', [SecretariaController::class, 'index'])
    ->name('secretaria.index');

  // Ruta para almacenar un nuevo secretaria
  Route::post('secretaria', [SecretariaController::class, 'store'])
    ->name('secretaria.store');

  // Ruta para obtener una secretaria específico en formato JSON
  Route::get('secretaria/{id}', [SecretariaController::class, 'show'])
    ->name('secretaria.show');

  // Ruta para eliminar un secretaria
  Route::delete('secretaria/{id}', [SecretariaController::class, 'destroy'])
    ->name('secretaria.destroy');

  // Ruta para mostrar el formulario de edición de un secretaria
  Route::get('secretaria/{id}/edit', [SecretariaController::class, 'edit'])
    ->name('secretaria.edit');

  // Ruta para actualizar un secretaria
  Route::put('secretaria/{id}', [SecretariaController::class, 'update'])
    ->name('secretaria.update');
});
