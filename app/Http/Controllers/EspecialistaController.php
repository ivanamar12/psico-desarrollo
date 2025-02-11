<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Especialista;
use App\Models\Direccion;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Especialidad;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;

class EspecialistaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $especialistas = DB::select('SELECT * FROM especialistas');
      return DataTables::of($especialistas)
        ->addColumn('action', function ($especialista) {
          $acciones = '<a href="javascript:void(0)" onclick="editespecialista(' . $especialista->id . ')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a>';
          $acciones .= '<button type="button" name="delete" id="' . $especialista->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';
          $acciones .= '<button type="button" class="btn btn-info btn-raised btn-xs ver-especialista" data-id="' . $especialista->id . '"><i class="zmdi zmdi-eye"></i></button>';
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
    $especialidades = Especialidad::all();
    return view('especialista.index', [
      'especialistas' => $especialistas,
      'generos' => $generos,
      'estados' => $estados,
      'municipios' => $municipios,
      'parroquias' => $parroquias,
      'especialidades' => $especialidades
    ]);
  }

  public function show($id)
  {
    $especialista = DB::select("
            SELECT 
                especialistas.id AS especialista, 
                especialistas.nombre AS nombre, 
                especialistas.apellido AS apellido, 
                especialistas.ci AS ci, 
                especialistas.fecha_nac AS fecha_nac, 
                especialistas.telefono AS telefono, 
                especialistas.email AS email, 
                generos.genero AS genero, 
                especialidads.especialidad AS especialidad, 
                estados.estado AS estado, 
                municipios.municipio AS municipio, 
                parroquias.parroquia AS parroquia, 
                direccions.sector AS sector
            FROM 
                especialistas
            JOIN 
                generos ON especialistas.genero_id = generos.id 
            JOIN 
                especialidads ON especialistas.especialidad_id = especialidads.id 
            JOIN 
                direccions ON especialistas.direccion_id = direccions.id
            JOIN 
                estados ON direccions.estado_id = estados.id
            JOIN 
                municipios ON direccions.municipio_id = municipios.id
            JOIN 
                parroquias ON direccions.parroquia_id = parroquias.id
            WHERE 
                especialistas.id = ?
        ", [$id]);

    return response()->json($especialista);
  }

  public function store(Request $request)
  {
      $validatedData = $request->validate([
          'nombre' => 'required|string|max:255',
          'apellido' => 'required|string|max:255',
          'ci' => 'required|string|max:255',
          'fecha_nac' => 'required|date|max:10',
          'especialidad_id' => 'required|string|max:255',
          'telefono' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:especialistas,email|unique:users,email',
          'genero_id' => 'required|exists:generos,id',
          'estado_id' => 'required|exists:estados,id',
          'municipio_id' => 'required|exists:municipios,id',
          'parroquia_id' => 'required|exists:parroquias,id',
          'sector' => 'required|string|max:255',
      ]);

      \DB::transaction(function () use ($validatedData) {
          // Crear la dirección del especialista
          $direccion = Direccion::create([
              'estado_id' => $validatedData['estado_id'],
              'municipio_id' => $validatedData['municipio_id'],
              'parroquia_id' => $validatedData['parroquia_id'],
              'sector' => $validatedData['sector'],
          ]);

          // Crear el especialista
          $especialista = Especialista::create([
              'nombre' => $validatedData['nombre'],
              'apellido' => $validatedData['apellido'],
              'ci' => $validatedData['ci'],
              'fecha_nac' => $validatedData['fecha_nac'],
              'especialidad_id' => $validatedData['especialidad_id'],
              'telefono' => $validatedData['telefono'],
              'email' => $validatedData['email'],
              'genero_id' => $validatedData['genero_id'],
              'direccion_id' => $direccion->id,
          ]);

          // Crear usuario automáticamente en `users`
          $user = User::create([
              'name' => $validatedData['nombre'] . ' ' . $validatedData['apellido'],
              'email' => $validatedData['email'],
              'password' => Hash::make('password123'), // Contraseña temporal
          ]);

          // Asignar el rol "ESPECIALISTA" usando Spatie
          $user->assignRole('ESPECIALISTA');

          // Relacionar usuario con especialista (si tienes un campo `user_id` en la tabla `especialistas`)
          $especialista->update(['user_id' => $user->id]);
      });

      return response()->json(['success' => true, 'message' => 'Especialista y usuario creados correctamente']);
  }

  public function edit($id)
  {
    try {
      $especialista = Especialista::with('direccion')->find($id);
      if (!$especialista) {
        return response()->json(['error' => 'especialista no encontrado'], 404);
      }
      return response()->json($especialista);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Error interno del servidor: ' . $e->getMessage()], 500);
    }
  }

  public function update(Request $request, $id)
  {
    // Validar los datos de entrada
    $validatedData = $request->validate([
      'nombre' => 'required|string|max:255',
      'apellido' => 'required|string|max:255',
      'ci' => 'required|string|max:255',
      'fecha_nac' => 'required|date|max:10',
      'especialidad_id' => 'required|string|max:255',
      'telefono' => 'required|string|max:255',
      'email' => 'required|string|email|max:255' . $id,
      'genero_id' => 'required|exists:generos,id',
      'estado_id' => 'required|exists:estados,id',
      'municipio_id' => 'required|exists:municipios,id',
      'parroquia_id' => 'required|exists:parroquias,id',
      'sector' => 'required|string|max:255',
    ]);

    \DB::transaction(function () use ($validatedData, $id) {
      // Buscar el especialista existente
      $especialista = Especialista::findOrFail($id);

      // Actualizar los datos del especialista
      $especialista->update([
        'nombre' => $validatedData['nombre'],
        'apellido' => $validatedData['apellido'],
        'ci' => $validatedData['ci'],
        'fecha_nac' => $validatedData['fecha_nac'],
        'especialidad_id' => $validatedData['especialidad_id'],
        'telefono' => $validatedData['telefono'],
        'email' => $validatedData['email'],
        'genero_id' => $validatedData['genero_id'],
      ]);

      // Actualizar la dirección si es necesario
      $direccion = Direccion::where('id', $especialista->direccion_id)->first();
      if ($direccion) {
        $direccion->update([
          'estado_id' => $validatedData['estado_id'],
          'municipio_id' => $validatedData['municipio_id'],
          'parroquia_id' => $validatedData['parroquia_id'],
          'sector' => $validatedData['sector'],
        ]);
      }
    });

    return response()->json(['success' => true]);
  }


  public function destroy($id)
  {
    $especialista = Especialista::with('direccion')->find($id);
    if (!$especialista) {
      return response()->json(['message' => 'Especialista no encontrado'], 404);
    }

    $direccion = $especialista->direccion;
    if (!$direccion) {
      return response()->json(['message' => 'Dirección no encontrada'], 404);
    }

    \DB::transaction(function () use ($especialista, $direccion) {
      $especialista->delete();
      $direccion->delete();
    });

    return response()->json(['success' => true]);
  }
}
