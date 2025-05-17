<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
  public function showForm()
  {
    return view('auth.passwords.email');
  }

  public function checkEmail(Request $request)
  {
    $request->validate(['email' => ['required', 'email']]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
      return back()
        ->withErrors(['email' => 'Usuario no encontrado.']);
    }

    if (!$user->security_question_id) {
      return back()
        ->withErrors(['email' => 'Usuario no tiene pregunta de seguridad configurada.']);
    }

    return redirect()->route('security.question', ['email' => $request->email]);
  }
}
