<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\AnalisisPruebaController;
use App\Models\AplicacionPrueba;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/historia/{id}', [HistoriaClinicaController::class, 'verHistoria'])->defaults('tipo', 'api');

Route::get('/ultima-prueba', function () {
    $prueba = AplicacionPrueba::latest()->first();

    if (!$prueba) {
        return response()->json(['mensaje' => 'No hay pruebas registradas']);
    }

    return response()->json([
        'prueba' => [
            'id' => $prueba->id,
            'tipo' => $prueba->prueba->tipo,  
            'nombre' => $prueba->prueba->nombre  
        ]
    ]);
});

Route::post('/analizar-prueba', [AnalisisPruebaController::class, 'analizarPrueba']);


