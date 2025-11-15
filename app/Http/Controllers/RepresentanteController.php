<?php

namespace App\Http\Controllers;

use App\Http\Requests\Representante\StoreRepresentanteRequest;
use App\Http\Requests\Representante\UpdateRepresentanteRequest;
use App\Models\Representante;
use App\Models\Direccion;
use App\Models\Genero;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RepresentanteController extends Controller
{
  public function index(Request $request)
  {
    $representantes = Representante::all();
    if ($request->ajax()) {
      return DataTables::of($representantes)
        ->addColumn('action', function ($representante) {
          $acciones = '';

          $acciones .= '<button type="button" class="btn btn-info btn-raised btn-xs ver-representante" data-id="' . $representante->id . '"><i class="zmdi zmdi-eye"></i></button>';

          if (auth()->user()->can('editar representante')) {
            $acciones .= '<a href="javascript:void(0)" onclick="editRepresentante(' . $representante->id . ')" class="btn btn-warning btn-raised btn-xs"><i class="zmdi zmdi-edit"></i></a>';
          }

          // $acciones .= '<button type="button" name="delete" id="' . $representante->id . '" class="delete btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></button>';

          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('representantes.index', [
      'representantes' => $representantes,
      'generos' => Genero::all(),
      'estados' => Estado::all(),
      'municipios' => Municipio::all(),
      'parroquias' => Parroquia::all()
    ]);
  }

  public function store(StoreRepresentanteRequest $request)
  {
    DB::transaction(function () use ($request) {
      $direccion = Direccion::create($request->safe()->only([
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'sector',
      ]));

      Representante::create($request->safe()
        ->merge([
          'direccion_id' => $direccion->id,
        ])->only([
          'nombre',
          'apellido',
          'ci',
          'telefono',
          'email',
          'genero_id',
          'direccion_id',
        ]));
    });

    return response()->json([
      'success' => true,
      'message' => 'Representante registrado con éxito!'
    ]);
  }

  public function show(Representante $representante)
  {
    $representante->load([
      'genero',
      'direccion.estado',
      'direccion.municipio',
      'direccion.parroquia'
    ]);

    return response()->json($representante);
  }

  public function edit(Representante $representante)
  {
    $representante->load('direccion');

    return response()->json($representante);
  }

  public function update(UpdateRepresentanteRequest $request, Representante $representante)
  {
    DB::transaction(function () use ($request, $representante) {
      $representante->update($request->safe()->only([
        'ci',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'genero_id',
      ]));

      $representante->direccion()->update($request->safe()->only([
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'sector',
      ]));
    });

    return response()->json([
      'success' => true,
      'message' => 'Representante actualizado correctamente!'
    ]);
  }
}
