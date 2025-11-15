<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Secretaria\StoreSecretariaRequest;
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
            $acciones .= '<a href="javascript:void(0)" onclick="editsecretaria(' . $secretaria->id . ')" class="btn btn-warning btn-raised btn-xs"><i class="zmdi zmdi-edit"></i></a>';
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

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'nombre' => 'required|string|max:255',
      'apellido' => 'required|string|max:255',
      'ci' => 'required|string|max:255',
      'fecha_nac' => 'required|date|max:10',
      'grado' => 'required|string|max:255',
      'telefono' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'genero_id' => 'required|exists:generos,id',
      'estado_id' => 'required|exists:estados,id',
      'municipio_id' => 'required|exists:municipios,id',
      'parroquia_id' => 'required|exists:parroquias,id',
      'sector' => 'required|string|max:255',
    ]);

    $secretaria = Secretaria::with('direccion')->find($id);
    if (!$secretaria) {
      return response()->json(['message' => 'Especialista no encontrado'], 404);
    }

    DB::transaction(function () use ($validatedData, $secretaria) {
      $direccion = $secretaria->direccion;
      if (!$direccion) {
        throw new \Exception('Dirección no encontrada');
      }

      $direccion->update([
        'estado_id' => $validatedData['estado_id'],
        'municipio_id' => $validatedData['municipio_id'],
        'parroquia_id' => $validatedData['parroquia_id'],
        'sector' => $validatedData['sector'],
      ]);

      $secretaria->update([
        'nombre' => $validatedData['nombre'],
        'apellido' => $validatedData['apellido'],
        'ci' => $validatedData['ci'],
        'fecha_nac' => $validatedData['fecha_nac'],
        'grado' => $validatedData['grado'],
        'telefono' => $validatedData['telefono'],
        'email' => $validatedData['email'],
        'genero_id' => $validatedData['genero_id'],
      ]);
    });

    return response()->json(['success' => true]);
  }
}
