<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Representante;
use App\Models\Especialista;
use App\Models\Secretaria;

class ValidacionController extends Controller
{
  public function verificarEmail(Request $request)
  {
    $email = $request->query('email');

    $existeUsuario = User::where('email', $email)->exists();
    $existeRepresentante = Representante::where('email', $email)->exists();

    return response()->json([
      'exists' => $existeUsuario || $existeRepresentante
    ]);
  }

  public function verificarTelefono(Request $request)
  {
    $telefono = $request->telefono;

    $exists = Especialista::where('telefono', $telefono)->exists() ||
      Representante::where('telefono', $telefono)->exists() ||
      Secretaria::where('telefono', $telefono)->exists();

    return response()->json(['exists' => $exists]);
  }

  public function verificarCedula(Request $request)
  {
    $ci = strtoupper($request->ci);

    $exists = Especialista::where('ci', $ci)->exists() ||
      Representante::where('ci', $ci)->exists() ||
      Secretaria::where('ci', $ci)->exists();

    return response()->json(['exists' => $exists]);
  }
}
