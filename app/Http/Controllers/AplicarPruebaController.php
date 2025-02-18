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

    public function verResultadosPrueba($prueba_id)
    {
        // Obtener la prueba aplicada junto con el paciente
        $prueba = AplicacionPrueba::with('paciente')->find($prueba_id);

        if (!$prueba) {
            return response()->json(['error' => 'Prueba no encontrada'], 404);
        }

        // Retornar los resultados de la prueba
        return response()->json([
            'paciente' => $prueba->paciente,
            'resultados' => json_decode($prueba->respuestas, true),
        ]);
    }
}
