<?php

namespace App\Http\Controllers;

use App\Models\AntecedenteMedico;
use App\Models\DatosSocioeconomico;
use App\Models\HistoriaClinica;
use App\Models\HistoriaDesarrollo;
use App\Models\HistoriaEscolar;
use App\Models\Parentesco;
use App\Models\Paciente;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use PDF; 

class HistoriaController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        $historias = HistoriaClinica::all();
        return view('historias.index', [
            'pacientes' => $pacientes, 
            'historias' => $historias
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
