<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
  public function getNotifications()
  {
    if (!auth()->check()) return response()->json(['message' => 'Unauthenticated.'], 401);

    return response()->json(['notifications' => auth()->user()->notifications->map(fn($notification) => [
      ...$notification->toArray(),
      'created_at' => $notification->created_at->diffForHumans(),
    ])]);
  }

  public function markAsReadAndRedirect($id)
  {
    $notification = Auth::user()->notifications()->findOrFail($id);
    $notification->markAsRead();

    $data = $notification->data;

    if (isset($data['action']['route'])) {
      return redirect()->route(
        $data['action']['route'],
        $data['action']['params'] ?? []
      );
    }

    return redirect()->back();
  }
}
