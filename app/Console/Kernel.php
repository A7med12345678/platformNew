<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\exam;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    private $executed = false;

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $numQuestions = 1;
        $schedule->command('mytask:run')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    
        // Register your custom commands here
        // $this->commands([
        //     \App\Console\Commands\ClearAllCommand::class,
        // ]);
    }
    


}
