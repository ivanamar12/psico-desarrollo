<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\Paciente;
use App\Models\AplicacionPrueba;
use App\Models\ResultadosPruebas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

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

    // Filtrar pacientes que tienen al menos una historia clínica
    $pacientes = Paciente::has('historiaclinicas')->get(); // Utiliza la relación 'historiaclinicas'
    $pruebas = Prueba::all();

    return view('aplicar-prueba.index', compact('pacientes', 'pruebas'));
  }

  public function buscarPacientes(Request $request)
  {
    $searchTerm = $request->get('q');
    $pacientes = Paciente::whereHas('historiaclinicas')
      ->where(function ($query) use ($searchTerm) {
        $query->where('nombre', 'like', "%$searchTerm%")
          ->orWhere('apellido', 'like', "%$searchTerm%");
      })
      ->get(['id', 'nombre', 'apellido', 'fecha_nac']);
    return response()->json($pacientes);
  }

  public function pruebasDisponibles(Request $request)
  {
    $edadMeses = intval($request->input('edad_meses'));

    $rangos = [
      '0-3 meses' => [0, 3],
      '4-6 meses' => [4, 6],
      '7-12 meses' => [7, 12],
      '13-24 meses' => [13, 24],
      '25-36 meses' => [25, 36],
      '37-48 meses' => [37, 48],
      '49-72 meses' => [49, 72],
      '36-78 meses' => [36, 78],
      '60-78 meses' => [60, 78]
    ];

    $rangosAplicables = array_filter($rangos, function ($rango) use ($edadMeses) {
      return $edadMeses >= $rango[0] && $edadMeses <= $rango[1];
    });

    $rangosClaves = array_keys($rangosAplicables);

    return response()->json(Prueba::whereIn('rango_edad', $rangosClaves)->get());
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

  public function generarPDF($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $usuario = $aplicacion->user;
    if (!$usuario) {
      return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $resultado = ResultadosPruebas::where('aplicacion_pruebas_id', $id)->first();
    if (!$resultado) {
      return response()->json(['error' => 'Resultados no encontrados'], 404);
    }

    $datos = json_decode($resultado->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    // Generar el PDF y guardarlo en el servidor
    $pdf = Pdf::loadView('pdf.resultados_cumanin', compact('aplicacion', 'datos', 'resultados', 'paciente', 'usuario'))
      ->setPaper('a4', 'portrait')
      ->output();

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    file_put_contents($pdfPath, $pdf);

    // Devolver la ruta del PDF guardado
    return $pdfPath;
  }

  public function generarPDFKoppitz($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $usuario = $aplicacion->user;
    if (!$usuario) {
      return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $respuestasAplicacion = json_decode($aplicacion->resultados, true);
    $respuestasItems = $respuestasAplicacion['Dibujo de Figura Humana']['respuestas'] ?? [];

    $resultado = ResultadosPruebas::where('aplicacion_pruebas_id', $id)->first();
    if (!$resultado) {
      return response()->json(['error' => 'Resultados no encontrados'], 404);
    }

    $datos = json_decode($resultado->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    $itemsSi = [];
    $itemsNo = [];

    foreach ($respuestasItems as $item => $respuesta) {
      if ($respuesta === "si") {
        $itemsSi[] = $item;
      } else {
        $itemsNo[] = $item;
      }
    }

    // Generar el PDF y guardarlo en el servidor
    $pdf = Pdf::loadView('pdf.resultados_koppitz', compact(
      'aplicacion',
      'datos',
      'resultados',
      'paciente',
      'usuario',
      'itemsSi',
      'itemsNo'
    ))
      ->setPaper('a4', 'portrait')
      ->output();

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    file_put_contents($pdfPath, $pdf);

    // Devolver la ruta del PDF guardado
    return $pdfPath;
  }

  public function generarPDFNoEstandarizada($id)
  {
    $aplicacion = AplicacionPrueba::with(['paciente', 'prueba', 'user'])
      ->findOrFail($id);

    $paciente = $aplicacion->paciente;
    if (!$paciente) {
      return response()->json(['error' => 'Paciente no encontrado'], 404);
    }

    $usuario = $aplicacion->user;
    if (!$usuario) {
      return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    $resultado = ResultadosPruebas::where('aplicacion_pruebas_id', $id)->first();
    if (!$resultado) {
      return response()->json(['error' => 'Resultados no encontrados'], 404);
    }

    $datos = json_decode($resultado->resultados_finales, true);
    $resultados = $datos['resultados'] ?? [];

    // Generar el PDF y guardarlo en el servidor
    $pdf = Pdf::loadView('pdf.resultados_no_estandarizada', compact('aplicacion', 'datos', 'resultados', 'paciente', 'usuario'))
      ->setPaper('a4', 'portrait')
      ->output();

    // Definir la ruta donde se guardará el PDF
    $pdfPath = storage_path("app/public/resultados/resultados_{$id}.pdf");

    // Guardar el PDF en el servidor
    file_put_contents($pdfPath, $pdf);

    // Devolver la ruta del PDF guardado
    return $pdfPath;
  }
}
