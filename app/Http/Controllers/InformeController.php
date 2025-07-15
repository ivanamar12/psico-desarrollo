<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Paciente;
use App\Models\Informe;
use App\Models\AplicacionPrueba;
use App\Models\HistoriaClinica;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
