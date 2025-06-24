<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paciente\StorePacienteRequest;
use App\Http\Requests\Paciente\UpdatePacienteRequest;
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
use Yajra\DataTables\Facades\DataTables;

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
          $acciones .= '<button type="button" class="btn btn-info btn-raised btn-xs ver-paciente" data-id="' . $paciente->id . '"><i class="zmdi zmdi-eye"></i></button>';
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
    $datosEconomicos = DatosEconomico::all();
    return view('paciente.index', [
      'pacientes' => $pacientes,
      'representantes' => $representantes,
      'generos' => $generos,
      'estados' => $estados,
      'municipios' => $municipios,
      'parroquias' => $parroquias,
      'datosEconomicos' => $datosEconomicos
    ]);
  }

  public function store(StorePacienteRequest $request)
  {
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
        'observacion' => $request->tiene_observacion === 'si' ? $request->observacion : null,
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
    $paciente = Paciente::obtenerPaciente($id);

    if (!$paciente) return response()->json(['error' => 'paciente no encontrado'], 404);

    return response()->json($paciente);
  }


  public function edit($id)
  {
    $paciente = Paciente::with(['datoseconomico', 'parentescos'])->findOrFail($id);

    return response()->json($paciente);
  }

  public function update(UpdatePacienteRequest $request, $id)
  {
    DB::beginTransaction();

    try {
      // Buscar el paciente
      $paciente = Paciente::findOrFail($id);

      // Actualizar los datos del paciente
      $paciente->update([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'fecha_nac' => $request->fecha_nac,
        'representante_id' => $request->representante_id,
        'genero_id' => $request->genero_id,
      ]);

      // Actualizar los datos económicos
      $paciente->datoseconomico->update([
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
        'observacion' => $request->tiene_observacion === 'si' ? $request->observacion : null,
      ]);

      // Manejo de familiares (parentescos)
      $existentes = Parentesco::where('paciente_id', $id)->pluck('id')->toArray();
      $actualizados = [];

      foreach ($request->familiares as $familiar) {
        if (isset($familiar['id']) && in_array($familiar['id'], $existentes)) {
          // Actualizar familiar existente
          Parentesco::where('id', $familiar['id'])->update([
            'nombre' => $familiar['nombre'],
            'apellido' => $familiar['apellido'],
            'fecha_nac' => $familiar['fecha_nac'],
            'parentesco' => $familiar['parentesco'],
            'discapacidad' => $familiar['discapacidad'] ?? 'no aplica',
            'tipo_discapacidad' => $familiar['tipo_discapacidad'] ?? 'no aplica',
            'enfermedad_cronica' => $familiar['enfermedad_cronica'] ?? 'no aplica',
            'tipo_enfermedad' => $familiar['tipo_enfermedad'] ?? 'no aplica',
            'genero_id' => $familiar['genero_id'] ?? null,
          ]);
          $actualizados[] = $familiar['id'];
        } else {
          // Crear nuevo familiar
          $nuevoFamiliar = Parentesco::create([
            'paciente_id' => $paciente->id,
            'nombre' => $familiar['nombre'],
            'apellido' => $familiar['apellido'],
            'fecha_nac' => $familiar['fecha_nac'],
            'parentesco' => $familiar['parentesco'],
            'discapacidad' => $familiar['discapacidad'] ?? 'no aplica',
            'tipo_discapacidad' => $familiar['tipo_discapacidad'] ?? 'no aplica',
            'enfermedad_cronica' => $familiar['enfermedad_cronica'] ?? 'no aplica',
            'tipo_enfermedad' => $familiar['tipo_enfermedad'] ?? 'no aplica',
            'genero_id' => $familiar['genero_id'] ?? null,
          ]);
          $actualizados[] = $nuevoFamiliar->id;
        }
      }

      // Eliminar familiares que ya no están en la lista
      Parentesco::where('paciente_id', $id)->whereNotIn('id', $actualizados)->delete();

      DB::commit();
      return response()->json(['message' => 'Paciente actualizado exitosamente.'], 200);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['error' => 'Error al actualizar el paciente: ' . $e->getMessage()], 500);
    }
  }


  public function destroy($id)
  {
    try {
      $paciente = Paciente::find($id);

      if (!$paciente) return response()->json(['message' => 'Paciente no encontrado'], 404);

      $paciente->delete();

      return response()->json(['success' => true]);
    } catch (\Exception $e) {
      \Log::error('Error al eliminar el paciente: ' . $e->getMessage());
      return response()->json(['message' => 'Error al eliminar el paciente: ' . $e->getMessage()], 500);
    }
  }
}
