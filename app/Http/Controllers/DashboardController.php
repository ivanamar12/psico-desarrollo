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
}
