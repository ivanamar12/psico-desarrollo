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

        if ($request->ajax()) {
            $pruebas = DB::select('
                SELECT 
                    pruebas.*, 
                    rango_pruebas.rango_edad AS rangoEdad, 
                    tipo_pruebas.tipo AS tipo, 
                    area_desarrollos.area_desarrollo AS areaDesarrollo
                FROM 
                    pruebas
                JOIN 
                    rango_pruebas ON pruebas.rango_prueba_id = rango_pruebas.id
                JOIN 
                    area_desarrollos ON pruebas.area_desarrollo_id = area_desarrollos.id
                JOIN 
                    tipo_pruebas ON pruebas.tipo_prueba_id = tipo_pruebas.id
            ');
        
            return DataTables::of($pruebas)
            ->addColumn('action', function ($prueba) {
                $acciones = '';

                // Botón Ver
                $acciones .= '<button class="btn btn-info btn-raised btn-xs btn-ver-prueba" 
                    data-id="' . $prueba->id . '"><i class="zmdi zmdi-eye"></i></button>';

                // Botón Editar Prueba
                $acciones .= '<button type="button" class="btn btn-primary btn-raised btn-xs" 
                    data-bs-toggle="modal" data-bs-target="#modalEditarPrueba" 
                    onclick="abrirModalEditarPrueba(' . $prueba->id . ')">
                    <i class="zmdi zmdi-edit"></i>
                </button>';

                // Botón para cambiar el estado
                $acciones .= '<a href="javascript:void(0)" onclick="abrirModalCambiarEstatus('.$prueba->id.')" class="btn btn-warning btn-raised btn-xs">
                <i class="zmdi zmdi-refresh"></i>
                </a>';




                return $acciones;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
            

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

        return response()->json(['success' => true, 'message' => 'Tipo de prueba guardado con éxito.']);
    }

    public function storePrueba(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'area_desarrollo_id' => 'required|exists:area_desarrollos,id',
            'tipo_prueba_id' => 'required|exists:tipo_pruebas,id',
            'rango_edad_id' => 'required|exists:rango_pruebas,id',
            'items' => 'required|array',
            'items.*.nombre' => 'required|string|max:255',
            'items.*.valorI' => 'required|string|in:si,no',
            'items.*.valor' => 'nullable|string|max:255',
            'items.*.interpretacion' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $prueba = Prueba::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'status' => 'activa', 
                'area_desarrollo_id' => $request->input('area_desarrollo_id'),
                'tipo_prueba_id' => $request->input('tipo_prueba_id'),
                'rango_prueba_id' => $request->input('rango_edad_id'),
            ]);

            $items = $request->input('items');
            foreach ($items as $item) {
                $itemRecord = ItemPrueba::create([
                    'item' => $item['nombre'],
                    'prueba_id' => $prueba->id,
                ]);

                if (isset($item['valorI']) && $item['valorI'] === 'si') {
                    ValorItem::create([
                        'valor' => $item['valor'],
                        'interpretacion' => $item['interpretacion'],
                        'item_prueba_id' => $itemRecord->id,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Prueba registrada exitosamente',
                'prueba_id' => $prueba->id,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error al registrar la prueba',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function show($id)
    {
        $prueba = (new Prueba())->obtenerDatosFormato($id);

        if (!$prueba) {
            return response()->json(['error' => 'Prueba no encontrada'], 404);
        }

        return response()->json($prueba);
    }

    public function obtenerDatosPrueba($id)
    {
        $prueba = Prueba::with('itemPruebas')->findOrFail($id);

        return response()->json([
            'id' => $prueba->id,
            'nombre' => $prueba->nombre,
            'descripcion' => $prueba->descripcion,
            'items' => $prueba->itemPruebas->pluck('item')->toArray()
        ]);
    }

    public function cambiarEstatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:pruebas,id',
            'status' => 'required|string|in:activa,inactiva',
        ]);
    
        $prueba = Prueba::find($request->id);
        $prueba->status = $request->status;
        $prueba->save();
    
        return response()->json(['message' => 'Estado actualizado correctamente.']);
    }
    
}