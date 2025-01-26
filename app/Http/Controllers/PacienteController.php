<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\DatosEconomico;
use App\Models\Parentesco;
use App\Models\Representante;

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
        ->addColumn('representante', function ($paciente) {
          return $paciente->representante_nombre . ' ' . $paciente->representante_apellido;
        })
        ->addColumn('action', function ($paciente) {
          $acciones = '<button type="button" name="delete" id="' . $paciente->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';
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
    // Validación de los datos recibidos
    $request->validate([
      'nombre' => 'required|string|max:120',
      'apellido' => 'required|string|max:120',
      'fecha_nac' => 'required|date',
      'representante_id' => 'nullable|exists:representantes,id',
      'tipo_vivienda' => 'required|string',
      'cantidad_habitaciones' => 'required|integer|min:0',
      'cantidad_personas' => 'required|integer|min:0',
      'servecio_agua_potable' => 'required|string',
      'servecio_gas' => 'required|string',
      'servecio_electricidad' => 'required|string',
      'servecio_drenaje' => 'required|string',
      'disponibilidad_internet' => 'required|string',
      'tipo_conexion_internet' => 'nullable|string',
      'acceso_servcios_publicos' => 'required|string',
      'fuente_ingreso_familiar' => 'required|string',
      'familiares' => 'array',
      'familiares.*.nombre' => 'required|string|max:120',
      'familiares.*.apellido' => 'required|string|max:120',
      'familiares.*.fecha_nac' => 'required|date',
      'familiares.*.parentesco' => 'required|string|max:120',
      'familiares.*.discapacidad' => 'nullable|string|max:120',
      'familiares.*.tipo_discapacidad' => 'nullable|string|max:120',
      'familiares.*.enfermedad_cronica' => 'nullable|string|max:120',
      'familiares.*.tipo_enfermedad' => 'nullable|string|max:120',
    ]);

    DB::beginTransaction();
    try {
      // Crear los datos económicos
      $datosEconomicos = DatosEconomico::create([
        'tipo_vivienda' => $request->tipo_vivienda,
        'cantidad_habitaciones' => $request->cantidad_habitaciones,
        'cantidad_personas' => $request->cantidad_personas,
        'servecio_agua_potable' => $request->servecio_agua_potable,
        'servecio_gas' => $request->servecio_gas,
        'servecio_electricidad' => $request->servecio_electricidad,
        'servecio_drenaje' => $request->servecio_drenaje,
        'disponibilidad_internet' => $request->disponibilidad_internet,
        'tipo_conexion_internet' => $request->tipo_conexion_internet,
        'acceso_servcios_publicos' => $request->acceso_servcios_publicos,
        'fuente_ingreso_familiar' => $request->fuente_ingreso_familiar,
      ]);

      // Crear el paciente
      $paciente = Paciente::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'fecha_nac' => $request->fecha_nac,
        'representante_id' => $request->representante_id,
        'datoseconomico_id' => $datosEconomicos->id,
        'genero_id' => $request->genero_id,
      ]);

      // Crear los familiares
      foreach ($request->familiares as $familiar) {
        Parentesco::create([
          'paciente_id' => $paciente->id,
          'nombre' => $familiar['nombre'],
          'apellido' => $familiar['apellido'],
          'fecha_nac' => $familiar['fecha_nac'],
          'parentesco' => $familiar['parentesco'],
          'discapacidad' => $familiar['discapacidad'] ?? 'no aplica',
          'tipo_discapacidad' => $familiar['tipo_discapacidad'] ?? 'no aplica',
          'enfermedad_cronica' => $familiar['enfermedad_cronica'] ?? 'no aplica',
          'tipo_enfermedad' => $familiar['tipo_enfermedad'] ?? 'no aplica',
          'genero_id' => $familiar['genero_id'] ?? null, // Asegúrate de que este campo esté presente si es necesario
        ]);
      }

      DB::commit();
      return response()->json(['message' => 'Paciente registrado exitosamente.'], 201);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => 'Error al registrar el paciente: ' . $e->getMessage()], 500);
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
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
    $validatedData = $request->validate([]);

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
