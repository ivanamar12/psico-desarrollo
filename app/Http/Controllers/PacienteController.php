<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Paciente\StorePacienteRequest;
use App\Http\Requests\Paciente\UpdatePacienteRequest;
use App\Models\DatosEconomico;
use App\Models\Especialista;
use App\Models\Genero;
use App\Models\Paciente;
use App\Models\Parentesco;
use App\Models\Representante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PacienteController extends Controller
{
  public function index(Request $request)
  {
    $query = Paciente::query();

    if ($request->has('mis_pacientes') && $request->mis_pacientes == 1) {
      $especialistaId = Especialista::where('user_id', Auth::id())->value('id');
      $query->whereHas('aplicacionPruebas', function($q) use ($especialistaId) {
        $q->where('especialista_id', $especialistaId);
      });
    }

    $pacientes = $query->get();

    if ($request->ajax()) {
      return DataTables::of($pacientes)
        ->addColumn('action', function ($paciente) {
          $acciones = '<button type="button" class="btn btn-info btn-raised btn-xs ver-paciente" data-id="' . $paciente->id . '"><i class="zmdi zmdi-eye"></i></button>';

          if (auth()->user()->can('editar paciente')) {
            $acciones .= '<a href="javascript:void(0)" onclick="editPaciente(' . $paciente->id . ')" class="btn btn-warning btn-raised btn-xs"><i class="zmdi zmdi-edit"></i></a>';
          }

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
      $datosEconomicos = DatosEconomico::create($request->safe()
        ->merge([
          'observacion' => $request->observacion ?? null,
        ])
        ->only([
          'tipo_vivienda',
          'cantidad_habitaciones',
          'cantidad_personas',
          'servecio_agua_potable',
          'servecio_gas',
          'servecio_electricidad',
          'servecio_drenaje',
          'disponibilidad_internet',
          'tipo_conexion_internet',
          'acceso_servcios_publicos',
          'fuente_ingreso_familiar',
          'observacion',
        ]));

      $paciente = Paciente::create($request->safe()
        ->merge([
          'datoseconomico_id' => $datosEconomicos->id,
        ])
        ->only([
          'nombre',
          'apellido',
          'fecha_nac',
          'representante_id',
          'datoseconomico_id',
          'genero_id',
        ]));

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
            'genero_id' => $familiar['genero_id'],
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
    ]);
  }

  public function show(Paciente $paciente)
  {
    $paciente->load([
      'genero',
      'representante',
      'datosEconomico',
      'parentescos.genero'
    ]);

    return response()->json($paciente);
  }

  public function edit(Paciente $paciente)
  {
    $paciente->load([
      'datosEconomico',
      'parentescos',
      'genero',
      'representante'
    ]);

    return response()->json($paciente);
  }

  public function update(UpdatePacienteRequest $request, Paciente $paciente)
  {
    DB::transaction(function () use ($request, $paciente) {
      // Actualizar paciente
      $paciente->update($request->safe()->only([
        'nombre',
        'apellido',
        'fecha_nac',
        'representante_id',
        'genero_id',
      ]));

      // Actualizar datos económicos
      $paciente->datosEconomico->update($request->safe()
        ->merge([
          'observacion' => $request->observacion ?? null,
        ])
        ->only([
          'tipo_vivienda',
          'cantidad_habitaciones',
          'cantidad_personas',
          'servecio_agua_potable',
          'servecio_gas',
          'servecio_electricidad',
          'servecio_drenaje',
          'disponibilidad_internet',
          'tipo_conexion_internet',
          'acceso_servcios_publicos',
          'fuente_ingreso_familiar',
          'observacion',
        ]));

      $actualizados = [];

      if (!empty($request->familiares)) {
        foreach ($request->familiares as $familiar) {
          if (isset($familiar['id']) && $paciente->parentescos->contains('id', $familiar['id'])) {
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
              'genero_id' => $familiar['genero_id'],
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
              'genero_id' => $familiar['genero_id'],
            ]);
            $actualizados[] = $nuevoFamiliar->id;
          }
        }
      }

      // Eliminar familiares que ya no están en la lista
      Parentesco::where('paciente_id', $paciente->id)
        ->whereNotIn('id', $actualizados)
        ->delete();
    });

    return response()->json([
      'success' => true,
      'message' => 'Paciente actualizado correctamente!'
    ]);
  }
}
