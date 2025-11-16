<?php

namespace App\Http\Controllers;

use App\Http\Requests\Paciente\StorePacienteRequest;
use App\Http\Requests\Paciente\UpdatePacienteRequest;
use App\Models\Paciente;
use App\Models\Genero;
use App\Models\DatosEconomico;
use App\Models\Parentesco;
use App\Models\Representante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PacienteController extends Controller
{
  public function index(Request $request)
  {
    $pacientes = Paciente::all();
    if ($request->ajax()) {
      return DataTables::of($pacientes)
        ->addColumn('action', function ($paciente) {
          $acciones = '<button type="button" class="btn btn-info btn-raised btn-xs ver-paciente" data-id="' . $paciente->id . '"><i class="zmdi zmdi-eye"></i></button>';
          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('paciente.index', [
      'pacientes' => $pacientes,
      'representantes' => Representante::all(),
      'generos' => Genero::all(),
    ]);
  }

  public function store(StorePacienteRequest $request)
  {
    DB::transaction(function () use ($request) {
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
        'observacion' => $request->observacion ?? null,
      ]);

      $paciente = Paciente::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'fecha_nac' => $request->fecha_nac,
        'representante_id' => $request->representante_id,
        'datoseconomico_id' => $datosEconomicos->id,
        'genero_id' => $request->genero_id,
      ]);

      if (!empty($request->familiares)) {
        $familiaresData = collect($request->familiares)->map(function ($familiar) use ($paciente) {
          return [
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
            'created_at' => now(),
            'updated_at' => now(),
          ];
        })->toArray();

        Parentesco::insert($familiaresData);
      }
    });

    return response()->json([
      'success' => true,
      'message' => 'Paciente registrado con éxito!'
    ], 201);
  }

  public function show(Paciente $paciente)
  {
    $paciente->load([
      'genero',
      'representante',
      'datosEconomico',
      'parentescos'
    ]);

    return response()->json($paciente);
  }

  public function edit(Paciente $paciente)
  {
    $paciente->load([
      'datoseconomico',
      'parentescos'
    ]);

    return response()->json($paciente);
  }

  public function update(UpdatePacienteRequest $request, $id)
  {
    DB::transaction(function () use ($request, $id) {
      $paciente = Paciente::findOrFail($id);

      $paciente->update([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'fecha_nac' => $request->fecha_nac,
        'representante_id' => $request->representante_id,
        'genero_id' => $request->genero_id,
      ]);

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
    });

    return response()->json([
      'success' => true,
      'message' => 'Paciente actualizado correctamente!'
    ]);
  }
}
