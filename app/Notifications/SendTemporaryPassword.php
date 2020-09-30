<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendTemporaryPassword extends Notification
{
    use Queueable;

    public $tmpPassword;

    /**
     * Create a new notification instance.
     *
     * @param $tmpPassword
     */
    public function __construct($tmpPassword)
    {
        $this->tmpPassword = $tmpPassword;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Welcome to fakebank')
                    ->greeting('Welcome to fakebank')
                    ->line('Another user of fakebank has created you a new account.')
                    ->line('You will need to verify your account through another email.')
                    ->line('Knowing that, here is a temporary password for you to use to login.')
                    ->line('Password: '. $this->tmpPassword)
                    ->action('Go to fakebank', route('admin.home'))
                    ->line('Please remember to reset the password shortly after first use.');
    }

}
