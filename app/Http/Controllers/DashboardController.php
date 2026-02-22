<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\AplicacionPrueba;
use App\Models\Especialista;
use App\Models\HistoriaEscolar;
use App\Models\Paciente;
use App\Models\Prueba;
use App\Models\Representante;
use App\Models\RiesgoPaciente;
use App\Models\Secretaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard', [
      'totalEspecialistas' => Especialista::count(),
      'totalSecretarias' => Secretaria::count(),
      'totalPacientes' => Paciente::count(),
      'totalRepresentantes' => Representante::count()
    ]);
  }

  public function estadisticasPacientes()
  {
    try {
      // === Datos de género ===
      $generos = Paciente::with('genero')
        ->select('genero_id', DB::raw('count(*) as total'))
        ->groupBy('genero_id')
        ->get()
        ->mapWithKeys(function ($item) {
          return [$item->genero->genero => $item->total];
        })
        ->toArray();

      // === Datos de edad ===
      $rangos = [
        ['min' => 0, 'max' => 3],
        ['min' => 4, 'max' => 9],
        ['min' => 10, 'max' => 15],
        ['min' => 16, 'max' => 24],
        ['min' => 25, 'max' => 120]
      ];

      $edades = [];
      foreach ($rangos as $rango) {
        $count = Paciente::whereRaw(
          "TIMESTAMPDIFF(MONTH, fecha_nac, CURDATE()) BETWEEN ? AND ?",
          [$rango['min'], $rango['max']]
        )->count();

        $edades[] = [
          'rango' => "{$rango['min']}-{$rango['max']} meses",
          'cantidad' => $count
        ];
      }

      // === Datos de riesgos ===
      $riesgos = RiesgoPaciente::all();

      $riesgoSocial = [
        'bajo' => $riesgos->where('riesgo_social', '<=', 3)->count(),
        'medio' => $riesgos->where('riesgo_social', '>', 3)->where('riesgo_social', '<=', 6)->count(),
        'alto' => $riesgos->where('riesgo_social', '>', 6)->count(),
      ];

      $riesgoBiologico = [
        'bajo' => $riesgos->where('riesgo_biologico', '<=', 3)->count(),
        'medio' => $riesgos->where('riesgo_biologico', '>', 3)->where('riesgo_biologico', '<=', 6)->count(),
        'alto' => $riesgos->where('riesgo_biologico', '>', 6)->count(),
      ];

      $riesgoGlobal = [
        'bajo' => $riesgos->where('riesgo_global', 'bajo')->count(),
        'medio' => $riesgos->where('riesgo_global', 'medio')->count(),
        'alto' => $riesgos->where('riesgo_global', 'alto')->count(),
      ];

      return response()->json([
        'generos' => $generos,
        'edades' => $edades,
        'riesgoSocial' => $riesgoSocial,
        'riesgoBiologico' => $riesgoBiologico,
        'riesgoGlobal' => $riesgoGlobal,
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  public function estadisticasEscolarizacion()
  {
    try {
      // === Datos de escolarización ===
      $escolarizados = HistoriaEscolar::select('escolarizado', DB::raw('count(*) as total'))
        ->groupBy('escolarizado')
        ->get()
        ->mapWithKeys(fn($item) => [$item->escolarizado => $item->total])
        ->toArray();

      // === Datos de modalidad de educación ===
      $modalidades = HistoriaEscolar::select('modalidad_educacion', DB::raw('count(*) as total'))
        ->groupBy('modalidad_educacion')
        ->get()
        ->mapWithKeys(fn($item) => [$item->modalidad_educacion => $item->total])
        ->toArray();

      return response()->json([
        'escolarizados' => $escolarizados,
        'modalidades' => $modalidades,
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }


  public function estadisticasPruebas()
  {
    try {
      $user = Auth::user();
      $query = AplicacionPrueba::query();

      if ($user->hasRole(Role::ESPECIALISTA->value)) {
        $especialistaId = Especialista::where('user_id', $user->id)->value('id');
        $query->where('especialista_id', $especialistaId);
      }

      // Top 3 Pruebas (Barras horizontales)
      $topPruebas = (clone $query)
        ->join('pruebas', 'aplicacion_pruebas.prueba_id', '=', 'pruebas.id')
        ->select('pruebas.nombre', DB::raw('count(*) as total'))
        ->groupBy('pruebas.nombre', 'pruebas.id')
        ->orderBy('total', 'desc')
        ->limit(3)
        ->get();

      // Tendencia últimos 6 meses (Línea)
      $tendencia = (clone $query)
        ->select(
          DB::raw("DATE_FORMAT(created_at, '%b') as mes"),
          DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('mes', DB::raw("MONTH(created_at)"))
        ->orderBy(DB::raw("MONTH(created_at)"))
        ->get();

      return response()->json([
        'top' => [
          'labels' => $topPruebas->pluck('nombre'),
          'data'   => $topPruebas->pluck('total')
        ],
        'tendencia' => [
          'labels' => $tendencia->pluck('mes'),
          'data'   => $tendencia->pluck('total')
        ]
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }
}

