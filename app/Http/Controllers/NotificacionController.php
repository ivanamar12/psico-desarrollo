<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    // 1. Obtener notificaciones no leídas
    public function getNotifications()
    {
        return response()->json([
            'notifications' => Auth::user()->unreadNotifications
        ]);
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

