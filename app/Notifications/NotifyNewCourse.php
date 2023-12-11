<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class NotifyNewCourse extends Notification
{
    use Queueable;

    protected $name;
    protected $course;

    public function __construct($name, $course)
    {
        $this->name = $name;
        $this->course = $course;
    }


    public function via($notifiable)
    {
        Log::info('NotifyNewCourse toMail method called.');
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = [
            'current_date' => now()->format('Y-m-d H:i:s'),
            'user_name' => $this->name,
            'course_name' => $this->course,
            'actionUrl' => url('/'),
        ];
        return (new MailMessage)
            ->markdown('mailTemplates.NewCourseBuy', $data);
        // ->line('Please Complete Payment for your course')
        // ->action('Notification Action', url('/'))
        // ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
