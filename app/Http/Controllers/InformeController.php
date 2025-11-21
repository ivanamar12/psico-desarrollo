<?php

namespace App\Http\Controllers;

use App\Enums\Role;
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
use setasign\Fpdi\Fpdi;
use Yajra\DataTables\Facades\DataTables;

class InformeController extends Controller
{
	protected $pdfPruebasController;

	public function __construct(PdfPruebasController $pdfPruebasController)
	{
		$this->pdfPruebasController = $pdfPruebasController;
	}

	public function index(Request $request)
	{
		$userId = Auth::id();
		$especialista = Especialista::where('user_id', $userId)->first();

		if ($request->ajax()) {
			$informes = Informe::with(['paciente', 'especialista']);

			if (auth()->user()->hasRole(Role::ESPECIALISTA->value) && $especialista) {
				$informes->where('especialista_id', $especialista->id);
			}

			return DataTables::of($informes)
				->addColumn('action', function ($informe) {
					$acciones = '<a href="' . route('informes.pdf', $informe->id) . '" class="btn btn-primary btn-raised btn-xs" target="_blank" title="Reporte"><i class="zmdi zmdi-file"></i></a>';

					if (auth()->user()->can('eliminar informes')) {
						$acciones .= '<button data-id="' . $informe->id . '" class="btn-eliminar-informe btn btn-danger btn-raised btn-xs" title="Eliminar"><i class="zmdi zmdi-delete"></i></button>';
					}

					return $acciones;
				})
				->editColumn('created_at', function ($informe) {
					return $informe->created_at->format('d/m/Y');
				})
				->rawColumns(['action'])
				->make(true);
		}

		$pacientesConPruebas = [];
		$pacientes = collect();
		$aplicaciones = collect();

		if (auth()->user()->hasRole(Role::ADMIN->value)) {
			$pacientesConPruebas = AplicacionPrueba::select('paciente_id', DB::raw('COUNT(*) as total'))
				->groupBy('paciente_id')
				->having('total', '>=', 3)
				->pluck('paciente_id')
				->toArray();
		} elseif (auth()->user()->hasRole(Role::ESPECIALISTA->value) && $especialista) {
			$pacientesConPruebas = AplicacionPrueba::select('paciente_id', DB::raw('COUNT(*) as total'))
				->where('especialista_id', $especialista->id)
				->groupBy('paciente_id')
				->having('total', '>=', 3)
				->pluck('paciente_id')
				->toArray();
		}

		if (!empty($pacientesConPruebas)) {
			$pacientes = Paciente::with(['historiaClinicas'])
				->whereIn('id', $pacientesConPruebas)
				->whereHas('historiaClinicas')
				->get();

			$aplicaciones = AplicacionPrueba::with('prueba')
				->whereIn('paciente_id', $pacientesConPruebas)
				->get()
				->groupBy('paciente_id');
		}

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

	public function pdfInforme(Informe $informe)
	{
		$pdf = Pdf::loadView('pdf.informe', ['informe' => $informe])
			->setPaper('letter', 'portrait');

		return $pdf->stream();
	}

	public function destroy($id)
	{
		try {
			$informe = Informe::findOrFail($id);

			if (!auth()->user()->can('eliminar informes')) {
				return response()->json([
					'success' => false,
					'message' => 'No tienes permiso para eliminar informes'
				], 403);
			}

			$informe->delete();

			return response()->json([
				'success' => true,
				'message' => 'Informe eliminado correctamente!'
			]);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' => 'Error al eliminar el informe: ' . $e->getMessage()
			], 500);
		}
	}

	public function pdfHistoria(string $pacienteId)
	{
		$historia = HistoriaClinica::with([
			'paciente.genero',
			'paciente.representante.genero',
			'paciente.representante.direccion.estado',
			'paciente.representante.direccion.municipio',
			'paciente.representante.direccion.parroquia',
			'paciente.datosEconomico',
			'paciente.parentescos',
			'historiaDesarrollo',
			'antecedenteMedico',
			'historiaEscolar',
			'paciente.aplicacionPruebas.prueba',
		])
			->where('paciente_id', $pacienteId)
			->orderBy('created_at', 'desc')
			->firstOrFail();

		// Generar el PDF de la historia clínica
		$pdfHistoria = Pdf::loadView('pdf.historia', compact('historia'))->output();

		// Guardar el PDF de la historia clínica temporalmente
		$tempHistoriaPath = storage_path("temp_historia_clinica_{$pacienteId}.pdf");
		file_put_contents($tempHistoriaPath, $pdfHistoria);

		// Inicializar FPDI para combinar PDFs
		$pdf = new Fpdi();

		// Agregar la historia clínica al PDF combinado
		$pageCount = $pdf->setSourceFile($tempHistoriaPath);
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
			$tplIdx = $pdf->importPage($pageNo);
			$pdf->addPage();
			$pdf->useTemplate($tplIdx);
		}

		// Agregar los resultados de las pruebas al PDF combinado
		foreach ($historia->paciente->aplicacionPruebas as $aplicacion) {
			$pruebaNombre = $aplicacion->prueba->nombre;

			if ($pruebaNombre === 'CUMANIN') {
				$tempPdfPath = $this->pdfPruebasController->reportCumanin($aplicacion->id);
			} elseif ($pruebaNombre === 'Koppitz') {
				$tempPdfPath = $this->pdfPruebasController->reportKoppitz($aplicacion->id);
			} elseif ($pruebaNombre === 'NO-Estandarizada') {
				$tempPdfPath = $this->pdfPruebasController->reportNoEstandarizada($aplicacion->id);
			} else {
				continue;
			}

			if (file_exists($tempPdfPath)) {
				$pageCount = $pdf->setSourceFile($tempPdfPath);
				for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
					$tplIdx = $pdf->importPage($pageNo);
					$pdf->addPage();
					$pdf->useTemplate($tplIdx);
				}
				unlink($tempPdfPath);
			}
		}

		// Eliminar el archivo temporal de la historia clínica
		unlink($tempHistoriaPath);

		// Guardar el PDF combinado en un archivo temporal
		$combinedPdfPath = storage_path("combined_historia_{$pacienteId}.pdf");
		$pdf->Output($combinedPdfPath, 'F');

		return response()->stream(
			function () use ($combinedPdfPath) {
				readfile($combinedPdfPath);
				// Eliminar el archivo temporal después de enviarlo
				if (file_exists($combinedPdfPath)) {
					unlink($combinedPdfPath);
				}
			},
			200,
			[
				'Content-Type' => 'application/pdf',
				'Content-Disposition' => 'inline; filename="historia_clinica_' . $historia->paciente->id . '.pdf"'
			]
		);
	}
}
