<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SecurityQuestionController extends Controller
{
  public function show(Request $request)
  {
    $user = User::where('email', $request->email)->first();
    return view('auth.passwords.security-question', [
      'user' => $user,
      'token' => $request->token
    ]);
  }

  public function verify(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email'],
      'token' => ['required'],
      'security_answer' => ['required']
    ]);

    $user = User::where('email', $request->email)->first();

    // Verifica el token
    $resetData = DB::table('password_resets')
      ->where('email', $user->email)
      ->where('token', $request->token)
      ->first();

    if (!$resetData || now()->subMinutes(60) > $resetData->created_at) {
      return back()
        ->withErrors(['token' => 'Token inválido o expirado.']);
    }

    if (!Hash::check($request->security_answer, $user->security_answer)) {
      return back()
        ->withErrors(['security_answer' => 'La respuesta es incorrecta.']);
    }

    // Genera nuevo token para el último paso
    $finalToken = Str::random(60);
    DB::table('password_resets')->updateOrInsert(
      ['email' => $user->email],
      ['token' => $finalToken, 'created_at' => now()]
    );

    return redirect()->route('password.reset', ['token' => $finalToken]);
  }
}
