<?php

namespace App\Providers;

use App\Models\exam;
use App\Models\homework;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
          // Add event listener for the Registered event
          Event::listen(Registered::class, function (Registered $event) {
            $user = $event->user;
            $addStuentExam = new exam();
            $addStuentExam->user_id = $user->center_code;
            $addStuentExam->user_grade = $user->grade;
            $addStuentExam->user_name = $user->name;
            $addStuentExam->save();
            
            // $user_pass = $event->user_password;
            // $addStuentExam = new exam();


            $user = $event->user;
            $addStuentExam = new homework();
            $addStuentExam->user_id = $user->center_code;
            $addStuentExam->user_grade = $user->grade;
            $addStuentExam->user_name = $user->name;
            $addStuentExam->save();


            
        });
        
        Event::listen(Deleting::class, function (Deleting $event) {
            $user = $event->user;
            
            // Delete exam records associated with the user
            exam::where('user_id', $user->center_code)->delete();
            
            // Delete exam records associated with the user
            homework::where('user_id', $user->center_code)->delete();
            
        });

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
