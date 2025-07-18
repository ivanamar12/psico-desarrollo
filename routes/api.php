<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\AnalisisPruebaController;
use App\Http\Controllers\AplicarPruebaController;
use App\Http\Controllers\DashboardController;
use App\Models\AplicacionPrueba;
use App\Models\Baremos;
use App\Models\SubEscala;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API para obtener la historia clínica de un paciente
Route::get('/historia/{id}', [HistoriaClinicaController::class, 'verHistoria'])->defaults('tipo', 'api');

// Obtener la última prueba completa con resultados
Route::get('/ultima-prueba', function () {
    $prueba = AplicacionPrueba::with('paciente', 'prueba')->latest()->first();

    if (!$prueba) {
        return response()->json(['mensaje' => 'No hay pruebas registradas']);
    }

    return response()->json([
        'prueba' => [
            'id' => $prueba->id,
            'tipo' => $prueba->prueba->tipo,
            'nombre' => $prueba->prueba->nombre,
            'resultados' => $prueba->resultados,
            'observaciones' => $prueba->observaciones,
            'genero_id' => $prueba->paciente->genero_id
        ]
    ]);
});

// Ejecutar el análisis POST
Route::post('/verificar-nueva-prueba', [AnalisisPruebaController::class, 'verificarNuevaPrueba']);


// API para analizar una prueba automáticamente
Route::post('/analizar-prueba', [AnalisisPruebaController::class, 'analizarPrueba']);

Route::get('/subescalas', function () {
    try {
        $subescalas = SubEscala::all(['id', 'sub_escala']);
        return response()->json($subescalas);
    } catch (\Exception $e) {
        \Log::error("Error obteniendo subescalas: " . $e->getMessage());
        return response()->json(['error' => 'Error obteniendo subescalas'], 500);
    }
});

//API para guardar los resultados analizados de una prueba
Route::post('/guardar-resultados', [AnalisisPruebaController::class, 'guardarResultados']);

//API para obtener las respuestas de una prueba aplicada
Route::get('/ver-respuestas-prueba/{id}', [AplicarPruebaController::class, 'verRespuestasPrueba']);

//API para obtener los baremos desde la base de datos
Route::get('/baremos', function () {
    return response()->json(Baremos::all());
});

Route::get('/obtener-respuestas-prueba/{id}', [AplicarPruebaController::class, 'obtenerRespuestasPrueba']);


Route::get('estadisticas-pacientes', [DashboardController::class, 'estadisticasPacientes'])
    ->name('estadisticas.pacientes');
