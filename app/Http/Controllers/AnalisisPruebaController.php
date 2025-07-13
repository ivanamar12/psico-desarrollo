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
    public function guardarResultados(Request $request)
    {
        try {
            $pruebaId = $request->input('prueba_id');
            $edadMeses = $request->input('edad_meses');
            $generoId = $request->input('genero_id') ?? 1;
            $lateralidad = $request->input('lateralidad');
            $observaciones = $request->input('observaciones');
            $nombrePrueba = $request->input('nombre_prueba') ?? 'Koppitz';

            // ⚠️ Evitar duplicados
            if (ResultadosPruebas::where('aplicacion_pruebas_id', $pruebaId)->exists()) {
                return response()->json(['mensaje' => 'El resultado ya fue guardado previamente']);
            }

            // ✅ Si es Koppitz, recalculamos en backend
            if ($nombrePrueba === 'Koppitz') {
                $respuestas = $request->input('respuestas');
                $resultados = $this->analizarKoppitzPHP($respuestas, $edadMeses, $generoId);
            } else {
                // CUMANIN o NO-Estandarizada: usamos lo que vino
                $resultados = [
                    'edad_meses' => $edadMeses,
                    'resultados' => $request->input('resultados'),
                    'lateralidad' => $lateralidad,
                    'observaciones' => $observaciones
                ];
            }

            // Guardar
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
}
