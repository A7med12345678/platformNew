                    $examTotals[] = $examCount;
                    // single by id :
    // public function singleStudent(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'id' => 'required',
    //         'course' => 'required',
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    //     }

    //     $id = $request->input('id');
    //     $course = $request->input('course');


    //     $marks = exam::where('user_id', $id)
    //         ->where('user_grade', $course)
    //         ->where(function ($query) {
    //             for ($week = 1; $week <= 45; $week++) { // For simplicity, let's assume you only have data for 3 weeks
    //                 $column = "week{$week}sec4";
    //                 $query->orWhere($column, '<>', '#');
    //             }
    //         })
    //         ->first();


    //     if ($marks) {
    //         $data = [];
    //         $columnTotals = [];
    //         $totalExams = 45;

    //         for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
    //             $cumulativePercentage = 0;

    //             $column = "week{$examCount}sec4";
    //             $value = $marks->$column;

    //             if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
    //                 $numerator = intval($matches[1]);
    //                 $denominator = intval($matches[2]);
    //                 $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);

    //                 $data[$column] = $currentExamPercentage
    //                     // . "%"
    //                 ;

    //                 // Calculate cumulative percentage
    //                 $cumulativePercentage = array_sum(array_slice($data, 0, $examCount));

    //                 // Calculate cumulative average
    //                 $columnTotals[$column] = number_format($cumulativePercentage / $examCount, 1)
    //                     //  . '%'
    //                 ;
    //             }
    //         }
    //         // Now $data will contain cumulative percentages for 1, 2, 3, ..., 45 exams
    //         // $columnTotals contains the cumulative averages for each column    

    //         try {
    //             // $chart = $this->createColumnTotalsChart();

    //             // Generate PDF using TCPDF
    //             $pdf = new TCPDF();
    //             $pdf->SetCreator(PDF_CREATOR);
    //             $pdf->SetAuthor('Your Name');
    //             $pdf->SetTitle('Student Exam Results - ' . $id);

    //             // Add a page
    //             $pdf->AddPage('P', 'A4');

    //             // Set default font
    //             $pdf->SetFont('dejavusans', '', 10);

    //             // $labels = ['x', 'y', 'z'];
    //             // $dataNum = [20, 50, 200];

    //             // Render the view and pass $chartData to it
    //             $html = view('admin.pdf.pdfSingle', compact('marks', 'data', 'columnTotals'))->render();


    //             $pdf->writeHTML($html, true, false, true, false, '');

    //             // Generate a unique filename for the PDF
    //             $filename = $id . '_' . now()->format('Y-m-d_H-i-s') . '.pdf'; // Add .pdf extension

    //             // Save the PDF content as a string
    //             $pdfContent = $pdf->Output('', 'S');

    //             // Store the PDF file in the public directory
    //             $publicPath = storage_path('app/public/pdf/' . $filename);
    //             file_put_contents($publicPath, $pdfContent);

    //             // Return a success message and the file path to the form view
    //             $message = users::where('center_code', $id)->pluck('parent_phone')->first();


    //             // $previousUrl = url()->previous();
    //             // $previousRouteName = Route::getRoutes()->match(app('request')->create($previousUrl))->getName();
    //             // // dd($previousRouteName);

    //             // $toPage = 'defaultPage'; // Set a default page name
    //             // if ($previousRouteName === 'admin/report') {
    //             //     $toPage = 'admin.showChart';
    //             // } elseif ($previousRouteName === 'parentPDF') {
    //             //     $toPage = 'parentPdf';
    //             // }
    //             // return view($toPage)->with('message', $message)->with('downloadLink', $filename);


    //             return back()->with('message', $message)->with('downloadLink', $filename);

    //         } catch (\Exception $e) {
    //             // Handle PDF generation/storage exceptions
    //             return back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
    //         }
    //     } else {
    //         // Marks not found for the student. Return an error message.
    //         $errorMessage = 'Student marks not found.';
    //         return back()->with('flash_msg', $errorMessage);
    //     }
    // }


    // -------------------------------------------------------------------------
    // public function singleStudentChart(Request $request)
    // {
    //     try {

    //         $validator = Validator::make($request->all(), [
    //             'id' => 'required',
    //             'to' => 'required',
    //             'course' => 'required',
    //         ]);

    //         // Check if validation fails
    //         if ($validator->fails()) {
    //             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    //         }

    //         $id = $request->input('id');
    //         $course = $request->input('course');
    //         // $id = 565 ;

    //         $marks = exam::where('user_id', $id)
    //             ->where('user_grade', $course)
    //             ->where(function ($query) {
    //                 for ($week = 1; $week <= 45; $week++) { // For simplicity, let's assume you only have data for 3 weeks
    //                     $column = "week{$week}sec4";
    //                     $query->orWhere($column, '<>', '#');
    //                 }
    //             })
    //             ->first();


    //         if ($marks) {
    //             $data = [];
    //             // $columnTotals = [];
    //             $examTotals = [];
    //             $totalExams = 45;

    //             for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
    //                 // $cumulativePercentage = 0;
    //                 $examTotals[] = $examCount;
    //                 $column = "week{$examCount}sec4";
    //                 $value = $marks->$column;

    //                 if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
    //                     $numerator = intval($matches[1]);
    //                     $denominator = intval($matches[2]);
    //                     $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);

    //                     $data[] = $currentExamPercentage
    //                         // . "%"
    //                     ;

    //                     // // Calculate cumulative percentage
    //                     // $cumulativePercentage = array_sum(array_slice($data, 0, $examCount));

    //                     // // Calculate cumulative average
    //                     // $columnTotals[$column] = number_format($cumulativePercentage / $examCount, 1)
    //                     //     //  . '%'
    //                     // ;
    //                 }
    //             }


    //             // $labels = ['x', 'y', 'z'];
    //             // $dataNum = [20, 50, 200];

    //             $type = "Exam";
    //             // dd($request->input('to'));

    //             $previousUrl = url()->previous();
    //             $previousRouteName = Route::getRoutes()->match(app('request')->create($previousUrl))->getName();
    //             // dd($previousRouteName);

    //             $toPage = 'defaultPage'; // Set a default page name
    //             if ($previousRouteName === 'admin/report') {
    //                 $toPage = 'admin.showChart';
    //             } elseif ($previousRouteName === 'parentPDF') {
    //                 $toPage = 'parentChart';
    //             }
    //             return view($toPage, compact('examTotals', 'data', 'id', 'type'));


    //         }
    //     } catch (Exception $e) {
    //         // Handle exceptions here
    //         return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    //     }
    // }

    // public function singleStudentChartHW(Request $request)
    // {

    //     try {

    //         $validator = Validator::make($request->all(), [
    //             'id' => 'required',
    //             'course' => 'required',
    //         ]);

    //         // Check if validation fails
    //         if ($validator->fails()) {
    //             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    //         }

    //         $id = $request->input('id');
    //         $course = $request->input('course');
    //         // dd($course);
    //         // $id = 565 ;

    //         $marks = homework::where('user_id', $id)
    //             ->where('user_grade', $course)
    //             ->where(function ($query) {
    //                 for ($week = 1; $week <= 45; $week++) { // For simplicity, let's assume you only have data for 3 weeks
    //                     $column = "week{$week}sec3h";
    //                     $query->orWhere($column, '<>', '#');
    //                 }
    //             })
    //             ->first();

    //         // dd($marks);

    //         if ($marks) {
    //             $data = [];
    //             // $columnTotals = [];
    //             $examTotals = [];
    //             $totalExams = 45;

    //             for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
    //                 // $cumulativePercentage = 0;
    //                 $examTotals[] = $examCount;
    //                 $column = "week{$examCount}sec3h";
    //                 $value = $marks->$column;

    //                 if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
    //                     $numerator = intval($matches[1]);
    //                     $denominator = intval($matches[2]);
    //                     $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);

    //                     $data[] = $currentExamPercentage
    //                         // . "%"
    //                     ;

    //                     // // Calculate cumulative percentage
    //                     // $cumulativePercentage = array_sum(array_slice($data, 0, $examCount));

    //                     // // Calculate cumulative average
    //                     // $columnTotals[$column] = number_format($cumulativePercentage / $examCount, 1)
    //                     //     //  . '%'
    //                     // ;
    //                 }
    //             }


    //             // $labels = ['x', 'y', 'z'];
    //             // $dataNum = [20, 50, 200];
    //             $type = "Home Work";

    //             $previousUrl = url()->previous();
    //             $previousRouteName = Route::getRoutes()->match(app('request')->create($previousUrl))->getName();
    //             // dd($previousRouteName);

    //             $toPage = 'defaultPage'; // Set a default page name
    //             if ($previousRouteName === 'admin/report') {
    //                 $toPage = 'admin.showChart';
    //             } elseif ($previousRouteName === 'parentPDF') {
    //                 $toPage = 'parentChart';
    //             }
    //             return view($toPage, compact('examTotals', 'data', 'id', 'type'));


    //             // return view('admin.showChart', compact('examTotals', 'data', 'id', 'type'));

    //         }
    //     } catch (Exception $e) {
    //         // Handle exceptions here
    //         return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    //     }


    // }

    // public function generateStudentChart(Request $request, $reportType)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'id' => 'required',
    //             'course' => 'required',
    //         ]);

    //         // Check if validation fails
    //         if ($validator->fails()) {
    //             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    //         }

    //         $id = $request->input('id');
    //         $course = $request->input('course');
    //         $table = '';
    //         $columnPrefix = '';

    //         if ($reportType === 'exam') {
    //             $table = 'exams';
    //             $columnPrefix = 'sec4';
    //         } elseif ($reportType === 'homework') {
    //             $table = 'homework';
    //             $columnPrefix = 'sec3h';
    //         } else {
    //             return response()->json(['message' => 'Invalid report type'], 400);
    //         }

    //         $marks = DB::table($table)
    //             ->where('user_id', $id)
    //             ->where('user_grade', $course)
    //             ->where(function ($query) use ($columnPrefix) {
    //                 for ($week = 1; $week <= 45; $week++) {
    //                     $column = "week{$week}{$columnPrefix}";
    //                     $query->orWhere($column, '<>', '#');
    //                 }
    //             })
    //             ->first();

    //         if ($marks) {
    //             $data = [];
    //             $examTotals = [];
    //             $totalExams = 45;

    //             for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
    //                 $examTotals[] = $examCount;
    //                 $column = "week{$examCount}{$columnPrefix}";
    //                 $value = $marks->$column;

    //                 if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
    //                     $numerator = intval($matches[1]);
    //                     $denominator = intval($matches[2]);
    //                     $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);

    //                     $data[] = $currentExamPercentage;
    //                 }
    //             }

    //             $type = ($reportType === 'exam') ? "Exam" : "Home Work";

    //             $previousUrl = url()->previous();
    //             $previousRouteName = Route::getRoutes()->match(app('request')->create($previousUrl))->getName();
    //             $toPage = 'defaultPage'; // Set a default page name

    //             if ($previousRouteName === 'admin/report') {
    //                 $toPage = 'admin.showChart';
    //             } elseif ($previousRouteName === 'parentPDF') {
    //                 $toPage = 'parentChart';
    //             }

    //             return view($toPage, compact('examTotals', 'data', 'id', 'type'));
    //         }
    //     } catch (Exception $e) {
    //         // Handle exceptions here
    //         return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    //     }
    // }


    // one exam for one grade
    // public function singleGrade(Request $request)
    // {
    //     try {
    //         $id = $request->input('grade');
    //         $exam = 'week' . $request->input('exam') . 'sec4';

    //         // Fetch the marks using Eloquent
    //         $marks = exam::select('user_name', $exam)
    //             ->where('user_grade', $id)
    //             ->where($exam, '<>', '#')
    //             ->get();

    //         $pdf = new TCPDF();
    //         $pdf->SetCreator(PDF_CREATOR);
    //         // $pdf->SetAuthor('Your Name');
    //         // $pdf->SetTitle('Exam Grade PDF');
    //         // $pdf->SetSubject('Exam Grade Report');
    //         $pdf->AddPage('P', 'A4');
    //         $pdf->SetFont('dejavusans', '', 12); // Use a Unicode font that supports Arabic, like 'dejavusans'
    //         $pdf->SetDrawColor(0, 0, 0); // Red border color

    //         // Output content
    //         $html = view('admin.pdf.pdfGrade', compact('marks', 'exam', 'id'))->render();
    //         $pdf->writeHTML($html, true, false, true, false, '');

    //         // Set the filename for the download
    //         $filename = $id . '.pdf';

    //         // Generate the PDF and force download
    //         $pdf->Output($filename, 'D');

    //     } catch (\Exception $e) {
    //         // Handle exceptions
    //         return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
    //     }
    // }


    // //  all exam sheet for grade :
    // public function allGrades(Request $request)
    // {
    //     try {

    //         $id = $request->input('sec');
    //         $marks = exam::where('user_grade', $id)->get();


    //         // Create a new TCPDF instance
    //         $pdf = new TCPDF();

    //         // Set document information
    //         $pdf->SetCreator(PDF_CREATOR);
    //         $pdf->SetAuthor('Your Name');
    //         $pdf->SetTitle('Exam Results');

    //         // Add a page
    //         $pdf->AddPage('L', 'A4');

    //         // Set font
    //         $pdf->SetFont('dejavusans', '', 12); // Use a Unicode font that supports Arabic, like 'dejavusans'

    //         // Output content
    //         $html = view('admin.pdf.allGrades', compact('marks'))->render();
    //         $pdf->writeHTML($html, true, false, true, false, '');

    //         // Output the PDF
    //         $filename = 'all.pdf';
    //         return response($pdf->Output($filename, 'D'))
    //             ->header('Content-Type', 'application/pdf');
    //     } catch (\Exception $e) {
    //         // Handle exceptions
    //         return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
    //     }
    // }


    // zip file :
    // public function groupStudent(Request $request)
    // {
    //     try {
    //         $grade = $request->input('sec');
    //         $mark = exam::where('user_grade', $grade)->get();

    //         if ($mark->isEmpty()) {
    //             return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ');
    //         }

    //         $customPaper = array(0, 0, 820, 1040);
    //         $zipFilename = 'Grade_' . $grade . '_Students_' . time() . '.zip';

    //         $zip = new ZipArchive();

    //         if ($zip->open($zipFilename, ZipArchive::CREATE) !== true) {
    //             return redirect()->back()->with('flash_msg', 'Failed to generate PDF ZIP : ');
    //         }

    //         foreach ($mark as $marks) {
    //             $pdf = PDF::loadView('admin.pdf.pdfSingle', compact('marks'))->setPaper($customPaper, 'landscape');
    //             $pdfContent = $pdf->output();

    //             $zip->addFromString('Grade_' . $grade . '_Student_' . $marks->user_id . '.pdf', $pdfContent);
    //         }

    //         $zip->close();

    //         return response()->download($zipFilename)->deleteFileAfterSend(true);
    //     } catch (\Exception $e) {

    //         // Return an appropriate response indicating an error occurred
    //         return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
    //     }
    // }




    
// if ($marks) {
//     $data = [];
//     $columnTotals = []; // Initialize an array to store the cumulative averages for each column

//     // Loop through the columns and extract and process the data
//     for ($examCount = 1; $examCount <= 45; $examCount++) {
//         $cumulativePercentage = 0;

//         for ($week = 1; $week <= $examCount; $week++) {
//             $column = "week{$week}sec4";
//             $value = $marks->$column;

//             // Check if the value matches the pattern num1/num2
//             if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
//                 $num1 = intval($matches[1]);
//                 $num2 = intval($matches[2]);
//                 $now_exam = $num1 / $num2;
//                 $current_exam = number_format(($now_exam) * 100, 1);

//                 // Store the values in the format num1,num2
//                 $data[$column] = $current_exam . "%";

//                 // Calculate cumulative percentage for this column
//                 $cumulativePercentage += ($now_exam);

//                 // Calculate the cumulative average for this column
//                 $columnTotals[$column] = number_format($cumulativePercentage / $week * 100, 1) . '%';
//             }
//         }
//     }

//     // Now $data will contain cumulative percentages for 1, 2, 3, ..., 45 exams
//     // $columnTotals contains the cumulative averages for each column
// }



// get Statistics about exams : 
    // public function sumExams(Request $request)
    // {
    //     // Validate the form input
    //     // $request->validate([
    //     //     'sec' => 'required|integer|min:1|max:45', // Assuming the input name is 'sec'
    //     // ]);

    //     $from = $request->input('from');
    //     // $from = 2;
    //     $numExamsToSum = $request->input('to');

    //     // $numExamsToSum = 4;
    //     $order = $request->input('order');
    //     // $order = "DESC";
    //     $num = $request->input('num');
    //     // dd( $num , var_dump($num)); 
    //     // $num = 10;
    //     $grade = $request->input('grade');
    //     // dd($grade , $from , $numExamsToSum , $order , $numExamsToSum);


    //     // Construct the SQL query based on the selected number of exams to sum
    //     $columnsToSum = [];
    //     for ($i = $from; $i <= $numExamsToSum; $i++) {
    //         $columnsToSum[] = "week{$i}sec4";
    //     }

    //     // Join the selected columns using '+'
    //     $columnsToSum = implode(' + ', $columnsToSum);

    //     // Execute the SQL query
    //     $results = DB::table('exam')
    //         ->select('user_id', 'user_name', DB::raw("SUM(CAST(SUBSTRING_INDEX({$columnsToSum}, '/', 1) AS UNSIGNED)) AS total"))
    //         ->where('user_grade', $grade)
    //         ->groupBy('user_id', 'user_name')
    //         ->orderBy('total', $order)
    //         ->limit($num)
    //         ->get();

    //     // dd($results);
    //     return redirect()->back()->with('results', $results);


    // }

    // public function sumExamsHW(Request $request)
    // {
    //     // Validate the form input
    //     // $request->validate([
    //     //     'sec' => 'required|integer|min:1|max:45', // Assuming the input name is 'sec'
    //     // ]);

    //     $from = $request->input('from');
    //     // $from = 2;
    //     $numExamsToSum = $request->input('to');

    //     // $numExamsToSum = 4;
    //     $order = $request->input('order');
    //     // $order = "DESC";
    //     $num = $request->input('num');
    //     $grade = $request->input('grade');
    //     // $num = 10;

    //     // Construct the SQL query based on the selected number of exams to sum
    //     $columnsToSum = [];
    //     for ($i = $from; $i <= $numExamsToSum; $i++) {
    //         $columnsToSum[] = "week{$i}sec3h";
    //     }

    //     // Join the selected columns using '+'
    //     $columnsToSum = implode(' + ', $columnsToSum);

    //     // Execute the SQL query
    //     $results = DB::table('homework')
    //         ->select('user_id', 'user_name', DB::raw("SUM(CAST(SUBSTRING_INDEX({$columnsToSum}, '/', 1) AS UNSIGNED)) AS total"))
    //         ->where('user_grade', '=', $grade)
    //         ->groupBy('user_id', 'user_name')
    //         ->orderBy('total', $order)
    //         ->limit($num)
    //         ->get();

    //     // dd($results);
    //     return redirect()->back()->with('results', $results);


    // }