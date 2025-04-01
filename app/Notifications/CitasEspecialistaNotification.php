<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CitasEspecialistaNotification extends Notification
{
    use Queueable;

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
            'title' => 'Tus Citas del Día',
            'message' => "Tienes " . count($this->citas) . " citas agendadas para hoy.",
            'url' => url('/mis-citas'),
        ];
    }
}
