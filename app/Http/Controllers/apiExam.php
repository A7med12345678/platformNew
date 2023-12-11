<?php

namespace App\Http\Controllers;

use App\Models\specialLog;
use App\Services\SpecialLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class apiExam extends Controller
{
    public function storeExam(Request $request)
    {
        $selectedWeek = $request->input('selected_week');
        // $selectedWeek = 'week' . $request->input('selected_week') . 'sec4';
        // dd($selectedWeek);
        $numQuestions = $request->input('numQuestions');
        $grade = $request->input('grade');
        $minutes = $request->input('minutes');


        $apiFilePath = storage_path('api' . '/' . $grade . '/examAnswersApi.json');
        $apiData = json_decode(file_get_contents($apiFilePath), true);

        $apiData[$selectedWeek] = [
            'num' => $numQuestions,
            'time' => $minutes,
        ];

        $finalMark = 0;

        for ($i = 1; $i <= $numQuestions; $i++) {
            $questionValue = $request->input($i);
            $apiData[$selectedWeek][(string) $i] = $questionValue;

            if ($questionValue === 'a' || $questionValue === 'b' || $questionValue === 'c' || $questionValue === 'd') {
                $finalMark++;
            } elseif ($questionValue === 'a2' || $questionValue === 'b2' || $questionValue === 'c2' || $questionValue === 'd2') {
                $finalMark += 2;
            }
        }

        $apiData[$selectedWeek]['final_mark'] = $finalMark;

        if (file_put_contents($apiFilePath, json_encode($apiData, JSON_PRETTY_PRINT))) {
            SpecialLogService::createLog('3', "added exam : " . $selectedWeek . ', for : ' . $grade);

            $addedData = "<strong>Exam added successfully!</strong>\n\n";
            $addedData .= "<strong>Grade</strong>: $grade\n";
            $addedData .= "<strong>Exam</strong>: " . ($selectedWeek[4] ?? '') . "\n";
            $addedData .= "<strong>Exam questions</strong>: $numQuestions\n";
            $addedData .= "<strong>Exam time</strong>: $minutes minutes\n\n";

            foreach ($apiData[$selectedWeek] as $key => $value) {
                if ($key !== 'num' && $key !== 'time' && $key !== 'final_work') {
                    $addedData .= "<strong>Question $key</strong>: $value\n";
                }
            }

            return redirect()->back()->with('store_msg', $addedData);
        } else {
            return redirect()->back()->with('flash_msg', 'Failed to add data to the API.');
        }
    }

    public function storeHW(Request $request)
    {
        $selectedWeek = $request->input('selected_week');
        // $selectedWeek = 'week' . $request->input('selected_week') . 'sec3h';
        // dd($selectedWeek);
        $numQuestions = $request->input('numQuestions');
        $grade = $request->input('grade');
        // $minutes = $request->input('minutes');

        $apiFilePath = storage_path('apiHW' . '/' . $grade . '/HWAnswersApi.json');
        $apiData = json_decode(file_get_contents($apiFilePath), true);

        $apiData[$selectedWeek] = [
            'num' => $numQuestions,
            // 'time' => $minutes,
        ];

        $finalMark = 0;

        for ($i = 1; $i <= $numQuestions; $i++) {
            $questionValue = $request->input($i);
            $apiData[$selectedWeek][(string) $i] = $questionValue;

            if ($questionValue === 'a' || $questionValue === 'b' || $questionValue === 'c' || $questionValue === 'd') {
                $finalMark++;
            } elseif ($questionValue === 'a2' || $questionValue === 'b2' || $questionValue === 'c2' || $questionValue === 'd2') {
                $finalMark += 2;
            }
        }

        // return $apiData ;

        $apiData[$selectedWeek]['final_mark'] = $finalMark;

        if (file_put_contents($apiFilePath, json_encode($apiData, JSON_PRETTY_PRINT))) {
            SpecialLogService::createLog('3', "added HW : " . $selectedWeek . ', for : ' . $grade);

            $addedData = "<strong>Exam added successfully!</strong>\n\n";
            $addedData .= "<strong>Grade</strong>: $grade\n";
            $addedData .= "<strong>Exam</strong>: " . ($selectedWeek[4] ?? '') . "\n";
            $addedData .= "<strong>Exam questions</strong>: $numQuestions\n";
            // $addedData .= "<strong>Exam time</strong>: $minutes minutes\n\n";

            foreach ($apiData[$selectedWeek] as $key => $value) {
                if ($key !== 'num' && $key !== 'time' && $key !== 'final_work') {
                    $addedData .= "<strong>Question $key</strong>: $value\n";
                }
            }

            return redirect()->back()->with('store_msg', $addedData);
        } else {
            return redirect()->back()->with('flash_msg', 'Failed to add data to the API.');
        }
    }
}