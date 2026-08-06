<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $url = config('app.frontend_url')
            . "/reset-password?token={$this->token}&email={$notifiable->email}";

        return (new MailMessage)
            ->subject('Reset Password')
            ->line('Click the button below to reset your password.')
            ->action('Reset Password', $url)
            ->line('This link will expire in 60 minutes.');
    }
}
