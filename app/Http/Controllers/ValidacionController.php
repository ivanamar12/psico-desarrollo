<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Representante;

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
}
