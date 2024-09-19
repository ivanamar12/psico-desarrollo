<?php

namespace App\Http\Controllers;

use App\Models\LugarNacimiento;
use App\Models\Paciente;
use App\Models\Padres;
use App\Models\Representante;
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

class PacienteController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pacientes = DB::select('
                SELECT pacientes.*, representantes.nombre AS representante_nombre, representantes.apellido AS representante_apellido 
                FROM pacientes 
                LEFT JOIN representantes ON pacientes.representante_id = representantes.id
            ');
        
            return DataTables::of($pacientes)
                ->addColumn('representante', function($paciente) {
                    return $paciente->representante_nombre . ' ' . $paciente->representante_apellido;
                })
                ->addColumn('action', function($paciente) { 
                    $acciones = '<button type="button" name="delete" id="'.$paciente->id.'" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>'; 
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }        

        $pacientes = Paciente::all();
        $representantes = Representante::all();
        $generos = Genero::all();
        $estados = Estado::all();
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();
        return view('paciente.index', [
            'pacientes' => $pacientes, 
            'representantes' => $representantes, 
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
        'fecha_nac' => 'required|date|max:10',
        'genero_id' => 'required|exists:generos,id',
        'representante_id' => 'required|exists:representantes,id',
        'estado_nacimiento_id' => 'required|exists:estados,id',
        'municipio_nacimiento_id' => 'required|exists:municipios,id',
        'parroquia_nacimiento_id' => 'required|exists:parroquias,id',
        'lugar' => 'required|string|max:30',
        'nombre_mama' => 'required|string|max:120',
        'apellido_mama' => 'required|string|max:120',
        'ci_mama' => 'required|string|max:30',
        'fecha_nac_mama' => 'required|date',
        'grado_mama' => 'required|string|max:120',
        'telefono_mama' => 'required|string|max:30',
        'email_mama' => 'required|email|max:120',
        'nombre_papa' => 'required|string|max:120',
        'apellido_papa' => 'required|string|max:120',
        'ci_papa' => 'required|string|max:30',
        'fecha_nac_papa' => 'required|date',
        'grado_papa' => 'required|string|max:120',
        'telefono_papa' => 'required|string|max:30',
        'email_papa' => 'required|email|max:120',
        'estado_civil' => 'required|string|max:120',
        'custodia_niño' => 'required|string|max:120',
        'sector' => 'required|string|max:255',
        'estado_vive_id' => 'required|exists:estados,id',
        'municipio_vive_id' => 'required|exists:municipios,id',
        'parroquia_vive_id' => 'required|exists:parroquias,id',
    ]);

    \DB::transaction(function () use ($validatedData) {
        $lugarNacimiento = LugarNacimiento::create([
            'estado_id' => $validatedData['estado_nacimiento_id'],
            'municipio_id' => $validatedData['municipio_nacimiento_id'],
            'parroquia_id' => $validatedData['parroquia_nacimiento_id'],
            'lugar' => $validatedData['lugar'],
        ]);

        $direccionPadres = Direccion::create([
            'estado_id' => $validatedData['estado_vive_id'],
            'municipio_id' => $validatedData['municipio_vive_id'],
            'parroquia_id' => $validatedData['parroquia_vive_id'],
            'sector' => $validatedData['sector'],
        ]);

        $padre = Padres::create([
            'nombre_mama' => $validatedData['nombre_mama'],
            'apellido_mama' => $validatedData['apellido_mama'],
            'ci_mama' => $validatedData['ci_mama'],
            'fecha_nac_mama' => $validatedData['fecha_nac_mama'],
            'grado_mama' => $validatedData['grado_mama'],
            'telefono_mama' => $validatedData['telefono_mama'],
            'email_mama' => $validatedData['email_mama'],
            'nombre_papa' => $validatedData['nombre_papa'],
            'apellido_papa' => $validatedData['apellido_papa'],
            'ci_papa' => $validatedData['ci_papa'],
            'fecha_nac_papa' => $validatedData['fecha_nac_papa'],
            'grado_papa' => $validatedData['grado_papa'],
            'telefono_papa' => $validatedData['telefono_papa'],
            'email_papa' => $validatedData['email_papa'],
            'estado_civil' => $validatedData['estado_civil'],
            'custodia_niño' => $validatedData['custodia_niño'],
            'direccion_id' => $direccionPadres->id, 
        ]);

        Paciente::create([
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'fecha_nac' => $validatedData['fecha_nac'],
            'lugar_id' => $lugarNacimiento->id,
            'representante_id' => $validatedData['representante_id'],
            'padre_id' => $padre->id,
            'genero_id' => $validatedData['genero_id'],
        ]);
    });

    return response()->json(['success' => true]);
}


   
    public function show($id)
    {
        //
    }

    public function edit($id) {
        try {
            $paciente = Paciente::with(['padre.direccion', 'lugarNacimiento'])->find($id);
            
            if (!$paciente) {
                return response()->json(['error' => 'paciente no encontrado'], 404);
            }
            
            return response()->json($paciente);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor: ' . $e->getMessage()], 500);
        }
    }
    

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
    ]);

    \DB::transaction(function () use ($validatedData, $id) {
        $paciente = Paciente::findOrFail($id);
        
        $lugarNacimiento = $paciente->lugarNacimiento; 
        $lugarNacimiento->update([
            'estado_id' => $validatedData['estado_nacimiento_id'],
            'municipio_id' => $validatedData['municipio_nacimiento_id'],
            'parroquia_id' => $validatedData['parroquia_nacimiento_id'],
            'lugar' => $validatedData['lugar'],
        ]);

        $padre = $paciente->padre; 
        $padre->update([
            'nombre_mama' => $validatedData['nombre_mama'],
            'apellido_mama' => $validatedData['apellido_mama'],
            'ci_mama' => $validatedData['ci_mama'],
            'fecha_nac_mama' => $validatedData['fecha_nac_mama'],
            'grado_mama' => $validatedData['grado_mama'],
            'telefono_mama' => $validatedData['telefono_mama'],
            'email_mama' => $validatedData['email_mama'],
            'nombre_papa' => $validatedData['nombre_papa'],
            'apellido_papa' => $validatedData['apellido_papa'],
            'ci_papa' => $validatedData['ci_papa'],
            'fecha_nac_papa' => $validatedData['fecha_nac_papa'],
            'grado_papa' => $validatedData['grado_papa'],
            'telefono_papa' => $validatedData['telefono_papa'],
            'email_papa' => $validatedData['email_papa'],
            'estado_civil' => $validatedData['estado_civil'],
            'custodia_niño' => $validatedData['custodia_niño'],
            'direccion_id' => $padre->direccion_id, 
        ]);

        $direccionPadres = $padre->direccion; 
        $direccionPadres->update([
            'estado_id' => $validatedData['estado_vive_id'],
            'municipio_id' => $validatedData['municipio_vive_id'],
            'parroquia_id' => $validatedData['parroquia_vive_id'],
            'sector' => $validatedData['sector'],
        ]);

        $paciente->update([
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'fecha_nac' => $validatedData['fecha_nac'],
            'lugar_id' => $lugarNacimiento->id,
            'representante_id' => $validatedData['representante_id'],
            'padre_id' => $padre->id,
            'genero_id' => $validatedData['genero_id'],
        ]);
    });

    return response()->json(['success' => true]);
}
    
    public function destroy($id)
    {
        try {
            $paciente = Paciente::find($id);
    
            if (!$paciente) {
                return response()->json(['message' => 'Paciente no encontrado'], 404);
            }

            $paciente->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error al eliminar el paciente: ' . $e->getMessage());
            return response()->json(['message' => 'Error al eliminar el paciente: ' . $e->getMessage()], 500);
        }
    }



}
