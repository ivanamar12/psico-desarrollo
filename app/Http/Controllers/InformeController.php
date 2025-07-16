<?php

namespace App\Http\Controllers;

use App\Http\Requests\Informe\StoreInformeRequest;
use App\Models\Especialista;
use App\Models\Paciente;
use App\Models\Informe;
use App\Models\AplicacionPrueba;
use App\Models\HistoriaClinica;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InformeController extends Controller
{
	public function index(Request $request)
	{
		$userId = Auth::id();
		$especialista = Especialista::where('user_id', $userId)->first();

		if ($request->ajax()) {
			$informes = Informe::with(['paciente', 'especialista'])
				->where('especialista_id', $especialista->id)
				->select('*');

			return DataTables::of($informes)
				->addColumn('action', function ($informe) {
					$acciones = '';

					if (auth()->user()->can('ver informes')) {
						$acciones .= '<a href="' . route('informes.show', $informe->id) . '" class="btn btn-info btn-raised btn-xs" title="Ver"><i class="zmdi zmdi-eye"></i></a> ';
					}

					if (auth()->user()->can('eliminar informes')) {
						$acciones .= '<a href="javascript:void(0)" onclick="deleteInforme(' . $informe->id . ')" class="btn btn-danger btn-raised btn-xs" title="Eliminar"><i class="zmdi zmdi-delete"></i></a>';
					}

					return $acciones;
				})
				->editColumn('created_at', function ($informe) {
					return $informe->created_at->format('d/m/Y');
				})
				->rawColumns(['action'])
				->make(true);
		}

		// Pacientes con 3-4 pruebas aplicadas por este usuario
		$pacientesConPruebas = AplicacionPrueba::select('paciente_id', DB::raw('COUNT(*) as total'))
			->where('user_id', $userId)
			->groupBy('paciente_id')
			->havingRaw('total BETWEEN 3 AND 4')
			->pluck('paciente_id')
			->toArray();

		// Cargar pacientes con su historia clínica más reciente
		$pacientes = Paciente::with([
			'historiaClinicas' => function ($q) {
				$q->orderByDesc('created_at')->limit(1);
			}
		])
			->whereIn('id', $pacientesConPruebas)
			->whereHas('historiaClinicas')
			->get();

		// Obtener todas las pruebas aplicadas (con sus pruebas) agrupadas por paciente
		$aplicaciones = AplicacionPrueba::with('prueba')
			->whereIn('paciente_id', $pacientesConPruebas)
			->get()
			->groupBy('paciente_id');

		return view('informes.index', [
			'especialista_actual' => $especialista,
			'pacientes' => $pacientes,
			'aplicaciones' => $aplicaciones,
		]);
	}

	public function store(StoreInformeRequest $request)
	{
		DB::transaction(function () use ($request) {
			$fechaEmision = now();
			$fechaVencimiento = now()->addMonth();

			Informe::create([
				'fecha_emision' => $fechaEmision,
				'fecha_vencimiento' => $fechaVencimiento,
				'motivo' => $request->motivo,
				'instrumentos' => $request->instrumentos,
				'recursos' => $request->recursos,
				'condiciones_generales' => $request->condiciones_generales,
				'fisica_salud' => $request->fisica_salud,
				'perceptivo_motriz' => $request->perceptivo_motriz,
				'coeficiente_intelectual' => $request->coeficiente_intelectual,
				'afectiva_social' => $request->afectiva_social,
				'conclusion' => $request->conclusion,
				'recomendaciones' => $request->recomendaciones,
				'especialista_id' => $request->especialista_id,
				'paciente_id' => $request->paciente_id
			]);

			// - Notificar al paciente o administrador
		});

		return response()->json([
			'success' => true,
			'message' => 'Informe creado correctamente!',
		]);
	}

	public function pdfHistoria(string $pacienteId)
	{
		$historia = HistoriaClinica::with([
			'paciente',
			'paciente.representante',
			'paciente.genero',
			'paciente.representante.direccion',
			'paciente.representante.direccion.estado',
			'paciente.representante.direccion.municipio',
			'paciente.representante.direccion.parroquia',
			'historiaDesarrollo',
			'antecedenteMedico',
			'historiaEscolar'
		])->find($pacienteId);

		if (!$historia) {
			return response()->json(['error' => 'Historia clínica no encontrada'], 404);
		}

		$datos = $historia->getDatosPdf();

		$pdf = Pdf::loadView('pdf.generarPdfHistoria', compact('datos'));

		return $pdf->stream('historia-clinica-' . $pacienteId . '.pdf');
	}
}
