<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Secretaria\StoreSecretariaRequest;
use App\Http\Requests\Secretaria\UpdateSecretariaRequest;
use App\Models\User;
use App\Models\Secretaria;
use App\Models\Direccion;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SecretariaController extends Controller
{
  public function index(Request $request)
  {
    $secretarias = Secretaria::all();
    if ($request->ajax()) {
      return DataTables::of($secretarias)
        ->addColumn('action', function ($secretaria) {
          $acciones = '';

          $acciones .= '<button type="button" class="btn btn-info btn-raised btn-xs ver-secretaria" data-id="' . $secretaria->id . '"><i class="zmdi zmdi-eye"></i></button>';

          if (auth()->user()->can('editar secretaria')) {
            $acciones .= '<a href="javascript:void(0)" onclick="editSecretaria(' . $secretaria->id . ')" class="btn btn-warning btn-raised btn-xs"><i class="zmdi zmdi-edit"></i></a>';
          }

          // if (auth()->user()->can('eliminar secretaria')) {
          //   $acciones .= '<button type="button" name="delete" id="' . $secretaria->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';
          // }

          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('secretaria.index', [
      'secretarias' => $secretarias,
      'generos' => Genero::all(),
      'estados' => Estado::all(),
      'municipios' => Municipio::all(),
      'parroquias' => Parroquia::all()
    ]);
  }

  public function store(StoreSecretariaRequest $request)
  {
    $validatedData = $request->validated();

    DB::transaction(function () use ($request, $validatedData) {
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
      ])->assignRole(Role::SECRETARIA);

      Secretaria::create($request->safe()->merge([
        'user_id' => $user->id,
        'direccion_id' => $direccion->id,
      ])->only([
        'nombre',
        'apellido',
        'ci',
        'fecha_nac',
        'grado',
        'telefono',
        'email',
        'user_id',
        'genero_id',
        'direccion_id',
      ]));
    });

    return response()->json([
      'success' => true,
      'message' => 'Secretaria registrada con éxito!'
    ]);
  }

  public function show(Secretaria $secretaria)
  {
    $secretaria->load([
      'genero',
      'direccion.estado',
      'direccion.municipio',
      'direccion.parroquia'
    ]);

    $secretaria->fecha_nac_formatted = format_date_with_age($secretaria->fecha_nac);

    return response()->json($secretaria);
  }

  public function edit(Secretaria $secretaria)
  {
    $secretaria->load('direccion');

    return response()->json($secretaria);
  }

  public function update(UpdateSecretariaRequest $request, Secretaria $secretaria)
  {
    DB::transaction(function () use ($request, $secretaria) {
      $secretaria->update($request->safe()->only([
        'ci',
        'nombre',
        'apellido',
        'fecha_nac',
        'grado',
        'telefono',
        'email',
        'genero_id',
      ]));

      $secretaria->direccion()->update($request->safe()->only([
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'sector',
      ]));
    });

    return response()->json([
      'success' => true,
      'message' => 'Secretaria actualizada correctamente!'
    ]);
  }
}
