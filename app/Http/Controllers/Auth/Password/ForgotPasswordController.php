<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    // Generar token
    $token = Str::random(60);
    DB::table('password_resets')->updateOrInsert(
      ['email' => $user->email],
      ['token' => $token, 'created_at' => now()]
    );

    return redirect()->route('security.question', [
      'email' => $request->email,
      'token' => $token
    ]);
  }
}
