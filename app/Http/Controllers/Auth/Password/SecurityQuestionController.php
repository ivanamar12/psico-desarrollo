<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecurityQuestionController extends Controller
{
  public function show(Request $request)
  {
    $user = User::where('email', $request->email)->first();
    return view('auth.passwords.security-question', ['user' => $user]);
  }

  public function verify(Request $request)
  {
    $user = User::where('email', $request->email)->first();

    if (!Hash::check($request->respuesta_seguridad, $user->respuesta_seguridad)) {
      return back()->withErrors(['respuesta_seguridad' => 'La respuesta es incorrecta']);
    }

    return redirect()->route('password.reset', $user);
  }
}
