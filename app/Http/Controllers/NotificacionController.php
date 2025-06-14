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

  // 2. Marcar una notificación como leída
  public function markAsRead($id)
  {
    $notification = Auth::user()->notifications()->where('id', $id)->first();
    if ($notification) {
      $notification->markAsRead();
    }
    return response()->json(['success' => true]);
  }

  // 3. Marcar todas las notificaciones como leídas
  public function markAllAsRead()
  {
    Auth::user()->unreadNotifications->markAsRead();
    return response()->json(['success' => true]);
  }

  // 4. Eliminar una notificación
  public function deleteNotification($id)
  {
    $notification = Auth::user()->notifications()->where('id', $id)->first();
    if ($notification) {
      $notification->delete();
    }
    return response()->json(['success' => true]);
  }
}
