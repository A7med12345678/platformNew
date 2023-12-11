<?php

namespace App\Providers;

use App\Models\dashboardChange;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            // Student Conf. :
            View::share('Global_unitNum', 90);
            View::share('Global_unitName', 'الدرس');
            View::share('Global_unitName_Download', 'PDFتحميل ');
            View::share('Global_videoError', 'لم يتم رفع فيديو الدرس بعد');

            View::share('Global_programmerName', 'Ahmed Khaled El-Dakhly');
            View::share('Global_programmerPhone', '+201142333048');
            
            View::share('Global_programmerWhatsApp', 'https://api.whatsapp.com/send?phone=201142333048');
            View::share('Global_programmeFaceBook', 'https://api.whatsapp.com/send?phone=201142333048');
            View::share('Global_programmerMail', 'https://api.whatsapp.com/send?phone=201142333048');

            View::share('Global_currentURL', 'http://127.0.0.1:8000');
            View::share('Global_platFormSite', 'https://englishforall.tech/');



            // Global Conf. :
            $Global_teacherYoutube = dashboardChange::where('description', 'teacherYoutube')->pluck('content')->first();
            View::share('Global_teacherYoutube', $Global_teacherYoutube);


            $Global_dashboard_video_youtube = dashboardChange::where('description', 'dashboard_video_youtube')->pluck('content')->first();
            View::share('Global_dashboard_video_youtube', $Global_dashboard_video_youtube);

            $Global_currentYear = dashboardChange::where('description', 'currentYear')->pluck('content')->first();
            View::share('Global_currentYear', $Global_currentYear);
            $Global_platFormDescription = dashboardChange::where('description', 'platFormDescription')->pluck('content')->first();
            View::share('Global_platFormDescription', $Global_platFormDescription);
            $Global_platFormName = dashboardChange::where('description', 'platFormName')->pluck('content')->first();
            View::share('Global_platFormName', $Global_platFormName);
            $Global_teacherName = dashboardChange::where('description', 'teacherName')->pluck('content')->first();
            View::share('Global_teacherName', $Global_teacherName);
            $Global_teacherPhone = dashboardChange::where('description', 'teacherPhone')->pluck('content')->first();
            View::share('Global_teacherPhone', $Global_teacherPhone);
            $Global_teacherWhatsApp = dashboardChange::where('description', 'teacherWhatsApp')->pluck('content')->first();
            View::share('Global_teacherWhatsApp', 'https://api.whatsapp.com/send?phone=' . $Global_teacherWhatsApp);
            $Global_teacherFaceBook = dashboardChange::where('description', 'teacherFaceBook')->pluck('content')->first();
            View::share('Global_teacherFaceBook', $Global_teacherFaceBook);

            // View::share('globalVar', 'This is a global variable');
            // View::composer(['view1', 'view2'], function ($view) {
            //     $view->with('globalVar', 'This is a global variable');
            // });
        }

    }
}