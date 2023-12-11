<?php

namespace App\Http\Controllers;

use App\Jobs\ArchiveSpecialLogs;
use App\Models\specialLog;
use App\Services\SpecialLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class resetTablesController extends Controller
{
    public function resetTablesPage(Request $request)
    {

        $allTableNamesWithnoNeed = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        // Define an array of tables to exclude
        $excludedTables = ['selected_divs', 'users', 'honer_students', 'migrations', 'failed_jobs', 'password_resets', 'personal_access_tokens', 'notifications', 'sessions', 'special_logs'];

        // Filter out the excluded tables
        $filteredTableNames = array_diff($allTableNamesWithnoNeed, $excludedTables);


        $allTableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        // dd($allTableNames);
        return view('admin.resetTables', compact('filteredTableNames'));

    }
    public function actionTables(Request $request)
    {
        try {
            $tableName = $request->input('table_name');
            $type = $request->input('type');
            // dd($tableName);
            if ($type === "clear") {
                DB::table($tableName)->truncate();
                $content = "clear table : " . $tableName;
            } elseif ($type === "delete") {
                DB::table($tableName)->delete();
                $content = "delete table : " . $tableName;
            }

            SpecialLogService::createLog('3', $content);

            return redirect()->back()->with('flash_msg', 'Table Cleared Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function archiveSpecialLogs()
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
                    ->toArray(); // Convert the collection of arrays to a plain array
                // dd($dataToArchive);
                DB::connection('logs')->table($destinationTable)->insert($dataToArchive);
            }

            DB::table('special_logs')->delete();
            SpecialLogService::createLog('3', "Archieved Successfully");
            return redirect()->back()->with('flash_msg', 'Tables Archived and Special Logs Deleted Successfully!');
        } catch (\Exception $e) {
            $errorMessage = 'Error: ' . $e->getMessage();
            return redirect()->back()->with('flash_msg', $errorMessage);
        }
    }



}
