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
    if (!$request->has('email') || !$request->has('token')) {
      return redirect()->route('password.request')
        ->withErrors(['error' => 'Acceso no autorizado. Por favor inicie el proceso desde el principio.']);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user) {
      return redirect()->route('password.request')
        ->withErrors(['email' => 'Usuario no encontrado.']);
    }

    $resetData = DB::table('password_resets')
      ->where('email', $user->email)
      ->where('token', $request->token)
      ->first();

    if (!$resetData || now()->subMinutes(60) > $resetData->created_at) {
      return redirect()->route('password.request')
        ->withErrors(['token' => 'Token inválido o expirado. Por favor inicie el proceso nuevamente.']);
    }

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

    $resetData = DB::table('password_resets')
      ->where('email', $user->email)
      ->where('token', $request->token)
      ->first();

    if (!$resetData || now()->subMinutes(60) > $resetData->created_at) {
      return back()
        ->withErrors(['token' => 'Token inválido o expirado.']);
    }

    if (!Hash::check($request->security_answer, $user->security_answer)) {
      if ($request->session()->get('security_attempts', 0) >= 3) {
        DB::table('password_resets')->where('email', $user->email)->delete();
        return redirect()->route('password.request')
          ->withErrors(['security_answer' => 'Demasiados intentos fallidos. Por favor inicie el proceso nuevamente.']);
      }

      $request->session()->put(
        'security_attempts',
        $request->session()->get('security_attempts', 0) + 1
      );

      return back()->withErrors(['security_answer' => 'La respuesta es incorrecta.']);
    }

    $request->session()->forget('security_attempts');

    $finalToken = Str::random(60);
    DB::table('password_resets')->updateOrInsert(
      ['email' => $user->email],
      ['token' => $finalToken, 'created_at' => now()]
    );

    return redirect()->route('password.reset', ['token' => $finalToken]);
  }
}
