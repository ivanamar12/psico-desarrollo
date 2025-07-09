<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Paciente;
use App\Models\Informe;
use App\Models\AplicacionPrueba;
use App\Models\Prueba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class InformeController extends Controller
{
  	public function index(Request $request)
	{
	    $userId = Auth::id();

	    // Buscar el especialista por user_id
	    $especialista = Especialista::where('user_id', $userId)->first();

	    // Pacientes con 3-4 pruebas aplicadas por este usuario
	    $pacientesConPruebas = AplicacionPrueba::select('paciente_id', DB::raw('COUNT(*) as total'))
	        ->where('user_id', $userId)
	        ->groupBy('paciente_id')
	        ->havingRaw('total BETWEEN 3 AND 4')
	        ->pluck('paciente_id')
	        ->toArray();

	    // Cargar pacientes con su historia clínica más reciente y relaciones completas
	    $pacientes = Paciente::with([
	        // Última historia clínica con relaciones internas
	        'historiaClinicas' => function ($q) {
	            $q->with([
	                'historiaDesarrollo',
	                'historiaEscolar',
	                'antecedenteMedico'
	            ])->orderByDesc('created_at')->limit(1);
	        },
	        'datosEconomico',
	        'parentescos',
	        'representante.direccion.estado',
	        'representante.direccion.municipio',
	        'representante.direccion.parroquia'
	    ])
	    ->withCount('historiaClinicas')
	    ->whereIn('id', $pacientesConPruebas)
	    ->whereHas('historiaClinicas')
	    ->get();

	    // Obtener todas las pruebas aplicadas (con sus pruebas) agrupadas por paciente
	    $aplicaciones = AplicacionPrueba::with('prueba')
	        ->whereIn('paciente_id', $pacientesConPruebas)
	        ->get()
	        ->groupBy('paciente_id');

	    $especialistas = Especialista::all();
	    $informes = Informe::all();

	    return view('informes.index', [
	        'especialista_actual' => $especialista,
	        'especialistas' => $especialistas,
	        'pacientes' => $pacientes,
	        'informes' => $informes,
	        'aplicaciones' => $aplicaciones,
	    ]);
	}
}
