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
    $request->validate(['email' => ['required', 'email']]);

    $user = User::where('email', $request->email)->first();

    if (!Hash::check($request->security_answer, $user->security_answer)) {
      return back()->withErrors(['security_answer' => 'La respuesta es incorrecta.']);
    }

    return redirect()->route('password.reset', $user);
  }
}
