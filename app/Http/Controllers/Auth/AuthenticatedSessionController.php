<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LoginService;
use Illuminate\Support\Facades\Cache;

class AuthenticatedSessionController extends Controller
{

  protected $limit = 3; // Número máximo de intentos permitidos
  protected $initCounter = 1; // Contador inicial
  protected $duration = 5; // Duración en minutos del bloqueo en cache

  public function create()
  {
    return view('auth.login');
  }

  public function store(LoginRequest $request)
  {
    $credentials = $request->only('email', 'password');
    $user = LoginService::getUser($credentials);

    if (!$user) {
      return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    // Verificar si el usuario está baneado
    if ($user->isBanned()) {
      return back()->withErrors([
        'email' => 'Su cuenta ha sido bloqueada. Por favor, vaya a la opción de desbloqueo de usuario.',
      ]);
    }

    if (!Auth::attempt($credentials)) {
      $key = LoginService::createKey($user->id);
      $remaining = Cache::get($key);

      if ($remaining == null) {
        Cache::put($key, $this->initCounter, $this->duration * 60);
        $remaining = $this->initCounter;
      } else {
        Cache::increment($key);
        $remaining++;
      }

      $attemptsLeft = $this->limit - $remaining;

      if ($remaining >= $this->limit) {
        $user->ban();
        return back()->withErrors([
          'email' => 'Demasiados intentos fallidos. Su cuenta ha sido bloqueada temporalmente.',
        ]);
      }

      return back()->withErrors([
        'email' => sprintf(
          'Credenciales incorrectas. Intentos restantes: %d. Después de %d intentos fallidos, su cuenta será bloqueada temporalmente.',
          $attemptsLeft,
          $this->limit
        )
      ]);
    }

    // Login exitoso - limpiar intentos y regenerar sesión
    LoginService::clearLoginAttempts($user->id);
    $request->session()->regenerate();

    if ($user->primera_vez) return redirect()->to('/perfil');

    return redirect()->intended(RouteServiceProvider::HOME);
  }

  public function destroy(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
