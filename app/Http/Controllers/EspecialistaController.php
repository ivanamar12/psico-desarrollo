<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Direccion;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class EspecialistaController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $especialistas = DB::select('SELECT * FROM especialistas');
        return DataTables::of($especialistas)
            ->addColumn('action', function($especialista) { 
                // Concatenar las acciones
                $acciones = '<a href="javascript:void(0)" onclick="mostrarespecialista('.$especialista->id.')" class="btn btn-info btn-raised btn-xs"><i class="zmdi zmdi-eye"></i></a>';
                $acciones .= '<a href="javascript:void(0)" onclick="editespecialista('.$especialista->id.')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a>';
                $acciones .= '<button type="button" name="delete" id="'.$especialista->id.'" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>'; 
                return $acciones;
            })
            ->rawColumns(['action'])
            ->make(true); 
    }

    $especialistas = Especialista::all();
    $generos = Genero::all();
    $estados = Estado::all();
    $municipios = Municipio::all();
    $parroquias = Parroquia::all();
    return view('especialista.index', [
        'especialistas' => $especialistas, 
        'generos' => $generos,
        'estados' => $estados, 
        'municipios' => $municipios, 
        'parroquias' => $parroquias
    ]);
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'fecha_nac' => 'required|date|max:10',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:especialistas,email',
            'genero_id' => 'required|exists:generos,id',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            'sector' => 'required|string|max:255',
        ]);

        \DB::transaction(function () use ($validatedData) {
            $direccion = Direccion::create([
                'estado_id' => $validatedData['estado_id'],
                'municipio_id' => $validatedData['municipio_id'],
                'parroquia_id' => $validatedData['parroquia_id'],
                'sector' => $validatedData['sector'],
            ]);

            Especialista::create([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'especialidad' => $validatedData['especialidad'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'genero_id' => $validatedData['genero_id'],
                'direccion_id' => $direccion->id,
            ]);
        });

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $especialista = Especialista::with('direccion')->find($id); // Cargar la relación
        if (!$especialista) {
            return response()->json(['message' => 'Especialista no encontrado'], 404);
        }
    
        $direccion = $especialista->direccion; // Ahora debería estar disponible
        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }
    
        \DB::transaction(function () use ($especialista, $direccion) {
            $especialista->delete();
            $direccion->delete();
        });
    
        return response()->json(['success' => true]);
    }

    public function edit($id) {
        try {
            $especialista = Especialista::with('direccion')->find($id);
            if (!$especialista) {
                return response()->json(['error' => 'Especialista no encontrado'], 404);
            }
            return response()->json($especialista);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor: ' . $e->getMessage()], 500);
        }
    }
    
    public function show($id) {
        $especialista = Especialista::with(['direccion.estado', 'direccion.municipio', 'direccion.parroquia', 'genero'])
            ->find($id);
    
        if (!$especialista) {
            return response()->json(['error' => 'Especialista no encontrado'], 404);
        }
    
        return response()->json([
            'nombre' => $especialista->nombre,
            'apellido' => $especialista->apellido,
            'ci' => $especialista->ci,
            'fecha_nac' => $especialista->fecha_nac,
            'especialidad' => $especialista->especialidad,
            'telefono' => $especialista->telefono,
            'email' => $especialista->email,
            'genero' => $especialista->genero ? $especialista->genero->nombre : null,
            'estado' => $especialista->direccion->estado ? $especialista->direccion->estado->nombre : null,
            'municipio' => $especialista->direccion->municipio ? $especialista->direccion->municipio->nombre : null,
            'parroquia' => $especialista->direccion->parroquia ? $especialista->direccion->parroquia->nombre : null,
            'sector' => $especialista->direccion->sector,
        ]);
    } 
     
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'fecha_nac' => 'required|date|max:10',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:especialistas,email,' . $id,
            'genero_id' => 'required|exists:generos,id',
            'estado_id' => 'required|exists:estados,id',
            'municipio_id' => 'required|exists:municipios,id',
            'parroquia_id' => 'required|exists:parroquias,id',
            'sector' => 'required|string|max:255',
        ]);
        
    
        $especialista = Especialista::with('direccion')->find($id); // Cargar la relación
        if (!$especialista) {
            return response()->json(['message' => 'Especialista no encontrado'], 404);
        }
    
        \DB::transaction(function () use ($validatedData, $especialista) {
            // Actualizar dirección
            $direccion = $especialista->direccion; // Ahora debería estar disponible
            if (!$direccion) {
                throw new \Exception('Dirección no encontrada'); // Lanza una excepción si no se encuentra
            }
    
            $direccion->update([
                'estado_id' => $validatedData['estado_id'],
                'municipio_id' => $validatedData['municipio_id'],
                'parroquia_id' => $validatedData['parroquia_id'],
                'sector' => $validatedData['sector'],
            ]);
    
            // Actualizar especialista
            $especialista->update([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'ci' => $validatedData['ci'],
                'fecha_nac' => $validatedData['fecha_nac'],
                'especialidad' => $validatedData['especialidad'],
                'telefono' => $validatedData['telefono'],
                'email' => $validatedData['email'],
                'genero_id' => $validatedData['genero_id'],
            ]);
        });
    
        return response()->json(['success' => true]);
    }

}
