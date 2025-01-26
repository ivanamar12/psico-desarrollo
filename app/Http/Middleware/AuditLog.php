<?php

namespace App\Http\Middleware;

use App\Models\AuditLog as ModelsAuditLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuditLog
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $response = $next($request);
    $route = Route::currentRouteName();
    $description = $this->descriptions[$route] ?? null;

    if (!$description || !Auth::user()) {
      return $response;
    }

    ModelsAuditLog::create([
      'user_id' => Auth::user()->id,
      'action' => $description,
    ]);

    return $response;
  }

  protected $descriptions = [
    'index' => 'Ver Página Principal',
    'dashboard' =>  'Ver Panel de Control',
  ];
}
