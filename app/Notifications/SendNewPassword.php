<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendNewPassword extends Notification
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
            ->subject('Password Reset')
            ->greeting('We\'re here to help!')
            ->line('A password reset was initiated for your account.')
            ->line('Here is a temporary password for you to use to login.')
            ->line('Password: '. $this->tmpPassword)
            ->action('Go to fakebank', route('admin.home'))
            ->line('Please remember to reset the password shortly after first use.');
    }
}
