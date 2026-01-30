<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class CustomPasswordResetNotification extends ResetPassword
{
    /**
     * Get the notification's mail representation.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $resetUrl = URL::temporarySignedRoute(
            'password.reset', now()->addMinutes(60), ['token' => $this->token]
        );

        // Render the Blade view with the necessary data
        return (new MailMessage)
            ->subject('Reset Your Password')
            ->markdown('emails.password_reset', [
                'notifiable' => $notifiable,
                'resetUrl' => $resetUrl
            ]);
    }
}
