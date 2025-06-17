<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class EmailUserUnlock extends Notification
{
  use Queueable;

  public $user;
  public $key;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($user, $key)
  {
    $this->user = $user;
    $this->key = $key;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->subject(__('notifications.user_unlock.subject'))
      ->greeting(__('notifications.user_unlock.greeting', ['name' => $this->user->name]))
      ->line(__('notifications.user_unlock.message'))
      ->line(new HtmlString('<h1>' . __('notifications.user_unlock.key_label', ['key' => $this->key]) . '</h1>'))
      ->line(new HtmlString('<h2>' . __('notifications.user_unlock.important') . '</h2>'))
      ->line(new HtmlString('<ul>
        <li><strong>' . __('notifications.user_unlock.validity', ['time' => config('otp.expiry')]) . '</strong></li>
        <li><strong>' . __('notifications.user_unlock.warning_time') . '</strong></li>
        <li><strong>' . __('notifications.user_unlock.warning_share') . '</strong></li>
      </ul>'))
      ->line(__('notifications.user_unlock.thanks'));
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
      //
    ];
  }
}
