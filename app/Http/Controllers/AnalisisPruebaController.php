<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\SubEscala;
use App\Models\Item;
use App\Models\Baremos;
use App\Models\Paciente;
use App\Models\User;
use App\Models\AplicacionPrueba;
use App\Models\ResultadosPruebas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use PDF; 

class AnalisisPruebaController extends Controller
{
    public function guardarResultados(Request $request)
    {
        try {
            $pruebaId = $request->input('prueba_id');
            $resultados = $request->input('resultados');
            $edadMeses = $request->input('edad_meses'); 
            $lateralidad = $request->input('lateralidad');
            $observaciones = $request->input('observaciones');

            if (ResultadosPruebas::where('aplicacion_pruebas_id', $pruebaId)->exists()) {
                return response()->json(['mensaje' => 'El resultado ya fue guardado previamente']);
            }

            $resultado = new ResultadosPruebas();
            $resultado->aplicacion_pruebas_id = $pruebaId;
            $resultado->resultados_finales = json_encode([
                'edad_meses' => $edadMeses, 
                'resultados' => $resultados,
                'lateralidad' => $lateralidad,
                'observaciones' => $observaciones
            ], JSON_UNESCAPED_UNICODE);
            $resultado->save();

            return response()->json(['mensaje' => 'Resultados guardados correctamente']);

        } catch (\Exception $e) {
            \Log::error("❌ Error guardando resultados: " . $e->getMessage());
            return response()->json(['error' => 'Error al guardar los resultados'], 500);
        }
    }
    
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
