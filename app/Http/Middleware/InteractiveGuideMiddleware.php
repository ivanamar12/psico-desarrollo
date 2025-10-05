<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class InteractiveGuideMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    if (Auth::check()) {
      $user = Auth::user();

      $currentView = $request->route()->getName();
      $completedGuides = $user->interactive_help;

      if (is_string($completedGuides)) {
        $completedGuides = json_decode($completedGuides, true);
      }

      if (!is_array($completedGuides)) {
        $completedGuides = [];
      }

      if (!in_array($currentView, $completedGuides)) {
        session(['show_guide' => true]);

        $completedGuides[] = $currentView;
        $user->interactive_help = $completedGuides;
        $user->save();
      } else {
        session(['show_guide' => false]);
      }
    }

    return $next($request);
  }
}
