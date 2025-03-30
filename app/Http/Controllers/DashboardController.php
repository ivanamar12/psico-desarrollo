<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente; 
use App\Models\User; 
use App\Models\Representante; 
use App\Models\Especialista; 
use App\Models\Secretaria; 

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();
        $totalEspecialistas = Especialista::count();
        $totalSecretarias = Secretaria::count();
        
        $totalPacientes = Paciente::count(); 
        $totalRepresentantes = Representante::count(); 

        return view('dashboard', compact('totalUsuarios', 'totalEspecialistas', 'totalSecretarias', 'totalPacientes', 'totalRepresentantes'));
    }

    public function estadisticasPacientes()
    {
        $totalMasculino = Paciente::where('genero', 'Masculino')->count();
        $totalFemenino = Paciente::where('genero', 'Femenino')->count();

        $rangos = [3, 9, 15, 21, 27, 33, 39, 45, 51, 57, 68];
        $cantidadPorRango = [];

        foreach ($rangos as $rango) {
            $cantidadPorRango[] = Paciente::whereRaw("TIMESTAMPDIFF(MONTH, fecha_nacimiento, CURDATE()) <= ?", [$rango])->count();
        }

        return response()->json([
            'generos' => [
                'Masculino' => $totalMasculino,
                'Femenino' => $totalFemenino,
            ],
            'edades' => [
                'rangos' => $rangos,
                'cantidad' => $cantidadPorRango,
            ]
        ]);
    }

}
