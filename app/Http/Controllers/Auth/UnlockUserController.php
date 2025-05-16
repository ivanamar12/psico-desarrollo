<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use Tzsk\Otp\Facades\Otp;

class UnlockUserController extends Controller
{
  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('auth.user-unlock');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function sendEmail(Request $request)
  {
    $request->validate(['email' => ['required', 'email']]);
    $user = AuthService::getUser($request->email);

    if (!$user) {
      return redirect()->route('user-unlock.request')->withErrors(['status' => 'Email no encontrado']);
    }

    $otp = Otp::generate($user->email);

    // Notification::send($user, new EmailUserUnlock($user, $otp));

    return redirect()->route('unlock-user.reset', ['email' => $user->email])
      ->with(['status' => __('Link to reset user sent!')]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function update(Request $request): View
  {
    return view('auth.enter-key');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'key' => ['required'],
      'email' => ['required', 'email'],
    ]);

    $valid = Otp::match($request->key, $request->email);

    if (!$valid) {
      return redirect()->route('user-unlock.request')
        ->with('status', 'Lo sentimos, la clave que ha introducido es incorrecta o ha expirado. Por favor, solicite una nueva clave.');
    }

    $user = AuthService::getUser($request->email);
    $user->unban();

    return redirect()->route('login')->with('status', 'Usuario Desbloqueado!');
  }
}
