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
                    // Concatenar las acciones
                    $acciones = '<a href="javascript:void(0)" onclick="mostrarepaciente('.$paciente->id.')" class="btn btn-info btn-raised btn-xs"><i class="zmdi zmdi-eye"></i></a>';
                    $acciones .= '<a href="javascript:void(0)" onclick="editpaciente('.$paciente->id.')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a>';
                    $acciones .= '<button type="button" name="delete" id="'.$paciente->id.'" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>'; 
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
    // Validar los datos de entrada
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
        // Validaciones para la dirección de los padres
        'estado_vive_id' => 'required|exists:estados,id',
        'municipio_vive_id' => 'required|exists:municipios,id',
        'parroquia_vive_id' => 'required|exists:parroquias,id',
    ]);

    \DB::transaction(function () use ($validatedData) {
        // Crear el lugar de nacimiento
        $lugarNacimiento = LugarNacimiento::create([
            'estado_id' => $validatedData['estado_nacimiento_id'],
            'municipio_id' => $validatedData['municipio_nacimiento_id'],
            'parroquia_id' => $validatedData['parroquia_nacimiento_id'],
            'lugar' => $validatedData['lugar'],
        ]);

        // Crear la dirección de los padres
        $direccionPadres = Direccion::create([
            'estado_id' => $validatedData['estado_vive_id'],
            'municipio_id' => $validatedData['municipio_vive_id'],
            'parroquia_id' => $validatedData['parroquia_vive_id'],
            'sector' => $validatedData['sector'],
        ]);

        // Crear el padre
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
            'direccion_id' => $direccionPadres->id, // Asignar la dirección al padre
        ]);

        // Crear el paciente
        Paciente::create([
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'fecha_nac' => $validatedData['fecha_nac'],
            'lugar_id' => $lugarNacimiento->id,
            'representante_id' => $validatedData['representante_id'],
            'padre_id' => $padre->id,
            'genero_id' => $validatedData['genero_id'],
            // Agrega más campos según sea necesario
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
            // Cargar el paciente junto con el padre, la dirección y el lugar de nacimiento
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
    // Validar los datos de entrada
    $validatedData = $request->validate([
        // Aquí van las mismas validaciones que tienes en el método store
    ]);

    \DB::transaction(function () use ($validatedData, $id) {
        // Encontrar el paciente existente
        $paciente = Paciente::findOrFail($id);
        
        // Actualizar el lugar de nacimiento
        $lugarNacimiento = $paciente->lugarNacimiento; // Asumiendo que tienes la relación definida
        $lugarNacimiento->update([
            'estado_id' => $validatedData['estado_nacimiento_id'],
            'municipio_id' => $validatedData['municipio_nacimiento_id'],
            'parroquia_id' => $validatedData['parroquia_nacimiento_id'],
            'lugar' => $validatedData['lugar'],
        ]);

        // Encontrar al padre
        $padre = $paciente->padre; // Asumiendo que tienes la relación definida
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
            'direccion_id' => $padre->direccion_id, // Mantener la dirección existente
        ]);

        // Actualizar la dirección
        $direccionPadres = $padre->direccion; // Asumiendo que tienes la relación definida
        $direccionPadres->update([
            'estado_id' => $validatedData['estado_vive_id'],
            'municipio_id' => $validatedData['municipio_vive_id'],
            'parroquia_id' => $validatedData['parroquia_vive_id'],
            'sector' => $validatedData['sector'],
        ]);

        // Actualizar el paciente
        $paciente->update([
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'fecha_nac' => $validatedData['fecha_nac'],
            'lugar_id' => $lugarNacimiento->id,
            'representante_id' => $validatedData['representante_id'],
            'padre_id' => $padre->id,
            'genero_id' => $validatedData['genero_id'],
            // Agrega más campos según sea necesario
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
