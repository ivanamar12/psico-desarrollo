<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalisisPruebaController extends Controller
{
  public function analizarPrueba(Request $request)
  {
    $pruebaId = $request->prueba_id;
    $tipoPrueba = $request->tipo_prueba;
    $nombrePrueba = $request->nombre;

    return response()->json([
      'mensaje' => 'Ejecutando análisis en JavaScript',
      'prueba_id' => $pruebaId,
      'tipo_prueba' => $tipoPrueba,
      'nombre' => $nombrePrueba
    ]);
  }
}
