<?php

namespace App\Http\Controllers;

use App\Models\AreaDesarrollo;
use App\Models\TipoPrueba;
use App\Models\RangoPrueba;
use App\Models\Prueba;
use App\Models\ItemPrueba;
use App\Models\ValorItem;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class PruebasController extends Controller
{
    public function index(Request $request)
    {
        return view('pruebas.index');
    }
    
}
