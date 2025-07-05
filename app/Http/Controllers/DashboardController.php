<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Representante;
use App\Models\Especialista;
use App\Models\Secretaria;
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
      // Obtener distribución por géneros
      $generos = Paciente::with('genero')
        ->select('genero_id', DB::raw('count(*) as total'))
        ->groupBy('genero_id')
        ->get()
        ->mapWithKeys(function ($item) {
          return [$item->genero->genero => $item->total];
        })
        ->toArray();

      // Definir rangos de edad
      $rangos = [
        ['min' => 0, 'max' => 3],
        ['min' => 4, 'max' => 9],
        ['min' => 10, 'max' => 15],
        ['min' => 16, 'max' => 24],
        ['min' => 25, 'max' => 120] // meses (10 años)
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

      return response()->json([
        'generos' => $generos,
        'edades' => $edades
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }
}
