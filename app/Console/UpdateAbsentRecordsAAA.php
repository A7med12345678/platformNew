<?php
// app/Console/submitExam.php

namespace App\Console;
use Illuminate\Console\Command;
use App\Models\exam;
use Illuminate\Support\Facades\Config;

class UpdateAbsentRecords extends Command
{
    protected $signature = 'records:update';

    protected $description = 'Update absent records based on selected grade and section';

    public function handle()
    {
        $selectedGrade = Config::get('scheduler.default_grade');
        $selectedWeek = Config::get('scheduler.default_week');
        $selectedSection = Config::get('scheduler.default_section');
        $current = 'week' . $selectedWeek . $selectedSection;

        try {
            exam::where('user_grade', $selectedGrade)
                ->where($current, '#')
                ->update([
                    $current => 'غائب',
                ]);

            $this->info('Records updated successfully.');
        } catch (\Exception $e) {
            $this->error('Failed to update records: ' . $e->getMessage());
        }
    }
}
