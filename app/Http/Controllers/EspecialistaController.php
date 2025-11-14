<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Especialista\StoreEspecialistaRequest;
use App\Http\Requests\Especialista\UpdateEspecialistaRequest;
use App\Models\User;
use App\Models\Especialista;
use App\Models\Direccion;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EspecialistaController extends Controller
{
  public function index(Request $request)
  {
    $especialistas = Especialista::all();
    if ($request->ajax()) {
      return DataTables::of($especialistas)
        ->addColumn('action', function ($especialista) {
          $acciones = '';

          $acciones .= '<button type="button" class="btn btn-info btn-raised btn-xs ver-especialista" data-id="' . $especialista->id . '"><i class="zmdi zmdi-eye"></i></button>';

          if (auth()->user()->can('editar especialista')) {
            $acciones .= '<a href="javascript:void(0)" onclick="editespecialista(' . $especialista->id . ')" class="btn btn-warning btn-raised btn-xs"><i class="zmdi zmdi-edit"></i></a>';
          }

          // if (auth()->user()->can('eliminar especialista')) {
          //   $acciones .= '<button type="button" name="delete" id="' . $especialista->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';
          // }

          return $acciones;
        })

        ->rawColumns(['action'])
        ->make(true);
    }

    return view('especialista.index', [
      'especialistas' => $especialistas,
      'generos' => Genero::all(),
      'estados' => Estado::all(),
      'municipios' => Municipio::all(),
      'parroquias' => Parroquia::all(),
      'especialidades' => Especialidad::all()
    ]);
  }

  public function show(Especialista $especialista)
  {
    $especialista->load([
      'genero',
      'especialidad',
      'direccion.estado',
      'direccion.municipio',
      'direccion.parroquia'
    ]);

    $especialista->fecha_nac_formatted = format_date_with_age($especialista->fecha_nac);

    return response()->json($especialista);
  }

  public function store(StoreEspecialistaRequest $request)
  {
    DB::transaction(function () use ($request) {
      $validatedData = $request->validated();

      $direccion = Direccion::create($request->safe()->only([
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'sector',
      ]));

      $user = User::create([
        'name' => $validatedData['nombre'] . ' ' . $validatedData['apellido'],
        'email' => $validatedData['email'],
        'password' => Hash::make('password123'),
      ])->assignRole(Role::ESPECIALISTA);

      Especialista::create($request->safe()->merge([
        'user_id' => $user->id,
        'direccion_id' => $direccion->id,
      ])->only([
        'nombre',
        'apellido',
        'ci',
        'fecha_nac',
        'especialidad_id',
        'telefono',
        'email',
        'fvp',
        'user_id',
        'genero_id',
        'direccion_id',
      ]));
    });

    return response()->json([
      'success' => true,
      'message' => 'Especialista registrado con éxito!'
    ]);
  }

  public function edit(Especialista $especialista)
  {
    $especialista->load('direccion');

    return response()->json($especialista);
  }

  public function update(UpdateEspecialistaRequest $request, Especialista $especialista)
  {
    DB::transaction(function () use ($request, $especialista) {
      $especialista->update($request->safe()->only([
        'nombre',
        'apellido',
        'ci',
        'fecha_nac',
        'especialidad_id',
        'telefono',
        'email',
        'genero_id',
      ]));

      $especialista->direccion()->update($request->safe()->only([
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'sector',
      ]));
    });

    return response()->json(['success' => true]);
  }
}
