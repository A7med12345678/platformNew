
// Exam disable
    // public function disableExam(Request $request)
    // {
    //     $request->validate([
    //         'grade' => 'required',
    //         'current' => 'required',
    //     ]);

    //     try {
    //         $grade = $request->input('grade');
    //         $current = 'week' . $request->input('current') . 'sec4';
    //         // dd($current);

    //         $disable = exam::where('user_grade', $grade)
    //             ->where($current, '#')
    //             ->update([
    //                 $current => 'غائب',
    //             ]);

    //         return redirect()->back()->with('flash_msg', "Exam $current disabled successfully for $grade.");
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('flash_msg', 'Failed to disable exam. Please try again.');
    //     }
    // }

    // // HW disable
    // public function disableHW(Request $request)
    // {
    //     $request->validate([
    //         'grade' => 'required',
    //         'current' => 'required',
    //     ]);

    //     try {
    //         $grade = $request->input('grade');
    //         $current = 'week' . $request->input('current') . 'sec3h';

    //         $disable = homework::where('user_grade', $grade)
    //             ->where($current, '#')
    //             ->update([
    //                 $current => 'الواجب غائب',
    //             ]);

    //         return redirect()->back()->with('flash_msg', "Homework $current disabled successfully for $grade.");
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('flash_msg', 'Failed to disable homework. Please try again.');
    //     }
    // }



    
    // // enable exam again (exam reset) : 
    // public function enableExam(Request $request)
    // {

    //     $selectedExam = 'week' . $request->input('selected') . 'sec4';
    //     $userId = $request->input('id');

    //     try {
    //         exam::where('user_id', $userId)->update([$selectedExam => '#']);
    //         return back()->with('flash_msg', "Exam $selectedExam Enabled for User $userId ! ");
    //     } catch (\Exception $e) {
    //         return back()->with('flash_msg', 'Failed to enable exam: ' . $e->getMessage());
    //     }
    // }

    // // enable HW again (exam reset) : 

    // public function enableHW(Request $request)
    // {

    //     $selectedHW = 'week' . $request->input('selected') . 'sec3h';
    //     $userId = $request->input('id');

    //     try {
    //         homework::where('user_id', $userId)->update([$selectedHW => '#']);
    //         return back()->with('flash_msg', "Homework $selectedHW Enabled for User $userId ! ");
    //     } catch (\Exception $e) {
    //         return back()->with('flash_msg', 'Failed to enable Home Work : ' . $e->getMessage());
    //     }
    // }


    
    // calaulate exam marks for students :
    // public function processScore(Request $request)
    // {
    //     // dd($request->input());
    //     $isValidG = $request->query('isValidG');

    //     $now = $request->input('now');
    //     $nowDBTime = $now . 'Time';

    //     $grade = Auth::user()->grade;
    //     // $userId = Auth::user()->id;
    //     $userId = Auth::user()->center_code;

    //     // dd($userId);
    //     // dd($now);
    //     // $existingExam = exam::where('user_id', $userId)->first();
    //     $existingExam = exam::where('user_id', $userId)->first();
    //     // dd($existingExam->$now);
    //     if ($existingExam && $existingExam->$now == '#') {
    //         $score = 0;
    //         $answerData = $request->input('answer');
    //         // $quizData = \json_decode(\file_get_contents('http://127.0.0.1:8080/'. $grade . '/examAnswersApi.json'), true);
    //         $quiz = \file_get_contents(storage_path('api/' . $grade . '/examAnswersApi.json'));
    //         $quizData = \json_decode($quiz, true);
    //         $data = $quizData[$now];

    //         $score = 0;

    //         $studentAnswers = [];

    //         foreach ($quizData[$now] as $questionNumber => $correctAnswer) {
    //             // Check if the answer for the current question number exists in the $answerData array
    //             if (!isset($answerData[$questionNumber])) {
    //                 continue; // Skip this question if the answer is not set
    //             }

    //             $userAnswer = $answerData[$questionNumber];

    //             // Check if it's a 2-mark question
    //             if (substr($correctAnswer, -1) === '2') {
    //                 // For 2-mark questions, compare only the first character of the correct answer
    //                 $correctAnswer = substr($correctAnswer, 0, 1);
    //                 $userAnswer = substr($userAnswer, 0, 1);
    //                 if ($userAnswer === $correctAnswer) {
    //                     $score += 2; // Increase score by 2 for correct answer in 2-mark question
    //                 }
    //             } else {
    //                 // For 1-mark questions, compare the whole answer
    //                 if ($userAnswer === $correctAnswer) {
    //                     $score++; // Increase score by 1 for correct answer in 1-mark question
    //                 }
    //             }
    //             // Add the student's answer and correctness to the array
    //             $studentAnswers[$questionNumber] = [
    //                 'userAnswer' => $userAnswer,
    //             ];
    //         }

    //         // dd($studentAnswers);
    //         $result = $score;
    //         $finalMark = $quizData[$now]['final_mark'];

    //         // Ensure the left side (score) is less than or equal to the right side (finalMark)
    //         $formattedResult = min($result, $finalMark) . '/' . max($result, $finalMark);

    //         // dd($now , $nowDBTime);
    //         // Store the result in the determined format
    //         exam::where('user_id', $userId)
    //             ->update([
    //                 $now => $formattedResult,
    //                 $nowDBTime => Carbon::now()
    //             ]);

    //         // $finalResult = $result . ' من ' . $quizData[$now]['final_mark'];
    //         $percentage = "(" . ($result / $quizData[$now]['final_mark']) * 100 . "%" . ")";
    //         $successORfail = (int) $result / (int) $quizData[$now]['final_mark'];

    //         // dd($data);

    //         return redirect()->back()->with('flash_msg', 'تم')
    //             ->with('result', $formattedResult)
    //             ->with('successORfail', $successORfail)
    //             ->with('data', $data)
    //             ->with('percentage', $percentage)
    //             ->with('studentAnswers', $studentAnswers); // Include student's answers
    //         //  ->with('now', $now);

    //         // Do something with the $result, $now, and $userId variables
    //     } else {
    //         return redirect()->route('archive')->with('flash_msg', 'لقد قمت بالدخول لهذا الامتحان مسبقًا');
    //     }
    // }

    // // calaulate HW marks for students :
    // public function processScoreHW(Request $request)
    // {
    //     $isValidG = $request->query('isValidG');

    //     $nowDB = $request->input('now') . 'h';
    //     $nowDBTime = $request->input('now') . 'h' . 'Time';
    //     $now = $request->input('now');
    //     $grade = Auth::user()->grade;
    //     $user_grade = Auth::user()->grade;
    //     $userId = Auth::user()->center_code;

    //     $existingExam = homework::where('user_id', $userId)->first();

    //     // dd($existingExam->$now , $now);
    //     // dd($userId);
    //     // dd($now);
    //     // $userId = Auth::user()->id;
    //     // $existingExam = exam::where('user_id', $userId)->first();
    //     // dd($nowDBTime , $nowDB);
    //     // dd($request->input());


    //     if ($existingExam && $existingExam->$nowDB == '#') {
    //         // dd($now , $nowDB);
    //         // $quizData = \json_decode(\file_get_contents('http://127.0.0.1:8080/'. $grade . '/examAnswersApi.json'), true);
    //         // dd($formattedResult);
    //         // dd($data);

    //         $score = 0;
    //         $answerData = $request->input('answer');
    //         $quiz = \file_get_contents(storage_path('apiHW/' . $grade . '/HWAnswersApi.json'));
    //         $quizData = \json_decode($quiz, true);
    //         $data = $quizData[$now];

    //         $score = 0;
    //         foreach ($quizData[$now] as $questionNumber => $correctAnswer) {
    //             // Check if the answer for the current question number exists in the $answerData array
    //             if (!isset($answerData[$questionNumber])) {
    //                 continue; // Skip this question if the answer is not set
    //             }

    //             $userAnswer = $answerData[$questionNumber];

    //             $userAnswer = $answerData[$questionNumber];

    //             // Check if it's a 2-mark question
    //             if (substr($correctAnswer, -1) === '2') {
    //                 // For 2-mark questions, compare only the first character of the correct answer
    //                 $correctAnswer = substr($correctAnswer, 0, 1);
    //                 $userAnswer = substr($userAnswer, 0, 1);
    //                 if ($userAnswer === $correctAnswer) {
    //                     $score += 2; // Increase score by 2 for correct answer in 2-mark question
    //                 }
    //             } else {
    //                 // For 1-mark questions, compare the whole answer
    //                 if ($userAnswer === $correctAnswer) {
    //                     $score++; // Increase score by 1 for correct answer in 1-mark question
    //                 }
    //             }
    //             // Add the student's answer and correctness to the array
    //             $studentAnswers[$questionNumber] = [
    //                 'userAnswer' => $userAnswer,
    //             ];
    //         }

    //         $result = $score;
    //         $finalMark = $quizData[$now]['final_mark'];

    //         // Ensure the left side (score) is less than or equal to the right side (finalMark)
    //         $formattedResult = min($result, $finalMark) . '/' . max($result, $finalMark);

    //         // Store the result in the determined format
    //         homework::where('user_id', $userId)
    //             ->update([
    //                 $nowDB => $formattedResult,
    //                 $nowDBTime => Carbon::now()
    //             ]);

    //         $finalResult = $result . ' من ' . $quizData[$now]['final_mark'];
    //         $percentage = "(" . ($result / $quizData[$now]['final_mark']) * 100 . "%" . ")";
    //         $successORfail = (int) $result / (int) $quizData[$now]['final_mark'];


    //         return redirect()->back()->with('flash_msg', 'تم')
    //             ->with('result', $formattedResult)
    //             ->with('successORfail', $successORfail)
    //             ->with('percentage', $percentage)
    //             ->with('data', $data)
    //             ->with('studentAnswers', $studentAnswers);
    //         //  ->with('now', $now);

    //     } else {
    //         return redirect()->route('archive')->with('flash_msg', 'لقد قمت بالدخول لهذا الامتحان مسبقًا');
    //     }
    // }

    
    // // make sure exam exists (json file) : 
    // public function fetchJsonFile(Request $request)
    // {
    //     $grade = $request->input('grade');
    //     // dd($grade);
    //     // Specify the path to your JSON file
    //     $jsonFilePath = storage_path('api/' . $grade . '/examAnswersApi.json'); // Adjust the path accordingly

    //     // Check if the file exists
    //     if (file_exists($jsonFilePath)) {
    //         // Read the JSON content from the file
    //         $jsonContent = file_get_contents($jsonFilePath);

    //         // Parse the JSON content into an associative array
    //         $jsonData = json_decode($jsonContent, true);

    //         if ($jsonData === null) {
    //             // JSON parsing failed
    //             return response()->json(['message' => 'Error parsing JSON file'], 500);
    //         }

    //         // Pass the JSON data to the Blade template
    //         return view('admin.examShow.showQAns', ['exams' => $jsonData]);
    //     } else {
    //         // File not found
    //         return response()->json(['message' => 'JSON file not found'], 404);
    //     }
    // }

    // // make sure HW exists (json file) : 
    // public function fetchJsonFileHW(Request $request)
    // {
    //     $grade = $request->input('grade');
    //     // dd($grade);

    //     // Specify the path to your JSON file
    //     $jsonFilePath = storage_path('apiHW/' . $grade . '/HWAnswersApi.json'); // Adjust the path accordingly

    //     // Check if the file exists
    //     if (file_exists($jsonFilePath)) {
    //         // Read the JSON content from the file
    //         $jsonContent = file_get_contents($jsonFilePath);

    //         // Parse the JSON content into an associative array
    //         $jsonData = json_decode($jsonContent, true);

    //         if ($jsonData === null) {
    //             // JSON parsing failed
    //             return response()->json(['message' => 'Error parsing JSON file'], 500);
    //         }

    //         // Pass the JSON data to the Blade template
    //         return view('admin.HWShow.showQAnsHW', ['exams' => $jsonData]);
    //     } else {
    //         // File not found
    //         return response()->json(['message' => 'JSON file not found'], 404);
    //     }
    // }