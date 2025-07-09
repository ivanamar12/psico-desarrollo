<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Paciente;
use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class InformeController extends Controller
{
    public function index(Request $request)
  {
    
	$especialistas = Especialista::all();
    $pacientes = Paciente::all();
    $informes = Informe::all();
    return view('informes.index', [
      'especialistas' => $especialistas,
      'pacientes' => $pacientes,
      'informes' => $informes
    ]);
}
