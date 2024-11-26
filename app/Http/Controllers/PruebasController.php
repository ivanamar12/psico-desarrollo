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
        $areaDesarrollos = AreaDesarrollo::all();
        $tipoPruebas = TipoPrueba::all();
        $rangoPruebas = RangoPrueba::all();
        $pruebas = Prueba::all();
        $itemPruebas = ItemPrueba::all();
        $valorItems = ValorItem::all();
        return view('pruebas.index', [
            'areaDesarrollos' => $areaDesarrollos, 
            'tipoPruebas' => $tipoPruebas,
            'rangoPruebas' => $rangoPruebas, 
            'pruebas' => $pruebas, 
            'itemPruebas' => $itemPruebas,
            'valorItems' => $valorItems
        ]);
    }

    public function storeAreaDesarrollo(Request $request)
    {
        
        $validatedData = $request->validate([
            'area_desarrollo' => 'required|string|max:30|unique:area_desarrollos', 
        ]);

        AreaDesarrollo::create([
            'area_desarrollo' => $validatedData['area_desarrollo'],
        ]);

        return response()->json(['success' => true, 'message' => 'Área de desarrollo registrada con éxito']);
    }

    public function storeTipoPrueba(Request $request)
    {
        
        $validatedData = $request->validate([
            'tipo' => 'required|string|max:30|unique:tipo_pruebas', 
        ]);

        TipoPrueba::create([
            'tipo' => $validatedData['tipo'],
        ]);

         // Retornar una respuesta JSON con un mensaje de éxito
        return response()->json(['success' => true, 'message' => 'Tipo de prueba guardado con éxito.']);
    }

    public function storeRangoPrueba(Request $request)
    {
        
        $validatedData = $request->validate([
            'rango_edad' => 'required|string|max:30|unique:rango_pruebas', 
        ]);

        RangoPrueba::create([
            'rango_edad' => $validatedData['rango_edad'],
        ]);

         // Retornar una respuesta JSON con un mensaje de éxito
        return response()->json(['success' => true, 'message' => 'Tipo de prueba guardado con éxito.']);
    }
    
}