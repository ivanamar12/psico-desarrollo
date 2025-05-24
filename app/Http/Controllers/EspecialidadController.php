<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
  public function index()
  {
    $especialidades = Especialidad::all();
    return view('especialidad.index', compact('especialidades'));
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
    return view('especialidad.edit', compact('especialidad'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'especialidad' => 'required|string|max:30|unique:especialidads,especialidad,' . $id
    ]);

    $especialidad = Especialidad::findOrFail($id);
    $especialidad->update($request->all());

    return redirect()->route('especialidad.index')
      ->with('success', 'Especialidad actualizada correctamente');
  }
}
