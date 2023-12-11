// // pass required logic to exam page :

// public function weekExam(Request $request)
// {
// // Get request parameters
// $week = $request->query('week');
// $section = $request->query('section');
// $isValidG = $request->query('isValidG');
// $now = 'week' . $week . 'sec' . $section;

// // Define the JSON file path
// $jsonFilePath = storage_path("api/{$isValidG[0]}/examAnswersApi.json");

// if (!file_exists($jsonFilePath)) {
// $type = "Exam";
// return view('errorPages.examNotUploaded', compact('type'));
// }

// // Read and decode the JSON data
// $quizData = file_get_contents($jsonFilePath);
// $quizDataArray = json_decode($quizData, true);

// // Check if the specified key exists in the JSON data and has the 'num' value
// if (!array_key_exists($now, $quizDataArray) || !isset($quizDataArray[$now]['num'])) {
// $type = "Exam";
// return view('errorPages.examNotUploaded', compact('type'));
// }

// // Get the number of questions
// $numQuestions = $quizDataArray[$now]['num'];

// // Get the exam time from the API and convert it to milliseconds
// $timeExam = $quizDataArray[$now]['time'] * 60 * 1000;

// // Define the image 'for' value
// $for = "{$isValidG[0]}({$now})";

// // Retrieve images from the database
// $images = HonerStudent::where('image_for', $for)->get();

// // Get the latest exam
// $currentExam = Select::latest()->first();

// return view('students.studentExam', compact('quizDataArray', 'numQuestions', 'timeExam', 'images', 'currentExam',
'week', 'section', 'isValidG', 'now'));
// }


// // pass required logic to HW page :

// public function weekHW(Request $request)
// {
// // Get request parameters
// $week = $request->query('week');
// $section = $request->query('section');
// $isValidG = $request->query('isValidG');
// $now = 'week' . $week . 'sec' . $section;

// // Define the JSON file path
// $jsonFilePath = storage_path("apiHW/{$isValidG[0]}/HWAnswersApi.json");

// if (!file_exists($jsonFilePath)) {
// $type = "Home Work";
// return view('errorPages.examNotUploaded', compact('type'));
// }

// // Read and decode the JSON data
// $quizData = file_get_contents($jsonFilePath);
// $quizDataArray = json_decode($quizData, true);

// // Check if the specified key exists in the JSON data
// if (!array_key_exists($now, $quizDataArray) || !isset($quizDataArray[$now]['num'])) {
// $type = "Home Work";
// return view('errorPages.examNotUploaded', compact('type'));
// }

// // Get the number of questions
// $numQuestions = $quizDataArray[$now]['num'];

// // Define the image 'for' value
// $for = "HW{$isValidG[0]}({$now})";

// // Retrieve images from the database
// $images = HonerStudent::where('image_for', $for)->get();

// // Get the latest exam
// $currentExam = Select::latest()->first();

// return view('students.studentHW', compact('quizDataArray', 'numQuestions', 'images', 'currentExam', 'week',
'section', 'isValidG', 'now'));
// }

// public function weekExam(Request $request)
// {
// // start fo exam prepare :
// $week = $request->query('week');
// $section = $request->query('section');
// $isValidG = $request->query('isValidG');

// $now = 'week' . $week . 'sec' . $section;

// // Read the JSON data from the file
// $quizData = \file_get_contents(storage_path('api/' . substr($isValidG, 0, 1) . '/examAnswersApi.json'));

// // Decode the JSON data
// $quizDataArray = \json_decode($quizData, true);

// if (array_key_exists($now, $quizDataArray) && isset($quizDataArray[$now]['num'])) {
// $numQuestions = $quizDataArray[$now]['num'];
// // Use $numQuestions as needed
// } else {
// $type = "Exam";
// return view('errorPages.examNotUploaded', compact('type'));
// }

// // determine exam time from API :
// $timeExam = $quizDataArray[$now]['time'] * 60 * 1000;
// $for = substr($isValidG, 0, 1) . '(' . $now . ')';
// // 3(week4sec)

// $images = HonerStudent::where('image_for', $for)->get();
// // end of exam prepare.

// $currentExam = Select::latest()->first();

// return view('students.studentExam', compact('quizDataArray', 'numQuestions', 'timeExam', 'images', 'currentExam',
'week', 'section', 'isValidG', 'now'));
// }



// public function weekHW(Request $request)
// {
// // start fo exam prepare :
// $week = $request->query('week');
// $section = $request->query('section');
// $isValidG = $request->query('isValidG');

// $now = 'week' . $week . 'sec' . $section;

// // Read the JSON data from the file
// $quizData = \file_get_contents(storage_path('apiHW/' . substr($isValidG, 0, 1) . '/HWAnswersApi.json'));

// // Decode the JSON data
// $quizDataArray = \json_decode($quizData, true);

// // (calc success or fail) key from API :
// // $numQuestions = $quizDataArray[$now]['num'];

// if (array_key_exists($now, $quizDataArray) && isset($quizDataArray[$now]['num'])) {
// $numQuestions = $quizDataArray[$now]['num'];
// // Use $numQuestions as needed
// } else {
// $type = "Home Work";
// return view('errorPages.examNotUploaded', compact('type'));
// }

// // determine exam time from API :
// // $timeExam = $quizDataArray[$now]['time'] * 60 * 1000;
// $for = 'HW' . substr($isValidG, 0, 1) . '(' . $now . ')';
// // 3(week4sec)

// $images = HonerStudent::where('image_for', $for)->get();
// // end of exam prepare.

// $currentExam = Select::latest()->first();

// return view('students.studentHW', compact('quizDataArray', 'numQuestions', 'images', 'currentExam', 'week',
'section', 'isValidG', 'now'));
// }