<?php

namespace App\Http\Controllers;

use App\Models\dashboardChange;
use App\Models\timeTable;
use App\Services\SpecialLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class timeTableController extends Controller
{

    public function timeTablePage(Request $request)
    {

        $timeTables = timeTable::get();
        $currentGroups = dashboardChange::where('description', 'currentGroups')->pluck('content');
        // dd($allTableNames);
        return view('admin.timeTable', compact('timeTables' ,'currentGroups'));

    }
    
    public function addToTimeTable(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'for_course' => 'required',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->with(['flash_msg' => 'Validation failed', 'errors' => $validator->errors()]);
            }

            // Check if all day and time fields are null
            if (
                $request->input('lecture_day') === null &&
                $request->input('lecture_time') === null &&
                $request->input('exam_day') === null &&
                $request->input('exam_time') === null
            ) {
                return redirect()->back()->with(['flash_msg' => 'At least one of the day and time fields must be filled.']);
            }
            $for = $request->input('for_course');
            // Create a new TimeTable record
            timeTable::create([
                'sender_id' => Auth::user()->center_code,
                'for_course' => $for,
                'lecture_day' => $request->input('lecture_day'),
                'lecture_time' => $request->input('lecture_time'),
                'lecture_time_end' => $request->input('lecture_time_end'),
                'exam_day' => $request->input('exam_day'),
                'exam_time' => $request->input('exam_time'),
                'exam_time_end' => $request->input('exam_time_end'),
            ]);
            SpecialLogService::createLog('3', "time table to : " . $for);

            return redirect()->back()->with(['flash_msg' => 'Record added successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['flash_msg' => 'n error occurred while adding the record : ' . $e->getMessage()]);
        }
    }

    public function deleteTimeTable($id)
    {
        try {
            // Find the instruction by its ID
            $instruction = timeTable::findOrFail($id);

            // Delete the instruction
            $instruction->delete();
            SpecialLogService::createLog('3', "time table delete : " . $instruction->for_course);

            return redirect()->back()->with('flash_msg', 'Time Table created Successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while deleting the Time Table  : ' . $e->getMessage());
        }
    }
}
