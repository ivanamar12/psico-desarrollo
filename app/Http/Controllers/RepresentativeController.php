<?php

namespace App\Http\Controllers;

use App\Http\Requests\Representante\StoreRepresentanteRequest;
use App\Models\Representante;
use App\Models\Direccion;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RepresentativeController extends Controller
{

  public function index(Request $request)
  {
    if ($request->ajax()) {
      $representantes = Representante::all();

      return DataTables::of($representantes)
        ->addColumn('action', function ($representante) {
          $acciones = '<a href="javascript:void(0)" onclick="editRepresentante(' . $representante->id . ')" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a>';
          $acciones .= '<button type="button" name="delete" id="' . $representante->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';
          $acciones .= '<button type="button" class="btn btn-info btn-raised btn-xs ver-representante" data-id="' . $representante->id . '"><i class="zmdi zmdi-eye"></i></button>';
          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('representantes.index', [
      'representantes' => Representante::all(),
      'generos' => Genero::all(),
      'estados' => Estado::all(),
      'municipios' => Municipio::all(),
      'parroquias' => Parroquia::all()
    ]);
  }

  public function store(StoreRepresentanteRequest $request)
  {
    $validatedData = $request->validated();

    \DB::transaction(function () use ($validatedData) {
      $direccion = Direccion::create([
        'estado_id' => $validatedData['estado_id'],
        'municipio_id' => $validatedData['municipio_id'],
        'parroquia_id' => $validatedData['parroquia_id'],
        'sector' => $validatedData['sector'],
      ]);

      Representante::create([
        'nombre' => $validatedData['nombre'],
        'apellido' => $validatedData['apellido'],
        'ci' => $validatedData['ci'],
        'telefono' => $validatedData['telefono'],
        'email' => $validatedData['email'],
        'genero_id' => $validatedData['genero_id'],
        'direccion_id' => $direccion->id,
      ]);
    });

    return response()->json(['success' => true]);
  }

  public function show($id)
  {
    $representante = Representante::obtenerRepresentante($id);

    if (!$representante) {
      return response()->json(['error' => 'Representante no encontrado'], 404);
    }

    return response()->json($representante);
  }

  public function edit($id)
  {
    try {
      $representante = Representante::with('direccion')->find($id);
      if (!$representante) {
        return response()->json(['error' => 'representante no encontrado'], 404);
      }
      return response()->json($representante);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Error interno del servidor: ' . $e->getMessage()], 500);
    }
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'nombre' => 'required|string|max:255',
      'apellido' => 'required|string|max:255',
      'ci' => 'required|string|max:255',
      'telefono' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'genero_id' => 'required|exists:generos,id',
      'estado_id' => 'required|exists:estados,id',
      'municipio_id' => 'required|exists:municipios,id',
      'parroquia_id' => 'required|exists:parroquias,id',
      'sector' => 'required|string|max:255',
    ]);

    $representante = Representante::with('direccion')->find($id);
    if (!$representante) {
      return response()->json(['message' => 'Especialista no encontrado'], 404);
    }

    \DB::transaction(function () use ($validatedData, $representante) {
      $direccion = $representante->direccion;
      if (!$direccion) {
        throw new \Exception('Dirección no encontrada');
      }

      $direccion->update([
        'estado_id' => $validatedData['estado_id'],
        'municipio_id' => $validatedData['municipio_id'],
        'parroquia_id' => $validatedData['parroquia_id'],
        'sector' => $validatedData['sector'],
      ]);

      $representante->update([
        'nombre' => $validatedData['nombre'],
        'apellido' => $validatedData['apellido'],
        'ci' => $validatedData['ci'],
        'telefono' => $validatedData['telefono'],
        'email' => $validatedData['email'],
        'genero_id' => $validatedData['genero_id'],
      ]);
    });

    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $representante = Representante::with('direccion')->find($id);
    if (!$representante) {
      return response()->json(['message' => 'representante no encontrado'], 404);
    }

    $direccion = $representante->direccion;
    if (!$direccion) {
      return response()->json(['message' => 'Dirección no encontrada'], 404);
    }

    \DB::transaction(function () use ($representante, $direccion) {
      $representante->delete();
      $direccion->delete();
    });

    return response()->json(['success' => true]);
  }
}
