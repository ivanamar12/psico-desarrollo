<?php

namespace App\Http\Controllers;

use App\Services\RiesgoService;
use App\Http\Requests\HistoriaClinica\StoreHistoriaClinicaRequest;
use App\Models\AntecedenteMedico;
use App\Models\HistoriaClinica;
use App\Models\HistoriaDesarrollo;
use App\Models\HistoriaEscolar;
use App\Models\Parentesco;
use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;
use setasign\Fpdi\Fpdi;
use App\Models\RiesgoPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HistoriaClinicaController extends Controller
{
  protected $pdfPruebasController;

  public function __construct(PdfPruebasController $pdfPruebasController)
  {
    $this->pdfPruebasController = $pdfPruebasController;
  }

  public function index(Request $request)
  {
    if ($request->ajax()) {
      $historias = DB::select('SELECT pacientes.nombre as nombre, 
                pacientes.apellido as apellido, 
                historia_clinicas.* FROM historia_clinicas 
                JOIN pacientes ON historia_clinicas.paciente_id = pacientes.id');

      return DataTables::of($historias)
        ->addColumn('action', function ($historia) {
          $acciones = '<a href="' . route('historias.report', $historia->id) . '" class="btn btn-primary btn-raised btn-xs"><i class="zmdi zmdi-file-text"></i> PDF Completo</a>';
          $acciones .= '<button type="button" name="delete" id="' . $historia->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';
          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $antecedentesMedicos = AntecedenteMedico::all();
    $historiaClinicas = HistoriaClinica::all();
    $historiaDesarrollos = HistoriaDesarrollo::all();
    $historiaEscolares = HistoriaEscolar::all();
    $parentescos = Parentesco::all();
    $pacientes = Paciente::select(
      'pacientes.id',
      'pacientes.nombre',
      'pacientes.apellido',
      'pacientes.representante_id',
      DB::raw('COUNT(historia_clinicas.id) as historias_count')
    )
      ->leftJoin('historia_clinicas', 'pacientes.id', '=', 'historia_clinicas.paciente_id')
      ->groupBy('pacientes.id', 'pacientes.nombre', 'pacientes.apellido', 'pacientes.representante_id')
      ->with(['representante' => function ($query) {
        $query->select('id', 'ci');
      }])
      ->get();

    return view('historias.index', [
      'antecedentesMedicos' => $antecedentesMedicos,
      'historiaClinicas' => $historiaClinicas,
      'historiaDesarrollos' => $historiaDesarrollos,
      'historiaEscolares' => $historiaEscolares,
      'parentescos' => $parentescos,
      'pacientes' => $pacientes
    ]);
  }

  public function store(StoreHistoriaClinicaRequest $request)
  {
    $validatedData = $request->validated();

    DB::transaction(function () use ($validatedData) {
      // Crear Historia Desarrollo
      $historiaDesarrollo = HistoriaDesarrollo::create([
        'medicamento_embarazo' => $validatedData['medicamento_embarazo'],
        'tipo_medicamento' => $validatedData['tipo_medicamento'] ?? null,
        'fumo_embarazo' => $validatedData['fumo_embarazo'],
        'cantidad' => $validatedData['cantidad'] ?? null,
        'alcohol_embarazo' => $validatedData['alcohol_embarazo'],
        'tipo_alcohol' => $validatedData['tipo_alcohol'] ?? null,
        'cantidad_consumia_alcohol' => $validatedData['cantidad_consumia_alcohol'] ?? null,
        'droga_embarazo' => $validatedData['droga_embarazo'],
        'tipo_droga' => $validatedData['tipo_droga'] ?? null,
        'forceps_parto' => $validatedData['forceps_parto'],
        'cesarea' => $validatedData['cesarea'],
        'razon_cesarea' => $validatedData['razon_cesarea'] ?? null,
        'niño_prematuro' => $validatedData['niño_prematuro'],
        'meses_prematuro' => $validatedData['meses_prematuro'] ?? null,
        'peso_nacer_niño' => $validatedData['peso_nacer_niño'],
        'complicaciones_nacer' => $validatedData['complicaciones_nacer'],
        'tipo_complicacion' => $validatedData['tipo_complicacion'] ?? null,
        'problema_alimentacion' => $validatedData['problema_alimentacion'],
        'tipo_problema_alimenticio' => $validatedData['tipo_problema_alimenticio'] ?? null,
        'problema_dormir' => $validatedData['problema_dormir'],
        'tipo_problema_dormir' => $validatedData['tipo_problema_dormir'] ?? null,
        'tranquilo_recien_nacido' => $validatedData['tranquilo_recien_nacido'],
        'gustaba_cargaran_recien_nacido' => $validatedData['gustaba_cargaran_recien_nacido'],
        'alerta_recien_nacido' => $validatedData['alerta_recien_nacido'],
        'problemas_desarrollo_primeros_años' => $validatedData['problemas_desarrollo_primeros_años'],
        'cuales_problemas' => $validatedData['cuales_problemas'] ?? null,
        'observacion' => $validatedData['observacion_desarrollo'] ?? null,
      ]);

      // Crear Antecedente Médico
      $antecedenteMedico = AntecedenteMedico::create([
        'enfermedad_infecciosa' => $validatedData['enfermedad_infecciosa'],
        'tipo_enfermedad_infecciosa' => $validatedData['tipo_enfermedad_infecciosa'] ?? null,
        'enfermedad_no_infecciosa' => $validatedData['enfermedad_no_infecciosa'],
        'tipo_enfermedad_no_infecciosa' => $validatedData['tipo_enfermedad_no_infecciosa'] ?? null,
        'enfermedad_cronica' => $validatedData['enfermedad_cronica'],
        'tipo_enfermedad_cronica' => $validatedData['tipo_enfermedad_cronica'] ?? null,
        'discapacidad' => $validatedData['discapacidad'],
        'tipo_discapacidad' => $validatedData['tipo_discapacidad'] ?? null,
        'otros' => $validatedData['otros'] ?? 'no aplica',
        'observacion' => $validatedData['observacion_antecedentes'] ?? null,
      ]);

      // Crear Historia Escolar
      $historiaEscolar = HistoriaEscolar::create([
        'escolarizado' => $validatedData['escolarizado'],
        'tipo_educacion' => $validatedData['tipo_educacion'] ?? 'no aplica',
        'modalidad_educacion' => $validatedData['modalidad_educacion'] ?? 'no aplica',
        'nombre_escuela' => $validatedData['nombre_escuela'] ?? 'no aplica',
        'tutoria_terapias' => $validatedData['tutoria_terapias'],
        'tutoria_terapias_cuales' => $validatedData['tutoria_terapias_cuales'] ?? null,
        'dificultad_lectura' => $validatedData['dificultad_lectura'],
        'dificultad_aritmetica' => $validatedData['dificultad_aritmetica'],
        'dificultad_escribir' => $validatedData['dificultad_escribir'],
        'agrada_escuela' => $validatedData['agrada_escuela'],
        'otro_servicio' => $validatedData['otro_servicio'] ?? null,
        'observacion' => $validatedData['observacion_escolar'] ?? null,
      ]);

      // Crear Historia Clínica
      $historiaClinica = HistoriaClinica::create([
        'paciente_id' => $validatedData['paciente_id'],
        'historia_desarrollo_id' => $historiaDesarrollo->id,
        'antecedente_medico_id' => $antecedenteMedico->id,
        'historia_escolar_id' => $historiaEscolar->id,
        'codigo' => $validatedData['codigo'],
        'referencia' => $validatedData['referencia'],
        'especialista_refirio' => $validatedData['especialista_refirio'],
        'motivo' => $validatedData['motivo'],
        'observacion' => $validatedData['observacion_historia'] ?? null,
      ]);

      // ✅ Calcular y guardar riesgos
      $paciente = Paciente::find($validatedData['paciente_id']);
      $riesgoService = new RiesgoService();

      $riesgoSocial = $paciente->datosEconomico
        ? $riesgoService->calcularRiesgoSocial($paciente->datosEconomico)
        : 0;

      $riesgoBiologico = $riesgoService->calcularRiesgoBiologico($historiaClinica);
      $riesgoGlobal = $riesgoService->calcularRiesgoGlobal($riesgoSocial, $riesgoBiologico);

      RiesgoPaciente::updateOrCreate(
        ['historia_clinica_id' => $historiaClinica->id],
        [
          'riesgo_social' => $riesgoSocial,
          'riesgo_biologico' => $riesgoBiologico,
          'riesgo_global' => $riesgoGlobal,
        ]
      );
    });

    return response()->json([
      'success' => true,
      'message' => 'Registro creado exitosamente.'
    ], 201);
  }

  public function destroy($id)
  {
    $historia = HistoriaClinica::find($id);
    if (!$historia) {
      return response()->json(['message' => 'Historia clínica no encontrada'], 404);
    }

    $historia->delete();

    return response()->json(['success' => true]);
  }

  public function report($id)
  {
    // Cargar historia con TODAS las relaciones necesarias
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
    ])->findOrFail($id);

    // Generar el PDF de la historia clínica
    $pdfHistoria = Pdf::loadView('pdf.historia-completa', compact('historia'))->output();

    // Guardar el PDF de la historia clínica temporalmente
    $tempHistoriaPath = storage_path("temp_historia_clinica_{$id}.pdf");
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
      // Determinar el nombre de la prueba
      $pruebaNombre = $aplicacion->prueba->nombre;

      // Llamar al método correspondiente según el nombre de la prueba
      if ($pruebaNombre === 'CUMANIN') {
        $tempPdfPath = $this->pdfPruebasController->reportCumanin($aplicacion->id);
      } elseif ($pruebaNombre === 'Koppitz') {
        $tempPdfPath = $this->pdfPruebasController->reportKoppitz($aplicacion->id);
      } elseif ($pruebaNombre === 'NO-Estandarizada') {
        $tempPdfPath = $this->pdfPruebasController->reportNoEstandarizada($aplicacion->id);
      } else {
        // Si no se reconoce el nombre de la prueba, puedes manejarlo aquí
        continue;
      }

      // Agregar el PDF del resultado de la prueba al PDF combinado
      if (file_exists($tempPdfPath)) {
        $pageCount = $pdf->setSourceFile($tempPdfPath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
          $tplIdx = $pdf->importPage($pageNo);
          $pdf->addPage();
          $pdf->useTemplate($tplIdx);
        }
        // Eliminar el archivo temporal del resultado de la prueba
        unlink($tempPdfPath);
      }
    }

    // Eliminar el archivo temporal de la historia clínica
    unlink($tempHistoriaPath);

    // Enviar el PDF combinado al usuario
    $pdf->Output("historia-clinica-{$id}.pdf", 'D');
  }
}
