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
// use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;
use App\Models\RiesgoPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HistoriaClinicaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $historias = DB::select('SELECT pacientes.nombre as nombre, 
        pacientes.apellido as apellido, 
        historia_clinicas.* FROM historia_clinicas 
        JOIN pacientes ON historia_clinicas.paciente_id = pacientes.id');

      return DataTables::of($historias)
        ->addColumn('action', function ($historia) {
          $acciones = '<a href="' . route('pdf.generarPdfHistoria', $historia->id) . '" class="btn btn-primary btn-raised btn-xs"><i class="zmdi zmdi-file-text"></i> PDF</a>';
          $acciones .= '<button type="button" class="verHistoria btn btn-info btn-raised btn-xs" data-id="' . $historia->id . '"><i class="zmdi zmdi-eye"></i></button>';
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
    $pacientes = Paciente::withCount('historiaclinicas')
      ->select('id', 'nombre', 'apellido')
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
              'tipo_educaion' => $validatedData['tipo_educaion'] ?? null,
              'tutoria_terapias' => $validatedData['tutoria_terapias'],
              'tutoria_terapias_cuales' => $validatedData['tutoria_terapias_cuales'] ?? null,
              'dificultad_lectura' => $validatedData['dificultad_lectura'],
              'dificultad_aritmetica' => $validatedData['dificultad_aritmetica'],
              'dificultad_escribir' => $validatedData['dificultad_escribir'],
              'agrada_escuela' => $validatedData['agrada_escuela'],
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

      return response()->json(['message' => 'Registro creado exitosamente.'], 201);
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

  public function generarPdfHistoria($id)
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
    ])->find($id);

    if (!$historia) {
      return response()->json(['error' => 'Historia clínica no encontrada'], 404);
    }

    $datos = $historia->getDatosPdf();

    $pdf = Pdf::loadView('pdf.generarPdfHistoria', compact('datos'));

    return $pdf->download('historia_clinica_' . $id . '.pdf');
  }

  public function verHistoria($id, $tipo)
  {
      $historia = HistoriaClinica::obtenerHistoriaCompleta($id);

      if (!$historia) {
          if ($tipo === 'api') {
              return response()->json(['error' => 'Historia clínica no encontrada.'], 404);
          }
          return redirect()->back()->with('error', 'La historia clínica no fue encontrada.');
      }

      $paciente = $historia->paciente;

      if (!$paciente) {
          if ($tipo === 'api') {
              return response()->json(['error' => 'Paciente no encontrado.'], 404);
          }
          return redirect()->back()->with('error', 'El paciente no fue encontrado.');
      }

      // ✅ Leer riesgos desde la base de datos
      $riesgo = \App\Models\RiesgoPaciente::where('historia_clinica_id', $historia->id)->first();

      $riesgoSocial = $riesgo->riesgo_social ?? 0;
      $riesgoBiologico = $riesgo->riesgo_biologico ?? 0;
      $riesgoGlobal = $riesgo->riesgo_global ?? 'bajo';

      // Respuesta según el tipo
      if ($tipo === 'api') {
          return response()->json([
              'historia' => $historia,
              'riesgoSocial' => $riesgoSocial,
              'riesgoBiologico' => $riesgoBiologico,
              'riesgoGlobal' => $riesgoGlobal,
          ]);
      }

      return view('historia.ver', compact('historia', 'riesgoSocial', 'riesgoBiologico', 'riesgoGlobal'));
  }
}
