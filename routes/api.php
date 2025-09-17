<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AplicarPruebaController;

//API para obtener las respuestas de una prueba aplicada
Route::get('/ver-respuestas-prueba/{id}', [AplicarPruebaController::class, 'verRespuestasPrueba']);

Route::get('/obtener-respuestas-prueba/{id}', [AplicarPruebaController::class, 'obtenerRespuestasPrueba']);
