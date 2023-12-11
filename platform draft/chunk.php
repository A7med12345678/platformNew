
// public function video_upload(Request $request)
    // {
    //     try {
    //         // dd($request->grade);
    //         // Validation
    //         $request->validate([
    //             'video_title' => 'required',
    //             'video' => 'required|file',
    //             'chunkIndex' => 'required|integer',
    //             'totalChunks' => 'required|integer',
    //         ]);
    //         info($request);

    //         $file = $request->file('video');
    //         $grade = $request->input('grade');

    //         $week = $request->input('week');
    //         $sec = $request->input('sec');

    //         $chunkIndex = $request->input('chunkIndex');
    //         $totalChunks = $request->input('totalChunks');
    //         $originalExtension = $file->getClientOriginalExtension();


    //         if ($grade === "free") {

    //             $filename = 'free.mp4';
    //             $chunkFilename = 'chunk_' . $chunkIndex . '_' . $filename;
    //             // Save the chunk
    //             Storage::disk('local')->put('temp/' . $chunkFilename, file_get_contents($file));
    //             // If this is the last chunk, combine all the chunks into a single file
    //             if ($chunkIndex == $totalChunks - 1) {
    //                 info(['totalChunks' => $totalChunks]);
    //                 $this->combineChunks($filename, $totalChunks, $grade);
    //             }

    //             return response()->json(['status' => 'success', 'path' => $request->video_title . '.mp4']);

    //         } else {
    //             $filename = $week . $sec . '.mp4';
    //             $chunkFilename = 'chunk_' . $chunkIndex . '_' . $filename;

    //             // Save the chunk
    //             Storage::disk('local')->put('temp/' . $chunkFilename, file_get_contents($file));
    //             // If this is the last chunk, combine all the chunks into a single file
    //             if ($chunkIndex == $totalChunks - 1) {
    //                 info(['totalChunks' => $totalChunks]);
    //                 $this->combineChunks($filename, $totalChunks, $grade);
    //             }

    //             return response()->json(['status' => 'success', 'path' => $request->video_title . '.mp4']);
    //         }
    //     } catch (\Exception $e) {
    //         // Log the error
    //         \Log::error("Error in video_upload: " . $e->getMessage());

    //         return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    //     }
    // }

    // private function combineChunks($filename, $totalChunks, $grade)
    // {
    //     try {
    //         if ($grade === "free") {

    //             $directory = storage_path('app/public/free/video/');

    //             // Check if the directory exists
    //             if (is_dir($directory)) {
    //                 // Open the directory
    //                 if ($dirHandle = opendir($directory)) {
    //                     while (false !== ($file = readdir($dirHandle))) {
    //                         // Skip the special entries "." and ".."
    //                         if ($file != "." && $file != "..") {
    //                             $filePath = $directory . '/' . $file;

    //                             // Check if it's a file and delete it
    //                             if (is_file($filePath)) {
    //                                 unlink($filePath);
    //                             }
    //                         }
    //                     }
    //                     closedir($dirHandle);
    //                 }
    //             } else {
    //                 // Handle the case where the directory doesn't exist
    //                 // You can log an error or perform other actions as needed.
    //             }
    //         }

    //         if (!file_exists($directory)) {
    //             mkdir($directory, 0755, true);
    //         }

    //         $filePath = $directory . '/' . $filename;

    //         $handle = fopen($filePath, 'wb');

    //         if (!$handle) {
    //             throw new \Exception("Could not open file for writing: " . $filename);
    //         }

    //         for ($i = 0; $i < $totalChunks; $i++) {
    //             $chunkFilename = 'chunk_' . $i . '_' . $filename;
    //             $chunkPath = storage_path('app/temp/' . $chunkFilename);

    //             if (!file_exists($chunkPath)) {
    //                 throw new \Exception("Chunk not found: " . $chunkFilename);
    //             }

    //             fwrite($handle, file_get_contents($chunkPath));
    //             unlink($chunkPath); // Delete the chunk
    //         }

    //         fclose($handle);
    //     } catch (\Exception $e) {
    //         // Log the error
    //         \Log::error("Error in combineChunks: " . $e->getMessage());

    //         throw $e; // Re-throw the exception to be caught in the calling method
    //     }
    // }


    //   public function uploadWeekSec(Request $request)
// {
//     // $validatorResult = MediaValidationHelper::validateVideo($request->file('lec_video'));

    //     // if (!$validatorResult['success']) {
//     //     return response()->json(['success' => false, 'message' => 'Upload failed. Please try again.', 'errors' => $validatorResult['errors']]);
//     // }

    //     $userGrade = $request->input('grade');
//     $file = $request->file('lec_video');
//     $fileName = $file->getClientOriginalName();

    //     $destinationPath = 'public/videos/' . $userGrade;

    //     try {
//         Storage::putFileAs($destinationPath, $file, $fileName);
//         return response()->json(['success' => true, 'message' => 'Lec Video added successfully!']);
//     } catch (\Exception $e) {
//         return response()->json(['success' => false, 'message' => 'Failed to upload file: ' . $e->getMessage()]);
//     }
// }
