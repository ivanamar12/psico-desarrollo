<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EspecialidadController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $especialidades = Especialidad::select('*');

      return DataTables::of($especialidades)
        ->addColumn('action', function ($especialidad) {
          $acciones = '';

          if (auth()->user()->can('editar especialidad')) {
            $acciones .= '<a href="javascript:void(0)" onclick="editEspecialidad(' . $especialidad->id . ')" class="btn btn-warning btn-sm"><i class="zmdi zmdi-edit"></i></a>';
          }

          return $acciones;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('especialidad.index');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'especialidad' => 'required|string|max:30|unique:especialidads',
    ]);

    Especialidad::create([
      'especialidad' => $validatedData['especialidad'],
    ]);

    return response()->json(['success' => true, 'message' => 'Especialidad registrada con éxito']);
  }

  public function edit($id)
  {
    $especialidad = Especialidad::findOrFail($id);
    return response()->json($especialidad);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'especialidad' => 'required|string|max:30|unique:especialidads,especialidad,' . $id
    ]);

    $especialidad = Especialidad::findOrFail($id);
    $especialidad->update($request->all());

    return response()->json([
      'success' => true,
      'message' => 'Especialidad actualizada correctamente'
    ]);
  }
}
