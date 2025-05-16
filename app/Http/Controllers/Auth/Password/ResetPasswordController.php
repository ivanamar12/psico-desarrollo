<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
  public function showForm(User $user)
  {
    return view('auth.passwords.reset', ['user' => $user]);
  }

  public function update(Request $request)
  {
    $request->validate([
      'password' => 'required|confirmed|min:8',
    ]);

    $user = User::find($request->user_id);
    $user->update([
      'password' => Hash::make($request->password),
      'primera_vez' => false
    ]);

    return redirect()->route('login')->with('status', 'Contraseña actualizada correctamente');
  }
}
