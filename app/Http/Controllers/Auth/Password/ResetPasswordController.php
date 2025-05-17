<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
  public function showForm($token)
  {
    $resetData = DB::table('password_resets')
      ->where('token', $token)
      ->first();

    if (!$resetData || now()->subMinutes(60) > $resetData->created_at) {
      return redirect()->route('password.request')
        ->withErrors(['token' => 'Token inválido o expirado.']);
    }

    $user = User::where('email', $resetData->email)->first();

    return view('auth.passwords.reset', [
      'user' => $user,
      'token' => $token
    ]);
  }

  public function update(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email'],
      'token' => ['required'],
      'password' => ['required', 'string', Password::default(), 'confirmed'],
    ]);

    // Verifica el token nuevamente
    $resetData = DB::table('password_resets')
      ->where('token', $request->token)
      ->first();

    if (!$resetData) {
      return back()->withErrors(['token' => 'Token inválido.']);
    }

    $user = User::where('email', $resetData->email)->first();

    $user->update([
      'password' => Hash::make($request->password),
      'primera_vez' => false
    ]);

    DB::table('password_resets')->where('email', $user->email)->delete();

    return redirect()->route('index')
      ->with('status', 'Contraseña actualizada correctamente.');
  }
}
