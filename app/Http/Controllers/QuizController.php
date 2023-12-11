<?php

namespace App\Http\Controllers;

use App\Models\homework;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\exam;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

    // ------------------------ Hw , exam Api, JSON existnce --------------------

    public function fetchJsonFile(Request $request)
    {
        return $this->fetchJsonFiles($request, 'exam');
    }

    public function fetchJsonFileHW(Request $request)
    {
        return $this->fetchJsonFiles($request, 'homework');
    }

    private function fetchJsonFiles(Request $request, $reportType)
    {
        $grade = $request->input('grade');
        // Specify the path to your JSON file
        $jsonFilePath = storage_path('api' . ($reportType === 'exam' ? '' : 'HW') . '/' . $grade . '/' . ($reportType === 'exam' ? 'exam' : 'HW') . 'AnswersApi.json');
        // $quiz = \file_get_contents(storage_path('api' . ($reportType === 'exam' ? '' : 'HW') . '/' . $grade . '/' . ($reportType === 'exam' ? 'Exam' : 'HW') . 'AnswersApi.json'));
        // dd($$jsonFilePath);
        // Check if the file exists
        if (file_exists($jsonFilePath)) {
            // Read the JSON content from the file
            $jsonContent = file_get_contents($jsonFilePath);

            // Parse the JSON content into an associative array
            $jsonData = json_decode($jsonContent, true);

            if ($jsonData === null) {
                // JSON parsing failed
                return response()->json(['message' => 'Error parsing JSON file'], 500);
            }

            // Determine the view based on the report type
            $view = $reportType === 'exam' ? 'admin.examShow.showQAns' : 'admin.HWShow.showQAnsHW';

            // Pass the JSON data to the Blade template
            return view($view, ['exams' => $jsonData]);
        } else {
            // File not found
            return response()->json(['message' => 'JSON file not found'], 404);
        }
    }

    // ------------------------ Hw , exam photos existnce --------------------

    public function showExamPhoto(Request $request)
    {
        $grade = $request->input('grade');
        // dd($grade);

        // Make sure $grade is set before redirecting
        return view('admin.examShow.showQuestions', compact('grade'));
    }

    public function showHWPhoto(Request $request)
    {
        $grade = $request->input('grade');
        // dd($grade);

        // Make sure $grade is set before redirecting
        return view('admin.HWShow.showQuestionsHW', compact('grade'));
    }


    // ----------------------------------- Hw , exam proccess Scroe ----------------------------------
    public function processScore(Request $request)
    {
        return $this->processScoreGeneral($request, 'exam');
    }

    public function processScoreHW(Request $request)
    {
        return $this->processScoreGeneral($request, 'homework');
    }

    private function processScoreGeneral(Request $request, $reportType)
    {
        $isValidG = $request->query('isValidG');
        $now = $request->input('now');
        $pattern = '/week(\d+)sec\d+/';
        $weekNum = preg_match($pattern, $now, $matches);
        // dd($weekNum);

        $user = Auth::user();
        $grade = $user->grade;
        $userId = $user->center_code;

        // DD($now);
        // Determine the table and column to update based on the report type
        $table = ($reportType === 'exam') ? 'exam' : 'homework';
        $column = ($reportType === 'exam') ? $now : $now . 'h';
        $columnTime = $column . 'Time';

        $existingReport = DB::table($table)->where('user_id', $userId)->first();

        if ($existingReport && $existingReport->$column == '#') {
            $score = 0;
            $answerData = $request->input('answer');
            // $quiz = \file_get_contents(storage_path('api' . ($reportType === 'exam' ? '' : 'HW') . '/' . $grade . '/' . strtoupper($reportType) . 'AnswersApi.json'));
            $quiz = \file_get_contents(storage_path('api' . ($reportType === 'exam' ? '' : 'HW') . '/' . $grade . '/' . ($reportType === 'exam' ? 'exam' : 'HW') . 'AnswersApi.json'));

            $quizData = \json_decode($quiz, true);
            $data = $quizData[$now];

            $score = 0;
            $studentAnswers = [];

            foreach ($quizData[$now] as $questionNumber => $correctAnswer) {
                // Check if the answer for the current question number exists in the $answerData array
                if (!isset($answerData[$questionNumber])) {
                    continue; // Skip this question if the answer is not set
                }

                $userAnswer = $answerData[$questionNumber];

                // Check if it's a 2-mark question
                if (substr($correctAnswer, -1) === '2') {
                    // For 2-mark questions, compare only the first character of the correct answer
                    $correctAnswer = substr($correctAnswer, 0, 1);
                    $userAnswer = substr($userAnswer, 0, 1);
                    if ($userAnswer === $correctAnswer) {
                        $score += 2; // Increase score by 2 for correct answer in 2-mark question
                    }
                } else {
                    // For 1-mark questions, compare the whole answer
                    if ($userAnswer === $correctAnswer) {
                        $score++; // Increase score by 1 for correct answer in 1-mark question
                    }
                }

                // Add the student's answer and correctness to the array
                $studentAnswers[$questionNumber] = [
                    'userAnswer' => $userAnswer,
                ];
            }

            $result = $score;
            $finalMark = $quizData[$now]['final_mark'];

            // Ensure the left side (score) is less than or equal to the right side (finalMark)
            $formattedResult = min($result, $finalMark) . '/' . max($result, $finalMark);


            // exam attemps : 

            // Retrieve the current "exam_attempts" JSON data
            $attempts = json_decode($user->exams_attemps, true);

            // Adding or updating the index for a specific exam
            $attempts[$weekNum - 1] += 1;

            // Encoding and saving the updated JSON data
            $user->exams_attemps = json_encode($attempts);
            $user->save();

            if ($attempts[$weekNum - 1] > 3) {
                return redirect()->route('archive')->with('flash_msg', 'عفوا  تم اجتياز عدد المرات المسموح دخولها لهذا الامتحان');
            } else {

                if ($result / $finalMark <= 0.5) {
                    return redirect()->route('archive')->with('flash_msg', 'عفوا الرجاء اجتياز درجة الامتحان المطلوبة اولا');
                } else {
                    // Store the result in the determined format
                    DB::table($table)->where('user_id', $userId)
                        ->update([
                            $column => $formattedResult,
                            $columnTime => Carbon::now()
                        ]);

                    $reportName = ($reportType === 'exam') ? 'Exam' : 'Homework';
                    $finalResult = $result . ' من ' . $quizData[$now]['final_mark'];
                    $percentage = "(" . ($result / $quizData[$now]['final_mark']) * 100 . "%" . ")";
                    $successORfail = (int) $result / (int) $quizData[$now]['final_mark'];

                }
            }
            // end exam attemps 

            return redirect()->back()->with('flash_msg', 'تم')
                ->with('result', $formattedResult)
                ->with('successORfail', $successORfail)
                ->with('percentage', $percentage)
                ->with('data', $data)
                ->with('studentAnswers', $studentAnswers);

        } else {
            return redirect()->route('archive')->with('flash_msg', 'لقد قمت بالدخول لهذا ال' . ($reportType === 'exam' ? 'امتحان' : 'واجب') . ' مسبقًا');
        }
    }

    // -------------------------------- Hw , exam Enbale Exam ---------------------------------
    public function enableExam(Request $request)
    {
        return $this->enableAssessmentAgain($request, 'exam');
    }

    public function enableHW(Request $request)
    {
        return $this->enableAssessmentAgain($request, 'homework');
    }

    private function enableAssessmentAgain(Request $request, $reportType)
    {
        $selectedReport = $request->input('selected');
        $userId = $request->input('id');
        $incOrdec = $request->input('incOrdec');

        // dd($incOrdec);

        try {
            // Determine the table and column to update based on the report type
            $table = ($reportType === 'exam') ? 'exam' : 'homework';
            $column = ($reportType === 'exam') ? "week{$selectedReport}sec4" : "week{$selectedReport}sec3h";
            $userTable = ($reportType === 'exam') ? 'exams_attemps' : 'hw_attemps';

            // Update the specified column in the $table
            DB::table($table)->where('user_id', $userId)->update([$column => '#']);

            if ($incOrdec == "yes") {
                // Find the user by their ID
                $user = user::where('center_code', $userId)->first();

                if ($user) {
                    // Update the user's attempt data
                    $userAttempts = json_decode($user->$userTable, true);
                    $userAttempts[$selectedReport - 1] -= 1;
                    $user->$userTable = json_encode($userAttempts);
                    $user->save();
                }
            }


            $reportName = ($reportType === 'exam') ? 'Exam' : 'Homework';

            return back()->with('flash_msg', "$reportName $column Enabled for User $userId !");
        } catch (\Exception $e) {
            $reportName = ($reportType === 'exam') ? 'exam' : 'homework';
            return back()->with('flash_msg', "Failed to enable $reportName: " . $e->getMessage());
        }
    }


    // -------------------------- first , last : ---------------------------

    public function sumExams(Request $request)
    {
        return $this->sumStatistics($request, 'exam');
    }

    public function sumExamsHW(Request $request)
    {
        return $this->sumStatistics($request, 'homework');
    }

    private function sumStatistics(Request $request, $reportType)
    {
        // Validate the form input
        // $request->validate([
        //     'sec' => 'required|integer|min:1|max:45', // Assuming the input name is 'sec'
        // ]);

        $from = $request->input('from');
        // $from = 2;
        $numExamsToSum = $request->input('to');
        // $numExamsToSum = 4;
        $order = $request->input('order');
        // $order = "DESC";
        $num = $request->input('num');
        // dd( $num , var_dump($num)); 
        // $num = 10;
        $grade = $request->input('grade');
        // dd($grade , $from , $numExamsToSum , $order , $numExamsToSum);

        // Determine the table and column prefix based on the report type
        $table = ($reportType === 'exam') ? 'exam' : 'homework';
        $columnPrefix = ($reportType === 'exam') ? 'sec4' : 'sec3h';

        // Construct the SQL query based on the selected number of exams to sum
        $columnsToSum = [];
        for ($i = $from; $i <= $numExamsToSum; $i++) {
            $columnsToSum[] = "week{$i}{$columnPrefix}";
        }

        // Join the selected columns using '+'
        $columnsToSum = implode(' + ', $columnsToSum);

        // Execute the SQL query
        $results = DB::table($table)
            ->select('user_id', 'user_name', DB::raw("SUM(CAST(SUBSTRING_INDEX({$columnsToSum}, '/', 1) AS UNSIGNED)) AS total"))
            ->where('user_grade', $grade)
            ->groupBy('user_id', 'user_name')
            ->orderBy('total', $order)
            ->limit($num)
            ->get();

        // dd($results);
        return redirect()->back()->with('results', $results);
    }

    // ---------------------------- all Disable : -------------------------

    public function disableExam(Request $request)
    {
        return $this->disableReport($request, 'exam');
    }


    public function disableHW(Request $request)
    {
        return $this->disableReport($request, 'homework');
    }

    private function disableReport(Request $request, $reportType)
    {
        $request->validate([
            'grade' => 'required',
            'current' => 'required',
        ]);

        try {
            $grade = $request->input('grade');
            $current = 'week' . $request->input('current');

            // Determine the table and column prefix based on the report type
            $table = ($reportType === 'exam') ? 'exam' : 'homework';
            $column = ($reportType === 'exam') ? $current . 'sec4' : $current . 'sec3h';

            $disable = DB::table($table)
                ->where('user_grade', $grade)
                ->where($column, '#')
                ->update([$column => ($reportType === 'exam') ? 'غائب' : 'الواجب غائب']);

            $reportName = ($reportType === 'exam') ? 'Exam' : 'Homework';

            return redirect()->back()->with('flash_msg', "$reportName $current disabled successfully for $grade.");
        } catch (\Exception $e) {
            $reportName = ($reportType === 'exam') ? 'exam' : 'homework';
            return redirect()->back()->with('flash_msg', "Failed to disable $reportName. Please try again.");
        }
    }

}