<?php

namespace App\Http\Controllers;

use App\Models\homework;
use App\Models\exam;
use App\Models\User as users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use TCPDF;
use ZipArchive;
use Exception;

class pdfGenerate extends Controller
{

    public function reportPage()
    {
        return view('admin.report');
    }

    // single student pdf (hw , exam) : 

    public function singleStudent(Request $request)
    {
        return $this->generateStudentReport($request, 'exam');
    }

    public function singleStudentHW(Request $request)
    {
        return $this->generateStudentReport($request, 'homework');
    }

    private function generateStudentReport(Request $request, $type)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'course' => 'required',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
            }

            $id = $request->input('id');
            $course = $request->input('course');

            if ($type === 'exam') {
                $table = 'exam';
                $columnPrefix = 'sec4';
            } elseif ($type === 'homework') {
                $table = 'homework';
                $columnPrefix = 'sec3h';
            } else {
                return response()->json(['message' => 'Invalid report type'], 400);
            }

            $marks = DB::table($table)
                ->where('user_id', $id)
                // ->where('user_grade', $course)
                ->where(function ($query) use ($columnPrefix) {
                    for ($week = 1; $week <= 45; $week++) {
                        $column = "week{$week}{$columnPrefix}";
                        $query->orWhere($column, '<>', '#');
                    }
                })
                ->first();

            if ($marks) {
                $data = [];
                $columnTotals = [];
                $totalExams = 45;

                for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
                    $cumulativePercentage = 0;

                    $column = "week{$examCount}{$columnPrefix}";
                    $value = $marks->$column;

                    if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
                        $numerator = intval($matches[1]);
                        $denominator = intval($matches[2]);
                        $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);

                        $data[$column] = $currentExamPercentage;

                        // Calculate cumulative percentage
                        $cumulativePercentage = array_sum(array_slice($data, 0, $examCount));

                        // Calculate cumulative average
                        $columnTotals[$column] = number_format($cumulativePercentage / $examCount, 1);
                    }
                }

                // Generate PDF using TCPDF
                $pdf = new TCPDF();
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Your Name');
                $pdf->SetTitle('Student ' . ucfirst($type) . ' Results - ' . $id);

                // Add a page
                $pdf->AddPage('P', 'A4');

                // Set default font
                $pdf->SetFont('dejavusans', '', 10);

                // Output content
                $pdfView = 'admin.pdf.pdfSingle'; // Default PDF view for exams
                if ($type === 'homework') {
                    $pdfView = 'admin.pdfHW.pdfSingleHW';
                }

                $html = view($pdfView, compact('marks', 'data', 'columnTotals'))->render();
                $pdf->writeHTML($html, true, false, true, false, '');

                // Generate a unique filename for the PDF
                $filename = $id . '_' . now()->format('Y-m-d_H-i-s') . '.pdf';

                // Save the PDF content as a string
                $pdfContent = $pdf->Output('', 'S');

                // Store the PDF file in the public directory
                $storagePath = 'app/public/pdf/';
                if ($type === 'homework') {
                    $storagePath = 'app/public/HW/';
                }
                $publicPath = storage_path($storagePath . $filename);
                file_put_contents($publicPath, $pdfContent);

                // Return a success message and the file path to the form view
                $message = users::where('center_code', $id)->pluck('parent_phone')->first();
                // return back()->with('message', $message)->with('downloadLink', $filename);
                return view('admin.reportResponse', compact('filename' , 'message'));

            } else {
                // Marks not found for the student. Return an error message.
                $errorMessage = 'Student marks not found.';
                return back()->with('flash_msg', $errorMessage);
            }
        } catch (\Exception $e) {
            // Handle PDF generation/storage exceptions
            return back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
        }

    }

    // single student chart (hw , exam) : 

    public function singleStudentChart(Request $request)
    {
        return $this->generateStudentChart($request, 'exam');
    }

    public function singleStudentChartHW(Request $request)
    {
        return $this->generateStudentChart($request, 'homework');
    }

    private function generateStudentChart(Request $request, $type)
    {

        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'course' => 'required',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
            }

            $id = $request->input('id');
            $course = $request->input('course');
            $columnPrefix = ($type === 'exam') ? 'sec4' : 'sec3h';

            $marks = ($type === 'exam') ? exam::where('user_id', $id) : homework::where('user_id', $id);
            $marks = $marks
                ->where('user_grade', $course)
                ->where(function ($query) use ($columnPrefix) {
                    for ($week = 1; $week <= 45; $week++) {
                        $column = "week{$week}{$columnPrefix}";
                        $query->orWhere($column, '<>', '#');
                    }
                })
                ->first();

            if ($marks) {
                $data = [];
                $examTotals = [];
                $totalExams = 45;

                for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
                    $examTotals[] = $examCount;
                    $column = "week{$examCount}{$columnPrefix}";
                    $value = $marks->$column;
                    // dd($value);
                    if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
                        $numerator = intval($matches[1]);
                        $denominator = intval($matches[2]);
                        $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);
                        // dd($numerator , $denominator , $currentExamPercentage);
                        $data[] = $currentExamPercentage;
                    }
                }
                // dd($examTotals);
                $type = ($type === 'exam') ? "Exam" : "Home Work";

                $previousUrl = url()->previous();
                $previousRouteName = Route::getRoutes()->match(app('request')->create($previousUrl))->getName();

                $toPage = 'defaultPage'; // Set a default page name
                if ($previousRouteName === 'admin/report') {
                    $toPage = 'admin.showChart';
                } elseif ($previousRouteName === 'parentPDF') {
                    $toPage = 'parentChart';
                }
                // dd($examTotals, $data , $id , $type);
                return view($toPage, compact('examTotals', 'data', 'id', 'type'));
            }
        } catch (Exception $e) {
            // Handle exceptions here
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    // single grade pdf (hw , exam) : 

    public function singleGradeHW(Request $request)
    {
        return $this->singleGradeGeneral($request, 'homework');
    }

    public function singleGrade(Request $request)
    {
        return $this->singleGradeGeneral($request, 'exam');
    }

    private function singleGradeGeneral(Request $request, $type)
    {
        try {

            $id = $request->input('grade');
            $examPrefix = ($type === 'exam') ? 'sec4' : 'sec3h';
            $exam = 'week' . $request->input('exam') . $examPrefix;

            // Determine the table name based on the type
            $tableName = ($type === 'exam') ? 'exam' : 'homework';

            // Fetch the marks using DB query
            $marks = DB::table($tableName)
                ->select('user_name', $exam)
                ->where('user_grade', $id)
                ->where($exam, '<>', '#')
                ->get();

            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('dejavusans', '', 12); // Use a Unicode font that supports Arabic, like 'dejavusans'
            $pdf->SetDrawColor(0, 0, 0); // Red border color

            // Output content
            $viewName = ($type === 'exam') ? 'admin.pdf.pdfGrade' : 'admin.pdfHW.pdfGradeHW';
            $html = view($viewName, compact('marks', 'exam', 'id'))->render();
            $pdf->writeHTML($html, true, false, true, false, '');

            // Set the filename for the download
            $filename = $id . '(' . $type . ')' . '.pdf';

            // Generate the PDF and force download
            $pdf->Output($filename, 'D');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }


     // all grades pdf (hw , exam) : 

    public function allGrades(Request $request)
    {
        return $this->generateAllGradesPDF($request, 'exam');
    }
    
    public function allGradesHW(Request $request)
    {
        return $this->generateAllGradesPDF($request, 'homework');
    }

    private function generateAllGradesPDF(Request $request, $type)
    {
        try {
            $id = $request->input('sec');
            
            // Determine the model and view name based on the type
            $model = ($type === 'exam') ? 'exam' : 'homework';
            $viewName = ($type === 'exam') ? 'admin.pdf.allGrades' : 'admin.pdfHW.allGradesHW';
    
            // Fetch the marks using DB query
            $marks = DB::table($model)
            ->where('user_grade', $id)
            ->get();    

            // Create a new TCPDF instance
            $pdf = new TCPDF();
    
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Exam Results');
    
            // Add a page
            $pdf->AddPage('L', 'A4');
    
            // Set font
            $pdf->SetFont('dejavusans', '', 12); // Use a Unicode font that supports Arabic, like 'dejavusans'
    
            // Output content
            $html = view($viewName, compact('marks'))->render();
            $pdf->writeHTML($html, true, false, true, false, '');
    
            // Output the PDF
            $filename = 'all' . '(' .$type . ')' .'.pdf';
            return response($pdf->Output($filename, 'D'))
                ->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }
    
    
    // zip file : 

    public function groupStudent(Request $request)
    {
        return $this->generateGroupStudentPDF($request, 'exam');
    }
    
    public function groupStudentHW(Request $request)
    {
        return $this->generateGroupStudentPDF($request, 'homework');
    }
    
    private function generateGroupStudentPDF(Request $request, $type)
{
    try {
        $grade = $request->input('sec');
        
        // Determine the model and view name based on the type
        $model = ($type === 'exam') ? 'exam' : 'homework';
        $viewName = ($type === 'exam') ? 'admin.pdf.pdfSingle' : 'admin.pdfHW.pdfSingleHW';


           // Fetch the marks using DB query
           $mark = DB::table($model)
           ->where('user_grade', $grade)
           ->get();    

        if ($mark->isEmpty()) {
            return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ');
        }

        $customPaper = array(0, 0, 820, 1040);
        $zipFilename = 'Grade_' . $grade . '_Students_' . time() . '.zip';

        $zip = new ZipArchive();

        if ($zip->open($zipFilename, ZipArchive::CREATE) !== true) {
            return redirect()->back()->with('flash_msg', 'Failed to generate PDF ZIP : ');
        }

        foreach ($mark as $marks) {
            $pdf = PDF::loadView($viewName, compact('marks'))->setPaper($customPaper, 'landscape');
            $pdfContent = $pdf->output();

            $zip->addFromString('Grade_' . $grade . '_Student_' . $marks->user_id . '.pdf', $pdfContent);
        }

        $zip->close();

        return response()->download($zipFilename)->deleteFileAfterSend(true);
    } catch (\Exception $e) {
        // Handle exceptions
        return redirect()->back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
    }
}

}



