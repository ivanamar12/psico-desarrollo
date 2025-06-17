<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CitasDelDiaNotification extends Notification
{
  use Queueable;

  public $citas;

  public function __construct($citas)
  {
    $this->citas = $citas;
  }

  public function via($notifiable)
  {
    return ['database'];
  }

  public function toDatabase($notifiable)
  {
    return [
      'title' => 'Citas del Día',
      'message' => "Hay un total de " . count($this->citas) . " citas programadas para hoy.",
      'url' => url('/citas'),
    ];
  }
}
