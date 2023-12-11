<?php
namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyCoursePay extends Notification
{
    use Queueable;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = [
            'current_date' => now()->format('Y-m-d H:i:s'),
            'user_name' => $this->user->name,
            'actionUrl' => url('/'),
        ];
        return (new MailMessage)
            ->markdown('mailTemplates.payLate', $data);
        // ->line('Please Complete Payment for your course')
        // ->action('Notification Action', url('/'))
        // ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
