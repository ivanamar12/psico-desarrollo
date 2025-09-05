<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\Paciente;
use App\Models\AplicacionPrueba;
use App\Models\Baremos;
use App\Models\Especialista;
use App\Models\SubEscala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    $baremos = Baremos::all();
    $subescalas = SubEscala::all();

    return view('aplicar-prueba.index', compact('pacientes', 'pruebas', 'baremos', 'subescalas'));
  }

  public function guardarRespuestas(Request $request)
  {
    $request->validate([
      'paciente_id' => 'required|exists:pacientes,id',
      'prueba_id' => 'required|exists:pruebas,id',
      'respuestas' => 'required|array',
    ]);

    $especialista = Especialista::where('user_id', Auth::id())->first();

    if (!$especialista) {
      return response()->json([
        'success' => false,
        'error' => 'Especialista no encontrado.',
      ], 500);
    }

    DB::beginTransaction();
    try {
      $paciente = Paciente::find($request->paciente_id);
      $prueba = Prueba::find($request->prueba_id);

      $edadMeses = $this->calcularEdadEnMeses($paciente->fecha_nac);

      if ($prueba->nombre === 'CUMANIN') {
        $resultados = $this->analizarCumaninPHP($request->respuestas, $edadMeses);
      } elseif ($prueba->nombre === 'Koppitz') {
        $resultados = $this->analizarKoppitzPHP($request->respuestas, $edadMeses, $paciente->genero_id);
      } else {
        $resultados = [
          'edad_meses' => $edadMeses,
          'resultados' => $request->respuestas,
          'lateralidad' => null,
          'observaciones' => null
        ];
      }

      AplicacionPrueba::create([
        'especialista_id' => $especialista->id,
        'paciente_id' => $paciente->id,
        'prueba_id' => $prueba->id,
        'resultados' => json_encode($request->respuestas),
        'resultados_finales' => json_encode($resultados)
      ]);

      DB::commit();
      return response()->json([
        'success' => true,
        'message' => '✅ Prueba procesada y resultados guardados correctamente.'
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => 'Error al guardar la prueba.'], 500);
    }
  }

  public function show($id)
  {
    $aplicacion = AplicacionPrueba::with('paciente', 'prueba')->find($id);

    if (!$aplicacion) {
      return response()->json([
        'success' => false,
        'error' => 'Prueba no encontrada.'
      ], 404);
    }

    $aplicacion->resultados = json_decode($aplicacion->resultados, true);
    $aplicacion->resultados_finales = json_decode($aplicacion->resultados_finales, true);
    $aplicacion->created_at_formatted = $aplicacion->created_at->format('d/m/Y');

    return response()->json(['aplicacion_prueba' => $aplicacion]);
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

  private function analizarKoppitzPHP($respuestas, $edadMeses, $generoId)
  {
    $baremos = Baremos::where('sub_escala', 'Dibujo de Figura Humana')->get();
    $subescalaNombre = "Dibujo de Figura Humana";

    if (!isset($respuestas[$subescalaNombre]['respuestas'])) {
      return ['error' => 'No se encontraron respuestas para la subescala'];
    }

    $puntajeTotal = 0;
    $itemsEsperados = 0;
    $itemsExcepcionales = 0;
    $detallesPuntaje = [];

    $respuestasItems = $respuestas[$subescalaNombre]['respuestas'];
    $observaciones = $respuestas[$subescalaNombre]['observaciones'] ?? "Sin observaciones";

    // ✅ MApeo CORREGIDO
    $mapeoItems = [
      "Cabeza" => "Cabeza",
      "Ojos" => "Ojos",
      "Nariz" => "Nariz",
      "Boca" => "Boca",
      "Cuerpo" => "Cuerpo",
      "Piernas" => "Piernas",
      "Brazos" => $generoId == 1 ? "Brazos_masculino" : "Brazos_femenino",
      "Pies" => $generoId == 1 ? "Pies_masculino" : "Pies_femenino",
      "Rodilla" => "Rodilla",
      "Perfil" => "Perfil",
      "Codo" => "Codo",
      "Dos Labios" => "Dos labios",
      "Fosas Nasales" => "Fosas Nasales",
      "Proporciones" => "Proporciones",
      "Braz. u. Homb." => "Braz. u. Homb.",
      "Ropa: 4 prendas" => "Ropa:4 prendas",
      "Pies 2" => $generoId == 1 ? "Pies_2_masculino" : "Pies_2_femenino",
      "Cinco dedos" => $generoId == 1 ? "Cinco_Dedos_masculino" : "Cinco_Dedos_femenino",
      "Pupilas" => $generoId == 1 ? "Pupilas_masculino" : "Pupilas_femenino",
    ];

    foreach ($respuestasItems as $itemNombre => $respuesta) {
      $p_c = $mapeoItems[$itemNombre] ?? null;
      if (!$p_c) continue;

      $baremo = $baremos->first(function ($b) use ($p_c, $edadMeses) {
        $parts = explode('-', $b->edad_meses);
        $min = (int) $parts[0];
        $max = isset($parts[1]) ? (int) $parts[1] : $min;
        return $b->p_c === $p_c && $edadMeses >= $min && $edadMeses <= $max;
      });

      if ($baremo) {
        $tipoItem = $baremo->puntos;
        $correcto = false;

        if ($tipoItem === "esperado") {
          // Items esperados deben estar presentes (respuesta "si")
          $correcto = ($respuesta === "si");
          if ($correcto) {
            $puntajeTotal++;
            $itemsEsperados++;
          }
        } elseif ($tipoItem === "excepcional") {
          // Items excepcionales son bonos adicionales
          $correcto = ($respuesta === "si");
          if ($correcto) {
            $puntajeTotal++;
            $itemsExcepcionales++;
          }
        }

        $detallesPuntaje[$itemNombre] = [
          'baremo' => $baremo->p_c,
          'tipo' => $tipoItem,
          'respuesta' => $respuesta,
          'correcto' => $correcto,
          'edad_rango' => $baremo->edad_meses
        ];
      }
    }

    // ✅ Categorización CORRECTA para Koppitz
    $categoria = "";
    if ($puntajeTotal >= 15) $categoria = "Superior";
    elseif ($puntajeTotal >= 12) $categoria = "Normal alto";
    elseif ($puntajeTotal >= 9) $categoria = "Normal";
    elseif ($puntajeTotal >= 6) $categoria = "Normal bajo";
    elseif ($puntajeTotal >= 3) $categoria = "Borderline";
    else $categoria = "Deficiente";

    return [
      'edad_meses' => $edadMeses,
      'resultados' => [
        'puntajeTotal' => $puntajeTotal,
        'itemsEsperados' => $itemsEsperados,
        'itemsExcepcionales' => $itemsExcepcionales,
        'detallesPuntaje' => $detallesPuntaje,
        'categoria' => $categoria
      ],
      'observaciones' => $observaciones
    ];
  }

  private function analizarCumaninPHP($respuestas, $fechaNacimiento)
  {
    // Calcular la edad en meses desde la fecha de nacimiento
    $edadMeses = $this->calcularEdadEnMeses($fechaNacimiento);

    // Obtener baremos desde la base de datos
    $baremos = Baremos::all();

    // Inicializar resultados
    $resultados = [];
    $lateralidad = ['izquierda' => 0, 'derecha' => 0];

    // Procesar respuestas por subescala
    foreach ($respuestas as $subescalaNombre => $datosSubescala) {
      if ($subescalaNombre === "lateralidad") {
        foreach ($datosSubescala as $respuesta) {
          if ($respuesta === "Izquierda") $lateralidad['izquierda']++;
          if ($respuesta === "Derecha") $lateralidad['derecha']++;
        }
        continue;
      }

      $puntaje = 0;
      foreach ($datosSubescala['respuestas'] as $itemNombre => $respuesta) {
        // Buscar baremo correspondiente
        $baremo = $baremos->first(function ($b) use ($subescalaNombre, $itemNombre, $edadMeses) {
          return $b->sub_escala === $subescalaNombre && $b->item === $itemNombre && $edadMeses >= $b->edad_min && $edadMeses <= $b->edad_max;
        });

        if ($baremo) {
          if ($baremo->puntos === "esperado" && $respuesta === "no") {
            $puntaje--;
          } elseif ($baremo->puntos === "excepcional" && $respuesta === "si") {
            $puntaje++;
          }
        }
      }

      $resultados[$subescalaNombre] = [
        'puntaje' => $puntaje,
        'observaciones' => $datosSubescala['observaciones'] ?? "Sin observaciones"
      ];
    }

    // Determinar lateralidad
    $resultadoLateralidad = $lateralidad['izquierda'] > $lateralidad['derecha'] ? "Izquierda" : ($lateralidad['derecha'] > $lateralidad['izquierda'] ? "Derecha" : "Indefinida");

    return [
      'edad_meses' => $edadMeses,
      'resultados' => $resultados,
      'lateralidad' => $resultadoLateralidad
    ];
  }

  private function calcularEdadEnMeses($fechaNacimiento)
  {
    $fechaNacimiento = new \DateTime($fechaNacimiento);
    $fechaActual = new \DateTime();
    $diferencia = $fechaActual->diff($fechaNacimiento);
    return $diferencia->y * 12 + $diferencia->m;
  }
}
