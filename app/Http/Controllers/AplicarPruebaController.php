<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\SubEscala;
use App\Models\Item;
use App\Models\Baremos;
use App\Models\Paciente;
use App\Models\User;
use App\Models\AplicacionPrueba;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use PDF; 

class AplicarPruebaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $aplicaciones = AplicacionPrueba::with('paciente', 'prueba')->get();

            return DataTables::of($aplicaciones)
                ->addColumn('action', function ($aplicacion) {
                    return '<button type="button" class="btn btn-info btn-raised btn-xs ver-resultados" data-id="' . $aplicacion->id . '">
                                <i class="zmdi zmdi-eye"></i> Ver Resultados
                            </button>';
                })
                ->addColumn('fecha', function ($aplicacion) {
                    return $aplicacion->created_at->format('d/m/Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $pacientes = Paciente::all();
        $pruebas = Prueba::all();

        return view('aplicar_prueba.index', compact('pacientes', 'pruebas'));
    }

    public function obtenerPrueba($id)
    {
        $prueba = Prueba::with('subescalas.items')->findOrFail($id);
        return response()->json($prueba);
    }

    public function guardarRespuestas(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'prueba_id' => 'required|exists:pruebas,id',
            'respuestas' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            AplicacionPrueba::create([
                'user_id' => auth()->user()->id,
                'paciente_id' => $request->paciente_id,
                'prueba_id' => $request->prueba_id,
                'resultados' => json_encode($request->respuestas),
            ]);

            DB::commit();
            return response()->json(['message' => 'Prueba guardada correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al guardar la prueba'], 500);
        }
    }

    public function verRespuestasPrueba($prueba_id)
    {
        // Buscar el resultado de la prueba en la tabla resultados_pruebas
        $resultado = \App\Models\ResultadosPruebas::where('aplicacion_pruebas_id', $prueba_id)->first();

        if (!$resultado) {
            return response()->json(['error' => 'Resultados no encontrados'], 404);
        }

        // Obtener la información del paciente y la prueba aplicada
        $pruebaAplicada = \App\Models\AplicacionPrueba::with('paciente', 'prueba')->find($prueba_id);

        if (!$pruebaAplicada) {
            return response()->json(['error' => 'Prueba no encontrada'], 404);
        }

        return response()->json([
            'paciente' => $pruebaAplicada->paciente,
            'prueba' => [
                'id' => $pruebaAplicada->prueba->id,
                'nombre' => $pruebaAplicada->prueba->nombre,
                'resultados' => json_decode($resultado->resultados_finales, true),
                'fecha' => $pruebaAplicada->created_at->format('d/m/Y')
            ]
        ]);
    }

}
