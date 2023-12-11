<?php
namespace App\Http\Controllers\view\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HonerStudent;

class studentExam extends Controller
{
    public function index(Request $request)
    {
        $week = $request->query('week'); 
        $section = $request->query('section'); 
        $isValidG = $request->query('isValidG'); 

        $now = 'week' . $week . 'sec' . $section;

        // Read the JSON data from the file
        $quizData = \file_get_contents(storage_path('api/' . substr($isValidG, 0, 1) . '/examAnswersApi.json'));
        
        // Decode the JSON data
        $quizDataArray = \json_decode($quizData, true);
        
        // (calc success or fail) key from API :
        $numQuestions = $quizDataArray[$now]['num'];
        
        // determine exam time from API : 
        $timeExam = $quizDataArray[$now]['time'] * 60 * 1000;
        $for =  substr($isValidG, 0, 1).'('.$now.')';
        $for2 =  substr($isValidG, 0, 1);
        // 3(week4sec)
        
        $images = HonerStudent::where('image_for', $for)->get();
        // dd($for);

        return view('students.studentExam', compact('quizDataArray', 'numQuestions', 'timeExam', 'images' , 'week' , 'section' , 'isValidG' , 'for2'));
    }
}
