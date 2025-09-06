<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\AplicarPruebaController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API para obtener la historia clínica de un paciente
Route::get('/historia/{id}', [HistoriaClinicaController::class, 'verHistoria'])->defaults('tipo', 'api');

//API para obtener las respuestas de una prueba aplicada
Route::get('/ver-respuestas-prueba/{id}', [AplicarPruebaController::class, 'verRespuestasPrueba']);

Route::get('/obtener-respuestas-prueba/{id}', [AplicarPruebaController::class, 'obtenerRespuestasPrueba']);

Route::get('estadisticas-pacientes', [DashboardController::class, 'estadisticasPacientes'])
    ->name('estadisticas.pacientes');
