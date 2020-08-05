<?php

namespace WGT\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends ResetPasswordNotification
{
    public $first_name;
    public $token;

    public function __construct($token, $first_name)
    {
        $this->first_name = $first_name;
        $this->token = $token;
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mailLinkPasswordReset = env('MAIL_LINK_PASSWORD_RESET');

        return (new MailMessage)
            ->subject(Lang::get('[WGT] Password Reset'))
            ->greeting("Hi {$this->first_name},")
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action('Reset your password', url($mailLinkPasswordReset . '/auth/recovery?token=' . $this->token))
            ->line(Lang::get('This password reset code will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'))
            ->line(Lang::get('Kind regards,'))
            ->salutation('The WGT Team');
    }
}
