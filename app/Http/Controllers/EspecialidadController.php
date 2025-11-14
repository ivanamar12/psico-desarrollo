<?php

namespace App\Http\Controllers;

use App\Http\Requests\Especialidad\StoreEspecialidadRequest;
use App\Http\Requests\Especialidad\UpdateEspecialidadRequest;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EspecialidadController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $especialidades = Especialidad::all();

      return DataTables::of($especialidades)
        ->addColumn('action', function ($especialidad) {
          $acciones = '';

          if (auth()->user()->can('editar especialidad')) {
            $acciones .= '<a href="javascript:void(0)" onclick="editEspecialidad(' . $especialidad->id . ')" class="btn btn-warning btn-raised btn-xs"><i class="zmdi zmdi-edit"></i></a>';
          }

          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('especialidad.index');
  }

  public function store(StoreEspecialidadRequest $request)
  {
    Especialidad::create($request->safe()->all());

    return response()->json([
      'success' => true,
      'message' => 'Especialidad registrada con éxito!'
    ]);
  }

  public function edit(Especialidad $especialidad)
  {
    return response()->json($especialidad);
  }

  public function update(UpdateEspecialidadRequest $request, Especialidad $especialidad)
  {
    $especialidad->update($request->safe()->all());

    return response()->json([
      'success' => true,
      'message' => 'Especialidad actualizada correctamente!'
    ]);
  }
}
