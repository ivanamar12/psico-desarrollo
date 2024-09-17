<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class AnimalController extends BaseController
{ 
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $animales = DB::select('SELECT * FROM animals');
            return DataTables::of($animales)
                ->addColumn('action', function($animal) { 
                    $acciones = '<a href="javascript:void(0)" onclick="editAnimal('.$animal->id.')" class="btn btn-info btn-sm">Editar</a>';
                    $acciones .= '<button type="button" name="delete" id="'.$animal->id.'" class="delete btn btn-danger btn-sm">Eliminar</button>'; // Usa $animal en lugar de $animales
                    
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
        
        return view('animal.index');
    }
    

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'especie' => 'required|string|max:255',
        'genero' => 'required|string|in:macho,hembra',
    ]);

    DB::insert('INSERT INTO animals (nombre, animal, genero) VALUES (?, ?, ?)', [
        $request->nombre,
        $request->especie,
        $request->genero
    ]);

    return response()->json(['success' => true]);
}

public function destroy($id)
{
    $animal = DB::delete('DELETE FROM animals WHERE id = ?',[$id]);
    return back();
}

public function edit($id) {
    $animal = Animal::find($id);
    if (!$animal) {
        return response()->json(['error' => 'Animal not found'], 404);
    }
    return response()->json($animal);
}

public function update(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:animals,id',
        'nombre' => 'required|string|max:255',
        'especie' => 'required|string|max:255',
        'genero' => 'required|string|in:macho,hembra',
    ]);

    // Actualizar el registro en la base de datos
    $updated = DB::update('UPDATE `animals` SET `nombre` = ?, `animal` = ?, `genero` = ? WHERE id = ?', [
        $request->nombre,
        $request->especie,
        $request->genero,
        $request->id
    ]);

    // Verificar si la actualización fue exitosa
    if ($updated) {
        return response()->json(['message' => 'Animal actualizado con éxito.'], 200);
    } else {
        return response()->json(['error' => 'No se pudo actualizar el animal.'], 500);
    }
}


}