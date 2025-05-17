<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
  public function showForm(User $user)
  {
    return view('auth.passwords.reset', ['user' => $user]);
  }

  public function update(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required', 'string', Password::default(), 'confirmed'],
    ]);

    $user = User::find($request->user_id);
    $user->update([
      'password' => Hash::make($request->password),
      'primera_vez' => false
    ]);

    return redirect()->route('index')
      ->with('status', 'Contraseña actualizada correctamente.');
  }
}
