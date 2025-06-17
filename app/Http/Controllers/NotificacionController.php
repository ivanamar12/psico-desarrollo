<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificacionController extends Controller
{
  public function index(): View
  {
    return view('notificaciones.index');
  }

  public function getNotifications()
  {
    if (!auth()->check()) return response()->json(['message' => 'Unauthenticated.'], 401);

    return response()->json([
      'notifications' => auth()->user()->notifications->map(function ($notification) {
        return [
          ...$notification->toArray(),
          'created_at' => $notification->created_at->diffForHumans(),
          'read_at' => $notification->read_at ? $notification->read_at->diffForHumans() : null,
        ];
      }),
      'unread_count' => auth()->user()->unreadNotifications->count()
    ]);
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

  public function markAllAsRead()
  {
    Auth::user()->unreadNotifications->markAsRead();

    return response()->json([
      'success' => true,
      'message' => 'Todas las notificaciones marcadas como leídas'
    ]);
  }

  public function destroy($id)
  {
    $notification = Auth::user()->notifications()->findOrFail($id);
    $notification->delete();

    return response()->json([
      'success' => true,
      'message' => 'Notificación eliminada correctamente'
    ]);
  }
}
