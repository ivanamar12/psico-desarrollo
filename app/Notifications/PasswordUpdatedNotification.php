<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PasswordUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database']; // Guardar en la base de datos
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Cambio de Contraseña',
            'message' => "El usuario {$this->user->name} ha cambiado su contraseña.",
            'url' => url('/usuarios'), // Puedes cambiar esto si necesitas una URL específica
        ];
    }
}
