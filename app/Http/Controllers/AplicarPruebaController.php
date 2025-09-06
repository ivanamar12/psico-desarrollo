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
            $btn .= ' <a href="' . route('aplicar-prueba.report.cumanin', $aplicacion->id) . '" class="btn btn-primary btn-raised btn-xs" target="_blank"><i class="zmdi zmdi-file"></i></a>';
          } elseif ($aplicacion->prueba->nombre === 'Koppitz') {
            $btn .= ' <a href="' . route('aplicar-prueba.report.koppitz', $aplicacion->id) . '" class="btn btn-primary btn-raised btn-xs" target="_blank"><i class="zmdi zmdi-file"></i></a>';
          } elseif ($aplicacion->prueba->tipo === 'NO-Estandarizada') {
            $btn .= ' <a href="' . route('aplicar-prueba.report.no-estandarizada', $aplicacion->id) . '" class="btn btn-primary btn-raised btn-xs" target="_blank"><i class="zmdi zmdi-file"></i></a>';
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

  public function store(Request $request)
  {
    $request->validate([
      'paciente_id' => 'required|exists:pacientes,id',
      'prueba_id' => 'required|exists:pruebas,id',
      'respuestas' => 'required|array',
    ]);

    try {
      $paciente = Paciente::find($request->paciente_id);
      $prueba = Prueba::find($request->prueba_id);
      $especialista = Especialista::where('user_id', Auth::id())->first();

      if (!$especialista) {
        return response()->json([
          'success' => false,
          'error' => 'Especialista no encontrado.',
        ], 500);
      }

      $edadMeses = $this->calcularEdadEnMeses($paciente->fecha_nac);

      if ($prueba->nombre === 'CUMANIN') {
        $resultados = $this->analizarCumaninPHP($request->respuestas, $paciente->fecha_nac);
      } elseif ($prueba->nombre === 'Koppitz') {
        $resultados = $this->analizarKoppitzPHP($request->respuestas, $edadMeses, $paciente->genero_id);
      } else {
        $resultados = $this->analizarNoEstandarizada($request->respuestas, $edadMeses);
      }

      AplicacionPrueba::create([
        'especialista_id' => $especialista->id,
        'paciente_id' => $paciente->id,
        'prueba_id' => $prueba->id,
        'resultados' => json_encode($request->respuestas),
        'resultados_finales' => json_encode($resultados)
      ]);

      return response()->json([
        'success' => true,
        'message' => '✅ Prueba procesada y resultados guardados correctamente.'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'error' => 'Error al guardar la prueba: ' . $e->getMessage()
      ], 500);
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

  private function analizarNoEstandarizada($respuestas, $edadMeses)
  {
    $observaciones = null;

    foreach ($respuestas as $area) {
      foreach ($area as $key => $data) {
        if ($key == 'observaciones')
          $observaciones = $data;
      }
    }

    return [
      'edad_meses' => $edadMeses,
      'resultados' => $respuestas,
      'observaciones' => $observaciones
    ];
  }

  private function analizarCumaninPHP($respuestas, $fechaNacimiento)
  {
    $edadMeses = $this->calcularEdadEnMeses($fechaNacimiento);
    $resultados = [];
    $lateralidad = ['izquierda' => 0, 'derecha' => 0];

    // Primero procesar todas las subescalas básicas
    foreach ($respuestas as $subescalaNombre => $datosSubescala) {
      if ($subescalaNombre === "lateralidad") {
        foreach ($datosSubescala as $respuesta) {
          if ($respuesta === "Izquierda") $lateralidad['izquierda']++;
          if ($respuesta === "Derecha") $lateralidad['derecha']++;
        }
        continue;
      }

      // Saltar las subescalas compuestas (se calculan después)
      if (in_array($subescalaNombre, ['Desarrollo Verbal', 'Desarrollo no Verbal', 'Desarrollo Global'])) {
        continue;
      }

      // Calcular puntaje bruto para subescalas básicas
      $puntajeBruto = 0;
      foreach ($datosSubescala['respuestas'] as $itemNombre => $respuesta) {
        if ($respuesta === "si") {
          $puntajeBruto++;
        }
      }

      $percentil = $this->obtenerPercentilCumanin($subescalaNombre, $puntajeBruto, $edadMeses);

      $resultados[$subescalaNombre] = [
        'puntaje' => $puntajeBruto,
        'percentil' => $percentil,
        'observaciones' => $datosSubescala['observaciones'] ?? "Sin observaciones"
      ];
    }

    // ✅ CALCULAR SUBESCALAS COMPUESTAS
    $resultados = $this->calcularSubescalasCompuestas($resultados, $edadMeses);

    $resultadoLateralidad = $lateralidad['izquierda'] > $lateralidad['derecha'] ? "Izquierda" : ($lateralidad['derecha'] > $lateralidad['izquierda'] ? "Derecha" : "Indefinida");

    return [
      'edad_meses' => $edadMeses,
      'resultados' => $resultados,
      'lateralidad' => $resultadoLateralidad
    ];
  }

  private function calcularSubescalasCompuestas($resultados, $edadMeses)
  {
    // 1. DESARROLLO VERBAL (Lenguaje Articulatorio + Comprensivo + Expresivo)
    if (
      isset($resultados['Lenguaje Articulatorio']) &&
      isset($resultados['Lenguaje Comprensivo']) &&
      isset($resultados['Lenguaje Expresivo'])
    ) {

      $puntajeVerbal = $resultados['Lenguaje Articulatorio']['puntaje'] +
        $resultados['Lenguaje Comprensivo']['puntaje'] +
        $resultados['Lenguaje Expresivo']['puntaje'];

      $resultados['Desarrollo Verbal'] = [
        'puntaje' => $puntajeVerbal,
        'percentil' => $this->obtenerPercentilCumanin('Desarrollo Verbal', $puntajeVerbal, $edadMeses),
        'observaciones' => 'Calculado a partir de Lenguaje Articulatorio, Comprensivo y Expresivo'
      ];
    }

    // 2. DESARROLLO NO VERBAL (Psicomotricidad + Estructuración Espacial + Visopercepción + Memoria Icónica + Ritmo)
    $subescalasNoVerbal = ['Psicomotricidad', 'Estructuración Espacial', 'Visopercepción', 'Memoria Icónica', 'Ritmo'];
    $puntajeNoVerbal = 0;
    $todasPresentes = true;

    foreach ($subescalasNoVerbal as $subescala) {
      if (!isset($resultados[$subescala])) {
        $todasPresentes = false;
        break;
      }
      $puntajeNoVerbal += $resultados[$subescala]['puntaje'];
    }

    if ($todasPresentes) {
      $resultados['Desarrollo no Verbal'] = [
        'puntaje' => $puntajeNoVerbal,
        'percentil' => $this->obtenerPercentilCumanin('Desarrollo no Verbal', $puntajeNoVerbal, $edadMeses),
        'observaciones' => 'Calculado a partir de Psicomotricidad, Estructuración espacial, Visopercepción, Memoria icónica y Ritmo'
      ];
    }

    // 3. DESARROLLO GLOBAL (Suma de todas las subescalas básicas)
    $puntajeGlobal = 0;
    $subescalasBasicas = array_diff_key($resultados, array_flip(['Desarrollo Verbal', 'Desarrollo no Verbal', 'Desarrollo Global']));

    foreach ($subescalasBasicas as $subescala) {
      $puntajeGlobal += $subescala['puntaje'];
    }

    $resultados['Desarrollo Global'] = [
      'puntaje' => $puntajeGlobal,
      'percentil' => $this->obtenerPercentilCumanin('Desarrollo Global', $puntajeGlobal, $edadMeses),
      'observaciones' => 'Puntuación total de los 83 elementos'
    ];

    return $resultados;
  }

  private function obtenerPercentilCumanin($subescala, $puntaje, $edadMeses)
  {
    $rangoEdad = $this->obtenerRangoEdad($edadMeses);

    $baremos = Baremos::where('sub_escala', $subescala)
      ->where('edad_meses', $rangoEdad)
      ->orderBy('puntos', 'asc')
      ->get();

    if ($baremos->isEmpty()) {
      return 'No disponible';
    }

    foreach ($baremos as $baremo) {
      // Manejar rangos de puntos (ej: "10-11")
      if (strpos($baremo->puntos, '-') !== false) {
        list($min, $max) = array_map('intval', explode('-', $baremo->puntos));
        if ($puntaje >= $min && $puntaje <= $max) {
          return $baremo->p_c;
        }
      }
      // Manejar puntos individuales
      elseif ((int)$baremo->puntos == $puntaje) {
        return $baremo->p_c;
      }
      // Si encontramos un baremo mayor que nuestro puntaje
      elseif ((int)$baremo->puntos > $puntaje) {
        // Buscar el baremo anterior
        $baremoAnterior = Baremos::where('sub_escala', $subescala)
          ->where('edad_meses', $rangoEdad)
          ->where('puntos', '<', $puntaje)
          ->orderBy('puntos', 'desc')
          ->first();
        return $baremoAnterior ? $baremoAnterior->p_c : $baremos->first()->p_c;
      }
    }

    // Si el puntaje es mayor que todos los baremos, usar el último
    return $baremos->last()->p_c;
  }

  private function obtenerRangoEdad($edadMeses)
  {
    $rangos = [
      '36-42' => [36, 42],
      '43-48' => [43, 48],
      '49-54' => [49, 54],
      '55-60' => [55, 60],
      '61-66' => [61, 66],
      '67-78' => [67, 78]
    ];

    foreach ($rangos as $rango => $limites) {
      if ($edadMeses >= $limites[0] && $edadMeses <= $limites[1]) {
        return $rango;
      }
    }

    return '36-42';
  }

  private function calcularEdadEnMeses($fechaNacimiento)
  {
    $nacimiento = new \DateTime($fechaNacimiento);
    $hoy = new \DateTime();
    $diferencia = $hoy->diff($nacimiento);

    return ($diferencia->y * 12) + $diferencia->m;
  }
}
