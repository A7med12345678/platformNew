<?php
// File: app/Http/Controllers/view/WelcomePageController.php

namespace App\Http\Controllers\view;

use App\Models\dashboardChange;
use App\Http\Controllers\Controller;

class WelcomePageController extends Controller
{
    public function index()
    {
        $view_brief = dashboardChange::where('description', 'dashboard_brief')->pluck('content')->first();
        $view_image = dashboardChange::where('description', 'dashboard_image')->pluck('content')->first();
        $view_video = dashboardChange::where('description', 'dashboard_video_youtube')->pluck('content')->first();
        // dd($view_image, $view_brief , $view_video);
        return view('welcome', compact('view_brief', 'view_image' , 'view_video'));
    }
}