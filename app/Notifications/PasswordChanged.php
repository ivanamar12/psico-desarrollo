<?php

namespace App\Notifications;

use App\Enums\NotificationType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PasswordChanged extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct(public $user) {}

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['database'];
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      'title' => 'Contraseña actualizada',
      'message' => 'Tu contraseña fue cambiada el ' . now()->format('d/m/Y H:i'),
      'type' => NotificationType::SEGURIDAD,
      'action' => [
        'route' => 'perfil.index',
        'params' => []
      ],
    ];
  }
}
