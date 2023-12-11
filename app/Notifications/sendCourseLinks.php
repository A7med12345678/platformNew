<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendCourseLinks extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $links;
    protected $userName;
    
    public function __construct($links, $userName)
    {
        $this->links = $links;
        $this->userName = $userName;
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
        $data = [
            'current_date' => now()->format('Y-m-d H:i:s'),
            'user_name' => $this->userName,
            'links' => $this->links,
            'actionUrl' => url('/'),
        ];        
        return (new MailMessage)
            ->markdown('mailTemplates.deliverCourseRequest', $data);
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
