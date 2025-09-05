<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\Paciente;
use App\Models\AplicacionPrueba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AplicarPruebaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $aplicaciones = AplicacionPrueba::with('paciente', 'prueba')->get();

      return DataTables::of($aplicaciones)
        ->addColumn('fecha', function ($aplicacion) {
          return $aplicacion->created_at->format('d/m/Y');
        })
        ->addColumn('action', function ($aplicacion) {
          $btn = '<button type="button" class="btn btn-info btn-raised btn-xs ver-resultados" data-id="' . $aplicacion->id . '"><i class="zmdi zmdi-eye"></i></button>';

          if ($aplicacion->prueba->nombre === 'CUMANIN') {
            $btn .= ' <a href="' . route('resultados.pdf', $aplicacion->id) . '" class="btn btn-primary btn-raised btn-xs" target="_blank"><i class="zmdi zmdi-file"></i></a>';
          } elseif ($aplicacion->prueba->nombre === 'Koppitz') {
            $btn .= ' <a href="' . route('resultados.koppitz.pdf', $aplicacion->id) . '" class="btn btn-primary btn-raised btn-xs" target="_blank"><i class="zmdi zmdi-file"></i></a>';
          } elseif ($aplicacion->prueba->tipo === 'NO-Estandarizada') {
            $btn .= ' <a href="' . route('resultados.no_estandarizada.pdf', $aplicacion->id) . '" class="btn btn-primary btn-raised btn-xs" target="_blank"><i class="zmdi zmdi-file"></i></a>';
          }

          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $pacientes = Paciente::has('historiaclinicas')->get();
    $pruebas = Prueba::with('subescalas.items')->get();

    return view('aplicar-prueba.index', compact('pacientes', 'pruebas'));
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
    $resultado = \App\Models\ResultadosPruebas::where('aplicacion_pruebas_id', $prueba_id)->first();

    if (!$resultado) {
      return response()->json(['error' => 'Resultados no encontrados'], 404);
    }

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

  public function obtenerRespuestasPrueba($prueba_id)
  {
    $pruebaAplicada = AplicacionPrueba::with('paciente', 'prueba')->find($prueba_id);

    if (!$pruebaAplicada) {
      return response()->json(['error' => '⚠️ Prueba no encontrada en AplicacionPrueba'], 404);
    }

    return response()->json([
      'paciente' => [
        'id' => $pruebaAplicada->paciente->id,
        'nombre' => $pruebaAplicada->paciente->nombre,
        'fecha_nac' => $pruebaAplicada->paciente->fecha_nac,
        'genero_id' => $pruebaAplicada->paciente->genero_id
      ],
      'prueba' => [
        'id' => $pruebaAplicada->prueba->id,
        'nombre' => $pruebaAplicada->prueba->nombre,
        'resultados' => json_decode($pruebaAplicada->resultados, true),
        'fecha_aplicacion' => $pruebaAplicada->created_at->format('d/m/Y')
      ]
    ]);
  }
}
