<?php

namespace App\Http\Controllers;

use App\Models\complain;
use App\Models\courseRequest;
use App\Models\dashboardChange;
use App\Models\instruction;
use App\Models\specialLog;
use App\Models\select;
use App\Models\timeTable;
use App\Services\SpecialLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\HonerStudent;
use App\Models\Exam;

class SelectController extends Controller
{

    // view :

    public function index(Request $request)
    {
        $content = Select::where('grade', Auth::user()->grade)->latest()->first(); // $content = Select::where('grade',Auth::user()->grade);
        // dd($content);
        return view('students.archive')
            ->with('content', $content);
    }

    public function homeStudent(Request $request)
    {
        $instructions = instruction::where('grade', Auth::user()->grade)->get();

        // Check if there are course requests and fetch them
        $courseRequests = courseRequest::
            where('student_code', Auth::user()->center_code)
            ->where('course', Auth::user()->grade)
            ->first();

        return view('home2', compact('instructions', 'courseRequests'));

        // if ($courseRequests->isNotEmpty()) {
        //     return view('home2', compact('instructions', 'courseRequests'));
        // } else {
        //     return view('home2', compact('instructions'));
        // }
    }


    public function currentWeek(Request $request)
    {
        //current week, sec :

        // $currentWeek = Select::latest()->first();
        $content = Select::where('grade', Auth::user()->grade)->first(); // $content = Select::where('grade',Auth::user()->grade);
        // dd($content);
        $poster = dashboardChange::where('id', 3)->first();
        // current week logic view :
        $grades = ['3', '2', '1'];
        $user = Auth::user();
        $user_grade = Auth::user()->grade;
        // dd($user_grade);
        $grade = $user->grade;
        // $user_start_from = json_decode($user->start_from);
        $user_end_to = json_encode($user->student_end);

        // $maxStart = array_map('intval', json_decode($user->start_from));
        $maxEnd = array_map('intval', json_decode($user->student_end));
        $student_end = max($maxEnd);
        // dd($student_end );

        //    41     ,                 40
        $max_week = min($student_end, (int) $content->selected_week);

        $json = storage_path('api/' . $user_grade . '/lessonDetails.json');
        $jsonContents = File::get($json);
        $data = json_decode($jsonContents, true);
        $weeks = 45;

        $random_mask = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(11 / strlen($x)))), 1, 11);

        return view('students.currentWeek', compact('poster', 'max_week', 'user_grade', 'data', 'grades', 'content', 'random_mask', 'grade'));

        // // Check if $content->selected_week is less than the maximum values
        // $selectedWeek = $content->selected_week;

        // if ($selectedWeek < $maxStart && $selectedWeek < $maxEnd) {

        // } else {
        //     $no_content = "No Content ! ";
        //     return view('students.currentWeek', compact('no_content'));
        // }


        // // 

        // // return dd(compact('user_start_from', 'user_grade', 'data', 'grades', 'content', 'random_mask', 'grade'));
    }

    public function archive(Request $request)
    {
        //current week, sec :

        // $currentWeek = Select::latest()->first();
        $content = Select::where('grade', Auth::user()->grade)->latest()->first(); // $content = Select::where('grade',Auth::user()->grade);
        $poster = dashboardChange::where('id', 3)->first(); // $content = Select::where('grade',Auth::user()->grade);
        // dd($content);

        // current week logic view :
        $grades = ['3', '2', '1'];
        $user = Auth::user();
        $user_grade = $user->grade;
        $grade = $user->grade;

        // -------------------------------- start sorting : -----------------------------------

        $unsroted_user_start_from = json_decode($user->start_from);
        $unsroted_user_end_to = json_decode($user->student_end);

        // Combine the start_from and end_to arrays into a single array
        $combined_array = array_combine($unsroted_user_start_from, $unsroted_user_end_to);

        // Sort the combined array by the keys (start_from values)
        ksort($combined_array);

        // Separate the sorted values into two separate arrays
        $user_start_from = array_keys($combined_array);
        $user_end_to = array_values($combined_array);
        // Now, $sorted_start_from and $sorted_end_to are rearranged based on start_from values

        // -------------------------------- end sorting : -----------------------------------



        // -------------------------------- delete not selected weeks : ------------------------------

        $current_lesson = $content->selected_week;
        // dd($current_lesson);

        // Loop through the $user_end_to array and update values
        for ($i = 0; $i < count($user_end_to); $i++) {
            if ($user_end_to[$i] > $current_lesson) {
                $user_end_to[$i] = $current_lesson;
            }
        }
        // -------------------------------- end delete not selected weeks : ------------------------------

        // dd($user_start_from , $user_end_to);

        $json = storage_path('api/' . $user_grade . '/lessonDetails.json');
        $jsonContents = File::get($json);
        $data = json_decode($jsonContents, true);
        $weeks = 45;

        $random_mask = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(11 / strlen($x)))), 1, 11);

        return view('students.archive', compact('poster', 'current_lesson', 'user_start_from', 'user_end_to', 'user_grade', 'data', 'grades', 'content', 'random_mask', 'grade'));

        // return dd(compact('user_start_from', 'user_grade', 'data', 'grades', 'content', 'random_mask', 'grade'));
    }

    public function FAQquestions()
    {
        $complains = complain::where('grade', Auth::user()->grade)
            ->where('aprove', '1')
            ->paginate(20);

        return view('students.FAQQ')->with('complains', $complains);
    }

    public function timeTable(Request $request)
    {

        $timeTables = timeTable::where('for_course', Auth::user()->group)->get();

        $total[] = null;
        $type[] = null;
        foreach ($timeTables as $timaetable) {


            if (!empty($timaetable->lecture_time)) {
                $total[] = substr($timaetable->lecture_time, 0, 2) . substr($timaetable->lecture_day, 0, 3);
                // $type[] = 'lecture';
                $type[] = 'محاضرة';
            } else {
                $total[] = substr($timaetable->exam_time, 0, 2) . substr($timaetable->exam_day, 0, 3);
                $type[] = 'امتحان';
            }

        }

        // dd($total , $type);
        // dd($allTableNames);
        return view('students.timeTable', compact('total', 'type'));

    }

    public function courseBuy()
    {
        // $complains = complain::where('grade', Auth::user()->grade)
        //     ->where('aprove', '1')
        //     ->paginate(2); // You can adjust the number of items per page (e.g., 10) as needed.

        return view('students.courseBuy')
            // ->with('complains', $complains)
        ;
    }
    public function liveStream(Request $request)
    {
        $link = $request->input('link');
        // dd($link);
        // Define a regular expression pattern to match the YouTube video ID
        $pattern = '/(v=|\/videos\/|embed\/|youtu.be\/|\/v\/|\/e\/|watch\?v=|embed?v=|\/v\?|\/e\?|watch\?feature=player_embedded&v=|youtu.be\/v=|youtu.be\/embed\/|youtube.com\/v\/)([a-zA-Z0-9_-]+)/';

        // Use preg_match to extract the video ID from the link
        if (preg_match($pattern, $link, $matches)) {
            $videoId = $matches[2]; // $videoId will be 'KKQVW_G42Zo'
        } else {
            // If the video ID couldn't be extracted, you can handle the error here
            return redirect()->back()->with('error', 'Invalid YouTube link');
        }
        // dd($videoId);
        // Pass the video ID to the view
        return view('students.liveStream', compact('videoId'));
    }

    // Admin dashboard (one of its functions) :
    public function indexAdmin()
    {
        $weekIds = [1, 2, 3];
        $data = [];

        foreach ($weekIds as $weekId) {
            $data["currentWeek{$weekId}"] = Select::where('id', $weekId)->latest()->first();
        }

        return $data;
    }

    // ----------------------------------------- start exam hw page :
    public function weekExam(Request $request)
    {
        return $this->processRequest($request, 'exam');
    }

    public function weekHW(Request $request)
    {
        return $this->processRequest($request, 'hw');
    }

    private function processRequest(Request $request, $type)
    {
        // Get request parameters
        $week = $request->query('week');
        $section = $request->query('section');
        $isValidG = $request->query('isValidG');
        $now = 'week' . $week . 'sec' . $section;

        $okOrNo = exam::where('user_id', Auth::user()->center_code)->pluck($now)->first();

        if($okOrNo !== '#'){
            // dd($okOrNo);
            return redirect()->back()->with('flash_msg', 'قمت بالدخول مسبقا');
        }

        // Define the JSON file path based on the type
        $jsonFilePath = storage_path("api" . ($type === 'exam' ? '' : 'HW') . "/{$isValidG[0]}/" . ($type === 'exam' ? 'exam' : 'HW') . "AnswersApi.json");

        if (!file_exists($jsonFilePath)) {
            $errorType = ($type === 'exam') ? "Exam" : "Home Work";
            return view('errorPages.examNotUploaded', compact('errorType'));
        }

        // Read and decode the JSON data
        $quizData = file_get_contents($jsonFilePath);
        $quizDataArray = json_decode($quizData, true);

        // Check if the specified key exists in the JSON data and has the 'num' value
        if (!array_key_exists($now, $quizDataArray) || !isset($quizDataArray[$now]['num'])) {
            $errorType = ($type === 'exam') ? "Exam" : "Home Work";
            return view('errorPages.examNotUploaded', compact('errorType'));
        }

        // Get the number of questions
        $numQuestions = $quizDataArray[$now]['num'];

        if ($type === 'exam') {
            $timeExam = $quizDataArray[$now]['time'] * 60 * 1000;
        }

        // Define the image 'for' value
        $for = ($type === 'exam') ? "{$isValidG[0]}({$now})" : "HW{$isValidG[0]}({$now})";

        // Retrieve images from the database
        $images = HonerStudent::where('image_for', $for)->get();

        // Get the latest exam
        $currentExam = Select::latest()->first();

        if ($type === 'exam') {
            return view('students.studentExam', compact('quizDataArray', 'numQuestions', 'images', 'currentExam', 'week', 'section', 'isValidG', 'now', 'timeExam'));
        } else {
            return view('students.studentHW', compact('quizDataArray', 'numQuestions', 'images', 'currentExam', 'week', 'section', 'isValidG', 'now'));
        }
    }
    // ------------------------------------------ end exam hw page :

    // enable Lec, Exam, HW : 
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $selectedGrade = $input['selected_grade'];
            $selectedWeek = $input['selected_week'];
            $selectedSection = $input['selected_section'];

            SpecialLogService::createLog('3', "enable : " . $selectedWeek . ' -> ' . $selectedSection . ', for : ' . $selectedGrade);

            // upa=date current statues for grade :
            select::where('grade', $selectedGrade)->update([
                'selected_week' => $selectedWeek,
                'selected_section' => $selectedSection,
            ]);

            // if exam (enable exam button , fire queue to close it after time ) : 
            if ($selectedSection === 'sec4') {
                $quizData = file_get_contents(storage_path("api/{$selectedGrade}/examAnswersApi.json"));
                $quizDataArray = json_decode($quizData, true);
                $now = "week{$selectedWeek}{$selectedSection}";
                $finaltime = intval($quizDataArray[$now]['time']) + 10;

                // UpdateExamRecords::dispatch($selectedWeek, $selectedSection, $selectedGrade)->delay(now()->addMinutes($finaltime));
            }

            // if lecture (add or edit its title) :
            if (isset($input['lecTitle'])) {
                $apiFilePath = storage_path("api/{$selectedGrade}/lessonDetails.json");
                $apiData = json_decode(file_get_contents($apiFilePath), true);
                $selectedWeekKey = "week{$selectedWeek}";
                $selectedSection = (int) substr($selectedSection, -1);

                if (isset($apiData[$selectedWeekKey])) {
                    foreach ($apiData[$selectedWeekKey] as &$section) {
                        if ($section['sec'] === $selectedSection) {
                            $section['title'] = $input['lecTitle'];
                            break;
                        }
                    }

                    file_put_contents($apiFilePath, json_encode($apiData));
                }
            }


            if (isset($input['live'])) {
                $apiFilePath = storage_path("api/{$selectedGrade}/lessonDetails.json");
                $apiData = json_decode(file_get_contents($apiFilePath), true);
                $selectedWeekKey = "week{$selectedWeek}";
                $selectedSection = (int) substr($selectedSection, -1);

                if (isset($apiData[$selectedWeekKey])) {
                    $found = false;

                    foreach ($apiData[$selectedWeekKey] as &$section) {
                        if ($section['sec'] === $selectedSection) {
                            // Update the "live" link if the section matches
                            $section['live'] = $input['live'];
                            $found = true;
                            break;
                        }
                    }

                    if (!$found) {
                        // Create a new section for the "live" link
                        $liveSection = [
                            'live' => $input['live'],
                            'sec' => $selectedSection,
                        ];

                        // Append the "live" section to the selected week
                        $apiData[$selectedWeekKey][] = $liveSection;
                    }

                    file_put_contents($apiFilePath, json_encode($apiData, JSON_PRETTY_PRINT));
                }
            }

        } catch (\Exception $e) {
            // Handle exceptions here, e.g., log the error, display an error message, or perform any necessary cleanup.
            return redirect()->back()->with('error_msg', 'An error occurred: ' . $e->getMessage());
        }
        return redirect()->back()->with('flash_msg', 'Week Added!');
    }


    // public function store(Request $request)
    // {
    //     try {
    //         $input = $request->all();
    //         $selectedGrade = $input['selected_grade'];
    //         $selectedWeek = $input['selected_week'];
    //         $selectedSection = $input['selected_section'];

    //         // Log the action
    //         SpecialLogService::createLog('3', "enable: Week $selectedWeek -> Section $selectedSection, for Grade $selectedGrade");

    //         // Update the selected week and section
    //         Select::where('grade', $selectedGrade)->update([
    //             'selected_week' => $selectedWeek,
    //             'selected_section' => $selectedSection,
    //         ]);

    //         // Update exam records (if applicable)
    //         if ($selectedSection === 'sec4') {
    //             $quizData = json_decode(file_get_contents(storage_path("api/{$selectedGrade}/examAnswersApi.json"), true));
    //             $now = "week{$selectedWeek}{$selectedSection}";
    //             $finaltime = intval($quizData[$now]['time']) + 10;

    //             // Uncomment this line to enable the queue job
    //             // UpdateExamRecords::dispatch($selectedWeek, $selectedSection, $selectedGrade)->delay(now()->addMinutes($finaltime));
    //         }

    //         // Update lesson title (if provided)
    //         if (isset($input['lecTitle'])) {
    //             $this->updateLessonTitle($selectedGrade, $selectedWeek, $selectedSection, $input['lecTitle']);
    //         }

    //         // Update "live" link (if provided)
    //         if (isset($input['live'])) {
    //             $this->updateLiveLink($selectedGrade, $selectedWeek, $selectedSection, $input['live']);
    //         }

    //     } catch (\Exception $e) {
    //         // Handle exceptions here, e.g., log the error, display an error message, or perform any necessary cleanup.
    //         return redirect()->back()->with('error_msg', 'An error occurred: ' . $e->getMessage());
    //     }

    //     return redirect()->back()->with('flash_msg', 'Week Added!');
    // }

    // private function updateLessonTitle($grade, $week, $section, $title)
    // {
    //     $apiFilePath = storage_path("api/$grade/lessonDetails.json");
    //     $apiData = json_decode(file_get_contents($apiFilePath), true);
    //     $weekKey = "week$week";
    //     $section = (int) substr($section, -1);

    //     if (isset($apiData[$weekKey])) {
    //         foreach ($apiData[$weekKey] as &$sec) {
    //             if ($sec['sec'] === $section) {
    //                 $sec['title'] = $title;
    //                 break;
    //             }
    //         }
    //     }

    //     file_put_contents($apiFilePath, json_encode($apiData, JSON_PRETTY_PRINT));
    // }

    // private function updateLiveLink($grade, $week, $section, $liveLink)
    // {
    //     $apiFilePath = storage_path("api/$grade/lessonDetails.json");
    //     $apiData = json_decode(file_get_contents($apiFilePath), true);
    //     $weekKey = "week$week";
    //     $section = (int) substr($section, -1);

    //     if (isset($apiData[$weekKey])) {
    //         $found = false;

    //         foreach ($apiData[$weekKey] as &$sec) {
    //             if ($sec['sec'] === $section) {
    //                 // Update the "live" link if the section matches
    //                 $sec['live'] = $liveLink;
    //                 $found = true;
    //                 break;
    //             }
    //         }

    //         if (!$found) {
    //             // Create a new section for the "live" link
    //             $liveSection = [
    //                 'live' => $liveLink,
    //                 'sec' => $section,
    //             ];

    //             // Append the "live" section to the selected week
    //             $apiData[$weekKey][] = $liveSection;
    //         }

    //         file_put_contents($apiFilePath, json_encode($apiData, JSON_PRETTY_PRINT));
    //     }
    // }


}