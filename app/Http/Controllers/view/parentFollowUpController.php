<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use TCPDF;


class parentFollowUpController extends Controller
{

    // -------------------------------- Parent Reports : --------------------------------------

    public function parentGet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }

        $id = $request->input('id');
        // $id = 565 ;

        $marks = Exam::where('user_id', $id)
            ->where(function ($query) {
                for ($week = 1; $week <= 45; $week++) { // For simplicity, let's assume you only have data for 3 weeks
                    $column = "week{$week}sec4";
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

                $column = "week{$examCount}sec4";
                $value = $marks->$column;

                if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
                    $numerator = intval($matches[1]);
                    $denominator = intval($matches[2]);
                    $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);

                    $data[$column] = $currentExamPercentage;
                    $cumulativePercentage = array_sum(array_slice($data, 0, $examCount));
                    $columnTotals[$column] = number_format($cumulativePercentage / $examCount, 1);
                }
            }

            try {
                // Generate PDF using TCPDF
                $pdf = new TCPDF();
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Your Name');
                $pdf->SetTitle('Student Exam Results - ' . $id);

                // Add a page
                $pdf->AddPage('P', 'A4');

                // Set default font
                $pdf->SetFont('dejavusans', '', 10);

                // Render the view and pass $chartData to it
                $html = view('admin.pdf.pdfSingle', compact('marks', 'data', 'columnTotals'))->render();

                $pdf->writeHTML($html, true, false, true, false, '');

                // Generate a unique filename for the PDF
                $filename = $id . '_' . now()->format('Y-m-d_H-i-s') . '.pdf'; // Add .pdf extension

                // Store the PDF content as a string
                $pdfContent = $pdf->Output('', 'S');

                // Define the full path to the generated PDF file
                $filePath = storage_path('app/public/pdf/' . $filename);

                // Save the PDF content to the file
                file_put_contents($filePath, $pdfContent);

                // Set a success message in the session
                $message = user::where('center_code', $id)->pluck('parent_phone')->first();
                $request->session()->flash('message', $message);

                // Return the PDF file as a download response
                return response()->download($filePath, $filename, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                ]);
            } catch (\Exception $e) {
                // Handle PDF generation/storage exceptions
                return back()->with('flash_msg', 'Failed to generate PDF: ' . $e->getMessage());
            }
        } else {
            // Marks not found for the student. Return an error message.
            $errorMessage = 'Student marks not found.';
            return back()->with('flash_msg', $errorMessage);
        }


    }

    // ------------------------------------- private functions ------------------------ : 

    private function generateExamTotals($totalExams)
    {
        $examTotals = [];

        for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
            $examTotals[] = $examCount;
        }

        return $examTotals;
    }

    private function processMarks($marks, $weekPrefix, $columnSuffix, $totalExams = 45)
    {
        $data = [];

        for ($examCount = 1; $examCount <= $totalExams; $examCount++) {
            $column = "{$weekPrefix}{$examCount}{$columnSuffix}";
            $value = $marks->$column;

            if (preg_match('/(\d+)\/(\d+)/', $value, $matches)) {
                $numerator = intval($matches[1]);
                $denominator = intval($matches[2]);
                $currentExamPercentage = number_format(($numerator / $denominator) * 100, 1);
                $data[] = $currentExamPercentage;
            }
        }

        return $data;
    }
}
