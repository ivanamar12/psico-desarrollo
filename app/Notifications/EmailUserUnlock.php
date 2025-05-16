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
      ->subject(__('User Unlock - Dynamic Key'))
      ->greeting(__('Hello :name!', ['name' => $this->user->name]))
      ->line(__('This email contains a dynamic key to unlock your username.'))
      ->line(new HtmlString('<h1>' . __('Dynamic Key: :key', ['key' => $this->key]) . '</h1>'))
      ->line(new HtmlString('<h2>' . __('Important') . ' </h2>'))
      ->line(new HtmlString('<ul>
      <li><strong>' . __('The dynamic key is valid for :time minutes.', ['time' => config('otp.expiry')]) . '</strong></li>
      <li><strong>' . __('If you do not use the dynamic key within the validity time, you must request a new one.') . '</strong></li>
      <li><strong>' . __('Do not share the dynamic key with anyone.') . '</strong></li>
      </ul>'))
      ->line(__('Thank you for using our application!'));
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
