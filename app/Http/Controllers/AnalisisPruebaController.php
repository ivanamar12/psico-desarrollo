<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\SubEscala;
use App\Models\Item;
use App\Models\Baremos;
use App\Models\Paciente;
use App\Models\User;
use App\Models\AplicacionPrueba;
use App\Models\ResultadosPruebas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use PDF;

class AnalisisPruebaController extends Controller
{

  public function verificarNuevaPrueba(Request $request)
  {
    try {
      // Validar los datos de entrada
      $request->validate([
        'paciente' => 'required|array',
        'paciente.id' => 'required|integer',
        'paciente.nombre' => 'required|string',
        'paciente.fecha_nac' => 'required|date',
        'paciente.genero_id' => 'required|integer',
        'prueba' => 'required|array',
        'prueba.id' => 'required|integer',
        'prueba.nombre' => 'required|string',
        'prueba.resultados' => 'required|array',
        'fecha_aplicacion' => 'required|date'
      ]);

      // Extraer datos del paciente y la prueba
      $paciente = $request->paciente;
      $prueba = $request->prueba;

      // Calcular la edad en meses del paciente
      $edadMeses = $this->calcularEdadEnMeses($paciente['fecha_nac']);

      // Procesar los datos de la prueba
      if ($prueba['nombre'] === 'CUMANIN') {
        $resultados = $this->analizarCumaninPHP($prueba['resultados'], $edadMeses);
      } elseif ($prueba['nombre'] === 'Koppitz') {
        $resultados = $this->analizarKoppitzPHP($prueba['resultados'], $edadMeses, $paciente['genero_id']);
      } else {
        $resultados = [
          'edad_meses' => $edadMeses,
          'resultados' => $prueba['resultados'],
          'lateralidad' => null,
          'observaciones' => null
        ];
      }

      // Guardar resultados solo si no existen
      $yaGuardado = ResultadosPruebas::where('aplicacion_pruebas_id', $prueba['id'])->exists();
      if ($yaGuardado) {
        return response()->json(['mensaje' => 'ℹ️ Los resultados ya han sido guardados previamente.']);
      }

      $this->guardarResultados($prueba['id'], $resultados);

      return response()->json(['mensaje' => '✅ Prueba procesada y resultados guardados correctamente.']);
    } catch (\Exception $e) {
      \Log::error("❌ Error verificando prueba: " . $e->getMessage());
      return response()->json(['error' => '❌ Error verificando prueba.'], 500);
    }
  }
  public function guardarResultados($pruebaId, $resultados)
  {
    try {
      // Verificar si ya hay resultados guardados para esta prueba
      if (ResultadosPruebas::where('aplicacion_pruebas_id', $pruebaId)->exists()) {
        return response()->json(['mensaje' => 'Los resultados para esta prueba ya han sido guardados.'], 400);
      }

      // Guardar los resultados
      $resultado = new ResultadosPruebas();
      $resultado->aplicacion_pruebas_id = $pruebaId;
      $resultado->resultados_finales = json_encode($resultados, JSON_UNESCAPED_UNICODE);
      $resultado->save();

      return response()->json(['mensaje' => 'Resultados guardados correctamente']);
    } catch (\Exception $e) {
      \Log::error("❌ Error guardando resultados: " . $e->getMessage());
      return response()->json(['error' => 'Error al guardar los resultados'], 500);
    }
  }
  public function analizarPrueba(Request $request)
  {
    $pruebaId = $request->prueba_id;
    $tipoPrueba = $request->tipo_prueba;
    $nombrePrueba = $request->nombre;

    return response()->json([
      'mensaje' => 'Ejecutando análisis en JavaScript',
      'prueba_id' => $pruebaId,
      'tipo_prueba' => $tipoPrueba,
      'nombre' => $nombrePrueba
    ]);
  }

  private function analizarKoppitzPHP($respuestas, $edadMeses, $generoId)
  {
    $baremos = Baremos::where('sub_escala', 'Dibujo de Figura Humana')->get();
    $subescalaNombre = "Dibujo de Figura Humana";

    if (!isset($respuestas[$subescalaNombre]['respuestas'])) {
      return ['error' => 'No se encontraron respuestas para la subescala'];
    }

    $puntajeTotal = 8;
    $detallesPuntaje = [];
    $itemsExcepcionales = 0;

    $respuestasItems = $respuestas[$subescalaNombre]['respuestas'];
    $observaciones = $respuestas[$subescalaNombre]['observaciones'] ?? "Sin observaciones";

    // Mapeo de respuestas a p_c según género
    $mapeoItems = [
      "Cabeza" => "Cabeza",
      "Ojos" => "Ojos",
      "Nariz" => "Nariz",
      "Boca" => "Boca",
      "Cuerpo" => "Cuerpo",
      "Piernas" => "Piernas",
      "Brazos" => $generoId == 1 ? "Brazos_masculino" : "Brazos_femenino",
      "pies" => $generoId == 1 ? "Pies_masculino" : "Pies_femenino",
      "Rodilla" => "Rodilla",
      "Perfil" => "Perfil",
      "Codo" => "Codo",
      "Dos Labios" => "Dos labios",
      "Fosas Nasales" => "Fosas Nasales",
      "Proporciones" => "Proporciones",
      "Braz. u. Homb." => "Braz. u. Homb.",
      "Ropa: 4 prendas" => "Ropa:4 prendas",
      "Pies 2" => $generoId == 1 ? "Pies_2_masculino" : "Pies_2_femenino",
      "Cinco dedos" => $generoId == 1 ? "Cinco_Dedos_femenino" : "Cinco_Dedos_femenino", // ← Femenino para Id 2
      "Pupilas" => $generoId == 1 ? "Pupilas_masculino" : "Pupilas_femenino",
    ];
    foreach ($respuestasItems as $itemNombre => $respuesta) {
      $p_c = $mapeoItems[$itemNombre] ?? null;
      if (!$p_c) continue;

      $baremo = $baremos->first(function ($b) use ($p_c, $edadMeses, $generoId) {
        $parts = explode('-', $b->edad_meses);
        $min = (int) $parts[0];
        $max = isset($parts[1]) ? (int) $parts[1] : $min;

        $esMasculino = str_contains($b->p_c, 'masculino');
        $esFemenino = str_contains($b->p_c, 'femenino');

        // ✅ Si el baremo no tiene género definido, ignora el filtro
        $generoCoincide = (!$esMasculino && !$esFemenino) ||
          ($esMasculino && $generoId == 1) ||
          ($esFemenino && $generoId == 2);

        return $b->p_c === $p_c && $edadMeses >= $min && $edadMeses <= $max && $generoCoincide;
      });

      if ($baremo) {
        $detallesPuntaje[$itemNombre] = [
          'baremo' => $baremo->p_c,
          'tipo' => $baremo->puntos,
          'respuesta' => $respuesta
        ];

        if ($baremo->puntos === "esperado" && $respuesta === "no") {
          $puntajeTotal--;
        } elseif ($baremo->puntos === "excepcional" && $respuesta === "si") {
          $itemsExcepcionales++;
        }
      }
    }

    $categoria = "";
    if ($puntajeTotal >= 7) $categoria = "Normal alto a superior (CI de 110 o más)";
    elseif ($puntajeTotal === 6) $categoria = "Normal a superior (CI 90 - 135)";
    elseif ($puntajeTotal === 5) $categoria = "Normal a normal alto (CI 85 - 120)";
    elseif ($puntajeTotal === 4) $categoria = "Normal a normal bajo (CI 80 - 110)";
    elseif ($puntajeTotal === 3) $categoria = "Normal bajo (CI 70 - 90)";
    elseif ($puntajeTotal === 2) $categoria = "Bordeline (CI 60 - 80)";
    else $categoria = "Mentalmente deficiente por posibles problemas emocionales";

    return [
      'edad_meses' => $edadMeses,
      'resultados' => [
        $subescalaNombre => [
          'puntajeTotal' => $puntajeTotal,
          'detallesPuntaje' => $detallesPuntaje,
          'categoria' => $categoria,
          'itemsExcepcionales' => $itemsExcepcionales
        ]
      ],
      'observaciones' => [
        $subescalaNombre => $observaciones
      ]
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
