<?php

namespace App\Http\Controllers;


use App\Models\exam;
use App\Models\homework;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use TCPDF;
use App\Models\User as users;
use ZipArchive;
use Exception;


class pdfGenerateHW extends Controller
{
    // single by id :
    // public function singleStudentHW(Request $request)
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


    //     $marks = homework::where('user_id', $id)
    //         ->where('user_grade', $course)
    //         ->where(function ($query) {
    //             for ($week = 1; $week <= 45; $week++) {
    //                 $column = "week{$week}sec3h";
    //                 $query->orWhere($column, '<>', '#');
    //             }
    //         })
    //         ->first();


    //     $data = [];
    //     $columnTotals = [];
    //     $totalExams = 45;

    //     for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
    //         $cumulativePercentage = 0;

    //         $column = "week{$examCount}sec3h";
    //         $value = $marks->$column;

    //         if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
    //             $numerator = intval($matches[1]);
    //             $denominator = intval($matches[2]);
    //             $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);

    //             $data[$column] = $currentExamPercentage
    //                 // . "%"
    //             ;

    //             // Calculate cumulative percentage
    //             $cumulativePercentage = array_sum(array_slice($data, 0, $examCount));

    //             // Calculate cumulative average
    //             $columnTotals[$column] = number_format($cumulativePercentage / $examCount, 1)
    //                 //  . '%'
    //             ;
    //         }
    //     }


    //     // 


    //     if ($marks) {
    //         try {
    //             // Generate PDF using TCPDF
    //             $pdf = new TCPDF();
    //             $pdf->SetCreator(PDF_CREATOR);
    //             $pdf->SetAuthor('Your Name');
    //             $pdf->SetTitle('Student Home Work Results - ' . $id);

    //             // Add a page
    //             $pdf->AddPage('P', 'A4');

    //             // Set default font
    //             $pdf->SetFont('dejavusans', '', 10);

    //             // Output content
    //             $html = view('admin.pdfHW.pdfSingleHW', compact('marks', 'data', 'columnTotals'))->render();
    //             $pdf->writeHTML($html, true, false, true, false, '');

    //             // Generate a unique filename for the PDF
    //             $filename = $id . '_' . now()->format('Y-m-d_H-i-s') . '.pdf'; // Add .pdf extension

    //             // Save the PDF content as a string
    //             $pdfContent = $pdf->Output('', 'S');

    //             // Store the PDF file in the public directory
    //             // $publicPath = storage_path('HW/' . $filename);
    //             $publicPath = storage_path('app/public/HW/' . $filename);

    //             file_put_contents($publicPath, $pdfContent);

    //             // Return a success message and the file path to the form view
    //             $message = users::where('center_code', $id)->pluck('parent_phone')->first();
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

    // // one exam for one grade
    // public function singleGradeHW(Request $request)
    // {
    //     try {
    //         $id = $request->input('grade');
    //         $exam = 'week' . $request->input('exam') . 'sec3h';
    //         // dd($id , $exam);
    //         // Fetch the marks using Eloquent
    //         $marks = homework::select('user_name', $exam)
    //             ->where('user_grade', $id)
    //             ->where($exam, '<>', '#')
    //             ->get();
    //         // dd($marks);
    //         $pdf = new TCPDF();
    //         $pdf->SetCreator(PDF_CREATOR);
    //         // $pdf->SetAuthor('Your Name');
    //         // $pdf->SetTitle('Exam Grade PDF');
    //         // $pdf->SetSubject('Exam Grade Report');
    //         $pdf->AddPage('P', 'A4');
    //         $pdf->SetFont('dejavusans', '', 12); // Use a Unicode font that supports Arabic, like 'dejavusans'
    //         $pdf->SetDrawColor(0, 0, 0); // Red border color

    //         // Output content
    //         $html = view('admin.pdfHW.pdfGradeHW', compact('marks', 'exam', 'id'))->render();
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
    // public function allGradesHW(Request $request)
    // {
    //     try {

    //         $id = $request->input('sec');
    //         $marks = homework::where('user_grade', $id)->get();
           

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
    //         $html = view('admin.pdfHW.allGradesHW', compact('marks'))->render();
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


    // // zip file :
    // public function groupStudentHW(Request $request)
    // {
    //     try {
    //         $grade = $request->input('sec');
    //         $mark = homework::where('user_grade', $grade)->get();

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
    //             $pdf = PDF::loadView('admin.pdfHW.pdfSingleHW', compact('marks'))->setPaper($customPaper, 'landscape');
    //             $pdfContent = $pdf->output();

    //             $zip->addFromString('Grade_' . $grade . '_Student_' . $marks->user_id . '.pdf', $pdfContent);
    //         }

    //         $zip->close();

    //         return response()->download($zipFilename)->deleteFileAfterSend(true);
    //     } catch (\Exception $e) {

    //         // Return an appropriate response indicating an error occurred
    //         return back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
    //     }
    // }

}