<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Representante;
use App\Models\Especialista;
use App\Models\Secretaria;
use App\Models\RiesgoPaciente;
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
}
