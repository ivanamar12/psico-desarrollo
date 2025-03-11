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
