<?php

namespace App\Http\Controllers\view\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WeekContentController extends Controller
{
    public function index()
    {
        $grades = ['3', '2', '1'];
        $user_grade = Auth::user()->grade;
        $user_start_from = Auth::user()->start_from;

        $weekContent = [];

        if (Auth::check() && Auth::user()->force_stop === '0') {
            foreach ($grades as $grade) {
                for ($week = 45; $week >= $user_start_from; $week--) {
                    for ($section = 1; $section <= 3; $section++) {
                        $videoName = "week{$week}sec{$section}.mp4";
                        $videoName2 = "week{$week}sec{$section}.mkv";
                        $videoPath = asset('mrchemistry/storage/app/public/videos/' . $user_grade . '/' . $videoName);
                        $videoPath2 = asset('mrchemistry/storage/app/public/videos/' . $user_grade . '/' . $videoName2);
                        $videoExists = Storage::exists('public/videos/' . $user_grade . '/' . $videoName);
                        $videoExists2 = Storage::exists('public/videos/' . $user_grade . '/' . $videoName2);

                        $weekContent[] = [
                            'week' => $week,
                            'section' => $section,
                            'videoPath' => $videoPath,
                            'videoPath2' => $videoPath2,
                            'videoExists' => $videoExists,
                            'videoExists2' => $videoExists2,
                        ];
                    }
                }
            }
        }

        return view('students.currentWeek', ['weekContent' => $weekContent]);
    }
    
  
    
    
    
    
}
