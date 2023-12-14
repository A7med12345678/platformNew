<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SpecialLogService;

class examAddApiController extends Controller
{

    public function storeExam(Request $request)
    {
        $selectedWeek = $request->input('selected_week');
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

            $addedData = [
                'message' => 'Exam added successfully!',
                'data' => [
                    'Grade' => $grade,
                    'Exam' => isset($selectedWeek[4]) ? $selectedWeek[4] : '',
                    'Exam questions' => $numQuestions,
                    'Exam time' => $minutes . ' minutes',
                ],
                'questions' => [],
            ];

            foreach ($apiData[$selectedWeek] as $key => $value) {
                if ($key !== 'num' && $key !== 'time' && $key !== 'final_work') {
                    $addedData['questions']["Question $key"] = $value;
                }
            }

            return response()->json($addedData, 201);
        } else {
            return response()->json(['message' => 'Failed to add data to the API'], 500);
        }
    }


    public function storeHW(Request $request)
    {
        $selectedWeek = $request->input('selected_week');
        $numQuestions = $request->input('numQuestions');
        $grade = $request->input('grade');

        $apiFilePath = storage_path('apiHW' . '/' . $grade . '/HWAnswersApi.json');
        $apiData = json_decode(file_get_contents($apiFilePath), true);

        $apiData[$selectedWeek] = [
            'num' => $numQuestions,
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
            SpecialLogService::createLog('3', "added HW : " . $selectedWeek . ', for : ' . $grade);

            $addedData = [
                'message' => 'Homework added successfully!',
                'data' => [
                    'Grade' => $grade,
                    'Homework' => isset($selectedWeek[4]) ? $selectedWeek[4] : '',
                    'Homework questions' => $numQuestions,
                ],
                'questions' => [],
            ];

            foreach ($apiData[$selectedWeek] as $key => $value) {
                if ($key !== 'num' && $key !== 'time' && $key !== 'final_work') {
                    $addedData['questions']["Question $key"] = $value;
                }
            }

            return response()->json($addedData, 201);
        } else {
            return response()->json(['message' => 'Failed to add data to the API'], 500);
        }
    }


}
