<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'especialidad' => 'required|string|max:30|unique:especialidads', // Asegúrate de que el nombre de la tabla sea correcto
    ]);

    Especialidad::create([
      'especialidad' => $validatedData['especialidad'],
    ]);

    return response()->json(['success' => true, 'message' => 'Especialidad registrada con éxito']);
  }
}
