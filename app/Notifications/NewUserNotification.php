<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\user;

class NewUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail']; // Change 'database' back to 'mail'
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toDatabase(object $notifiable): array // Change the typehint to toDatabase
    // {
    //     return [
    //         'message' => 'The introduction to the notification.',
    //         'action' => 'Notification Action',
    //         'url' => url('/'),
    //     ];
    // }

    public function toMail(object $notifiable): MailMessage
    {

        $data = [
            'current_date' => now()->format('Y-m-d H:i:s'),
            'user_name' => $this->user->name,
            'actionUrl' => url('/'),
        ];

        return (new MailMessage)
            ->markdown('mailTemplates.newRegister', $data);
    }
}