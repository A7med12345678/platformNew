<?php

namespace App\Http\Controllers;

use App\Helpers\UploadImage;
use App\Models\dashboardChange;
use App\Models\HonerStudent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{

    public function video_upload(Request $request)
    {
        try {
            // dd($request->grade);
            // Validation
            $request->validate([
                'video_title' => 'required',
                'video' => 'required|file',
                'chunkIndex' => 'required|integer',
                'totalChunks' => 'required|integer',
            ]);
            info($request);

            $file = $request->file('video');
            $grade = $request->input('grade');

            $week = $request->input('week');
            $sec = $request->input('sec');

            $chunkIndex = $request->input('chunkIndex');
            $totalChunks = $request->input('totalChunks');
            $originalExtension = $file->getClientOriginalExtension();


            if ($grade === "free") {

                $filename = 'free.mp4';
                $chunkFilename = 'chunk_' . $chunkIndex . '_' . $filename;
                // Save the chunk
                Storage::disk('local')->put('temp/' . $chunkFilename, file_get_contents($file));
                // If this is the last chunk, combine all the chunks into a single file
                if ($chunkIndex == $totalChunks - 1) {
                    info(['totalChunks' => $totalChunks]);
                    $this->combineChunks($filename, $totalChunks, $grade);
                }

                return response()->json(['status' => 'success', 'path' => $request->video_title . '.mp4']);

            } else {
                $filename = $week . $sec . '.mp4';
                $chunkFilename = 'chunk_' . $chunkIndex . '_' . $filename;

                // Save the chunk
                Storage::disk('local')->put('temp/' . $chunkFilename, file_get_contents($file));
                // If this is the last chunk, combine all the chunks into a single file
                if ($chunkIndex == $totalChunks - 1) {
                    info(['totalChunks' => $totalChunks]);
                    $this->combineChunks($filename, $totalChunks, $grade);
                }

                return response()->json(['status' => 'success', 'path' => $request->video_title . '.mp4']);
            }
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Error in video_upload: " . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function combineChunks($filename, $totalChunks, $grade)
    {
        try {
            // Define the directory based on the grade
            if ($grade === "free") {
                $directory = storage_path('app/public/free/video/');

                // Check if the directory exists
                if (is_dir($directory)) {
                    // Open the directory
                    if ($dirHandle = opendir($directory)) {
                        while (false !== ($file = readdir($dirHandle))) {
                            // Skip the special entries "." and ".."
                            if ($file != "." && $file != "..") {
                                $filePath = $directory . '/' . $file;

                                // Check if it's a file and delete it
                                if (is_file($filePath)) {
                                    unlink($filePath);
                                }
                            }
                        }
                        closedir($dirHandle);
                    }
                } else {
                    // Handle the case where the directory doesn't exist
                    // You can log an error or perform other actions as needed.
                }
            } else {
                // If grade is not "free," set the directory to the appropriate location
                $directory = storage_path('app/public/videos/' . $grade);
            }

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Rest of the code for combining chunks remains the same

            $filePath = $directory . '/' . $filename;

            $handle = fopen($filePath, 'wb');

            if (!$handle) {
                throw new \Exception("Could not open file for writing: " . $filename);
            }

            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkFilename = 'chunk_' . $i . '_' . $filename;
                $chunkPath = storage_path('app/temp/' . $chunkFilename);

                if (!file_exists($chunkPath)) {
                    throw new \Exception("Chunk not found: " . $chunkFilename);
                }

                fwrite($handle, file_get_contents($chunkPath));
                unlink($chunkPath); // Delete the chunk
            }

            fclose($handle);
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Error in combineChunks: " . $e->getMessage());

            throw $e; // Re-throw the exception to be caught in the calling method
        }
    }


    // public function uploadWeekSec(Request $request)
    // {
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');

    //         // Determine the directory path within the storage directory
    //         $directory = 'uploads/chunked-videos';

    //         // Use the storage disk to store the file
    //         $path = Storage::disk('local')->putFile($directory, $file);

    //         // Return a response indicating success
    //         return response()->json(['message' => 'File uploaded successfully', 'path' => $path]);
    //     }

    //     return response()->json(['error' => 'No file selected.'], 400);
    // }

    // exam questions (admin --> Exam : Upload)
    public function uploadExamQ(Request $request)
    {
        // Validate the uploaded images
        $request->validate([
            // Validation rules here...
        ]);

        // Get the user's grade and exam number
        $userGrade = $request->input('grade');
        $examNum = $request->input('examNum');
        $image_for = $userGrade . '(' . $examNum . ')';

        // Check if there are uploaded images
        if ($request->hasFile("images")) {
            // Delete existing records with the same image_for value
            $deletedRows = HonerStudent::where('image_for', $image_for)->delete();

            // Delete existing files with the same image_for value
            $files = Storage::allFiles('public/photos/' . $userGrade . '/' . $examNum);
            Storage::delete($files);

            // Upload and store new image files
            foreach ($request->file("images") as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $imagePath = 'photos/' . $userGrade . '/' . $examNum;
                $file->storeAs($imagePath, $imageName, 'public');

                // Create a new record in the HonerStudent model
                HonerStudent::create([
                    'image' => $imageName,
                    'image_for' => $image_for,
                ]);
            }

            // Redirect back with a success message
            return redirect()->back()->with('flash_msg', 'Exam Questions added successfully!');
        }

        // Return a response if there are no images
        return redirect()->back()->with('flash_msg', 'No images uploaded!');
    }

    public function uploadExamHW(Request $request)
    {
        // Validate the uploaded images
        $request->validate([
            // Validation rules here...
        ]);

        // Get the user's grade and exam number
        $userGrade = $request->input('grade');
        $HWNum = $request->input('HWNum');
        $image_for = 'HW' . $userGrade . '(' . $HWNum . ')';

        // Check if there are uploaded images
        if ($request->hasFile("images")) {
            // Delete existing records with the same image_for value
            $deletedRows = HonerStudent::where('image_for', $image_for)->delete();

            // Delete existing files with the same image_for value
            $files = Storage::allFiles('public/photos-HW/' . $userGrade . '/' . $HWNum);
            Storage::delete($files);

            // Upload and store new image files
            foreach ($request->file("images") as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $imagePath = 'photos-HW/' . $userGrade . '/' . $HWNum;
                $file->storeAs($imagePath, $imageName, 'public');

                // Create a new record in the HonerStudent model
                HonerStudent::create([
                    'image' => $imageName,
                    'image_for' => $image_for,
                ]);
            }

            // Redirect back with a success message
            return redirect()->back()->with('flash_msg', 'Home Work Questions added successfully!');
        }

        // Return a response if there are no images
        return redirect()->back()->with('flash_msg', 'No images uploaded!');
    }

    public function storePDF(Request $request)
    {
        $grade = $request->input('grade');
        $week = $request->input('week');

        try {
            // $path = UploadImage::storePDF($request, 'pdf', $week, $grade);
            $path = UploadImage::generalUpload($request, 'SepartePdfWeek/' . $grade . '/' . $week . '/', 'pdf', true, $week);

            // 
            return redirect()->back()->with('flash_msg', "File stored for $grade, week: $week ! ");
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'Failed to upload PDF: ' . $e->getMessage());
        }
    }

    public function deletePDF(Request $request)
    {
        $grade = $request->input('grade');
        $week = $request->input('week');
        try {
            if (UploadImage::generalDelete('public/SepartePdfWeek/' . $grade . '/' . $week . '/' . $week . '.pdf')) {
                return redirect()->back()->with('flash_msg', "File Deleted for $grade, week: $week!");
            } else {
                return redirect()->back()->with('flash_msg', "File not found for $grade, week: $week.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'Error');

        }
    }

    public function storePoster(Request $request)
    {
        try {
            // $path = UploadImage::storePoster($request, 'poster');
            $path = UploadImage::generalUpload($request, 'image/posters/' . $request->input('grade'), 'poster', false);

            // dd($path);
            if ($path) {

                if ($request->input('grade') == '1') {
                    $updatedCount = dashboardChange::query()->
                        where('id', 3)->
                        update(['content' => $path]);
                } elseif ($request->input('grade') == '2') {
                    $updatedCount = dashboardChange::query()->
                        where('id', 4)->
                        update(['content' => $path]);
                } elseif ($request->input('grade') == '3') {
                    $updatedCount = dashboardChange::query()->
                        where('id', 5)->
                        update(['content' => $path]);

                }

                return redirect()->back()->with('flash_msg', "Poster stored");
            } else {
                return redirect()->back()->with('flash_msg', 'Failed to upload PDF: Invalid file or file storage error');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'Failed to upload PDF: ' . $e->getMessage());
        }
    }
    
    
    // -------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
      public function storePDFFree(Request $request)
    {
        try {
            $sort = $request->input('sort');
            // dd($sort);
            // $path = UploadImage::storePDF($request, 'pdf', $week, $grade);
            $path = UploadImage::generalUpload($request, 'freeContentPDF/' . $sort, 'pdf', false);
            // dd($path);

            // 
            return redirect()->back()->with('flash_msg', "File stored");
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'Failed to upload PDF: ' . $e->getMessage());
        }
    }

    public function deletePDFFree(Request $request , $name)
    {
        try {
            // dd($name);
            if (UploadImage::generalDelete('public/freeContentPDF/2/' . $name) || UploadImage::generalDelete('public/freeContentPDF/3/' . $name)) {
                return redirect()->back()->with('flash_msg', "File Deleted ");
            } else {
                return redirect()->back()->with('flash_msg', "done");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'Error : ' . $e->getmessage( ));

        }
    }
}