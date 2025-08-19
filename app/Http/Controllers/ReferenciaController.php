<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Referencia\StoreReferenciaRequest;
use App\Models\Especialista;
use App\Models\Paciente;
use App\Models\Referencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReferenciaController extends Controller
{
  public function index(Request $request)
  {
    $especialista = Especialista::where('user_id', Auth::id())->first();

    if ($request->ajax()) {
      try {
        $referencias = Referencia::with(['paciente', 'especialista']);

        if (auth()->user()->hasRole(Role::ESPECIALISTA->value)) {
          $referencias->where('especialista_id', $especialista->id);
        }

        return DataTables::of($referencias)
          ->addColumn('action', function ($referencia) {
            $acciones = '<a href="' . route('referencias.pdf', $referencia->id) . '" class="btn btn-primary btn-raised btn-xs" 
                            target="_blank" title="Reporte">
                          <i class="zmdi zmdi-file"></i>
                        </a>';

            if (auth()->user()->can('eliminar referencia')) {
              $acciones .= '<button data-id="' . $referencia->id . '" 
                                    class="btn-eliminar-referencia btn btn-danger btn-raised btn-xs" 
                                    title="Eliminar">
                              <i class="zmdi zmdi-delete"></i>
                            </button>';
            }

            return $acciones;
          })
          ->editColumn('created_at', function ($referencia) {
            return $referencia->created_at->format('d/m/Y');
          })
          ->rawColumns(['action'])
          ->make(true);
      } catch (\Exception $e) {
        return response()->json([
          'error' => 'Error al cargar datos: ' . $e->getMessage()
        ], 500);
      }
    }

    $pacientes = Paciente::with([
      'historiaClinicas' => function ($q) {
        $q->orderByDesc('created_at')->limit(1);
      }
    ])
      ->whereHas('historiaClinicas')
      ->get();

    return view('referencias.index', [
      'especialista_actual' => $especialista,
      'pacientes' => $pacientes,
    ]);
  }

  public function store(StoreReferenciaRequest $request)
  {
    try {
      DB::transaction(function () use ($request) {
        $fechaEmision = now();
        $fechaVencimiento = now()->addMonth();

        Referencia::create([
          'fecha_emision' => $fechaEmision,
          'fecha_vencimiento' => $fechaVencimiento,
          'titulo' => $request->titulo,
          'motivo' => $request->motivo,

          'presentacion_caso' => $request->presentacion_caso,
          'antecedentes' => $request->antecedentes,
          'indicadores_psicologicos' => $request->indicadores_psicologicos,
          'sugerencias' => $request->sugerencias,

          'especialista_id' => $request->especialista_id,
          'paciente_id' => $request->paciente_id
        ]);
        // - Notificar al paciente o administrador
      });

      return response()->json([
        'success' => true,
        'message' => 'Referencia creada correctamente!',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error al crear la referencia: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy($id)
  {
    try {
      $referencia = Referencia::findOrFail($id);

      if (!auth()->user()->can('eliminar referencia')) {
        return response()->json([
          'success' => false,
          'message' => 'No tienes permiso para eliminar referencias'
        ], 403);
      }

      $referencia->delete();

      return response()->json([
        'success' => true,
        'message' => 'Referencia eliminada correctamente!'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error al eliminar la referencia: ' . $e->getMessage()
      ], 500);
    }
  }
}
