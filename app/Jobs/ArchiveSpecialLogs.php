<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArchiveSpecialLogs implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        try {
            $data = [
                1 => 'login_log',
                2 => 'register_log',
                3 => 'admin_log',
                4 => 'student_exam_log',
                5 => 'parent_log',
            ];

            foreach ($data as $logType => $destinationTable) {
                $dataToArchive = DB::table('special_logs')
                    ->where('log_type', $logType)
                    ->get(['sender_id', 'sender_name', 'content', 'created_at'])
                    ->map(function ($item) {
                        return (array) $item; // Convert each object to an array
                    })
                    ->toArray();

                DB::connection('logs')->table($destinationTable)->insert($dataToArchive);
            }

            DB::table('special_logs')->delete();

            // Log a message (optional).
            Log::info('Special logs archived and deleted successfully.');

        } catch (\Exception $e) {
            // Log the error message (optional).
            Log::error('Error archiving special logs: ' . $e->getMessage());
        }
    }
}
