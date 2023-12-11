<?php

// MyScheduledTask.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use App\Models\exam;
use Illuminate\Support\Facades\Log;


class MyScheduledTask extends Command
{
    protected $signature = 'mytask:run';
    protected $description = 'Run my scheduled task';

    public function handle()
    {
    // $selectedGrade = Config::get('scheduler.default_grade');
    // $selectedWeek = Config::get('scheduler.default_week');
    // $selectedSection = Config::get('scheduler.default_section');
    // $current = 'week' . $selectedWeek . $selectedSection;

    //     exam::where('user_grade', $selectedGrade)
    //         ->where($current, '#')
    //         ->update([
    //             $current => 'غائب',
    //         ]);
            
        // Logic of your scheduled task
        Log::info('Scheduled task is running...');
    }
}
