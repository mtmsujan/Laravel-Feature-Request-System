<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerificationCodeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $appName = config('app.name');
        return (new MailMessage)
        ->subject("Verification Code[{$this->user->verification_code}] - {$appName} Roadmap")
        ->markdown('notifications::verify', ['user'=> $this->user, 'code'=> $this->user->verification_code])
        ->greeting("Dear {$this->user->name} ,")
        ->action("We received a request to access your {$appName} Account {$this->user->email} through your email address. Your {$appName} verification code is:", $this->user->verification_code)
        ->line("If you did not request this code, you can ignore this message. **But Do not forward or give this code to anyone.**")
        ->line('The verification code will expire in 5 minutes');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
