<?php
namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\SubEscala;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
class PruebaController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pruebas = DB::select('SELECT *, tipo FROM pruebas'); // Asegúrate de incluir el campo 'tipo'
            return DataTables::of($pruebas)
                ->addColumn('action', function ($prueba) {
                    $acciones = '';
    
                    if ($prueba->tipo !== 'Estandarizada') { 
                        $acciones .= '<button type="button" name="delete" id="' . $prueba->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';
                    }
    
                    $acciones .= '<button type="button" class="btn btn-info btn-raised btn-xs ver-prueba" data-id="' . $prueba->id . '"><i class="zmdi zmdi-eye"></i></button>';
    
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pruebas.index');
    }
    
    
    public function storePrueba(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:600',
            'area_desarrollo' => 'required|string|max:255',
            'rango_edad' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.nombre' => 'required|string|max:700',
        ]);

        DB::beginTransaction();
        try {
            // Crear la prueba
            $prueba = Prueba::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'rango_edad' => $request->input('rango_edad'),
                'area_desarrollo' => $request->input('area_desarrollo'),
                'tipo' => 'NO-Estandarizada',
            ]);

            // Crear la subescala
            $subescala = SubEscala::create([
                'prueba_id' => $prueba->id,
                'sub_escala' => $request->input('area_desarrollo'),
                'descripcion' => 'Sin descripción',
            ]);

            // Registrar items relacionados con la subescala
            foreach ($request->items as $itemData) {
                Item::create([
                    'sub_escala_id' => $subescala->id,
                    'item' => $itemData['nombre'],
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Prueba y items registrados con éxito',
                'prueba_id' => $prueba->id,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar la prueba: ' . $e->getMessage()); // Log de error
            return response()->json([
                'message' => 'Error al registrar la prueba',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $data = DB::select("
            SELECT 
                p.id AS prueba_id,
                p.nombre AS prueba_nombre,
                p.descripcion AS prueba_descripcion,
                p.area_desarrollo AS area_desarrollo,  
                p.rango_edad AS rango_edad,           
                p.tipo AS tipo,                        
                se.id AS sub_escala_id,
                se.sub_escala AS sub_escala_nombre,
                se.descripcion AS sub_escala_descripcion,
                i.id AS item_id,
                i.item AS item_nombre
            FROM 
                pruebas p
            JOIN 
                sub_escalas se ON p.id = se.prueba_id
            JOIN 
                items i ON se.id = i.sub_escala_id
            WHERE 
                p.id = ?
        ", [$id]);  

        return response()->json($data);
    }

    public function destroy($id)
    {
        $prueba = Prueba::find($id);
        if (!$prueba) {
            return response()->json(['message' => 'Prueba no encontrada'], 404);
        }

        if ($prueba->tipo === 'Estandarizada') { 
            return response()->json(['message' => 'No se puede eliminar una prueba Estandarizada'], 403);
        }

        $prueba->delete();

        return response()->json(['success' => true]);
    }
}
