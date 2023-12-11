
// public static function storePDF($request, $fileKey, $week, $grade)
    // {
    //     if ($request->hasFile($fileKey)) {
    //         $file = $request->file($fileKey);
    //         $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    //         $fileExtension = $file->getClientOriginalExtension();
    //         $newFileName = $week . '.' . $fileExtension;

    //         try {
    //             $filePath = 'public/SepartePdfWeek/' . $grade . '/' . $week . '/' . $newFileName;
    //             Storage::put($filePath, file_get_contents($file));
    //             return Storage::url($filePath);
    //         } catch (\Exception $e) {
    //             return false;
    //         }
    //     }

    //     return false; // No file to upload
    // }

    // public static function deletePDF($week, $grade)
    // {

    //     $filePath = 'public/SepartePdfWeek/' . $grade . '/' . $week . '/' . $week . '.pdf';

    //     // return $filePath;
    //     if (Storage::exists($filePath)) {
    //         try {
    //             Storage::delete($filePath);
    //             return true; // Deletion successful
    //         } catch (\Exception $e) {
    //             return false; // Deletion failed
    //         }
    //     }

    //     return false; // No file to delete
    // }

    
    // public static function storePoster(Request $request, $fileKey)
    // {
    //     if ($request->hasFile($fileKey)) {
    //         $file = $request->file($fileKey); // Use $request->file() to get the uploaded file
    //         $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    //         $uniqueFileName = $originalFileName . '_' . time() . '.' . $file->extension();

    //         try {
    //             // $filePath = $file->storeAs('public/image', $uniqueFileName);
    //             $filePath = 'public/image/posters/' . $request->input('grade') . '/' . $uniqueFileName;
    //             Storage::put($filePath, file_get_contents($file));

    //             return $uniqueFileName;
    //         } catch (\Exception $e) {
    //             return false;
    //         }
    //     }

    //     return false; // No file to upload
    // }



    
    // general Upload : 
    // public static function generalUpload(Request $request, $folderName)
    // {
    //     $file = $request->file('file')->getClientOriginalName();
    //     $path = $request->file('file')->storeAs($folderName, $file, 'public');

    //     if ($path) {
    //         return $file; // Upload and storage successful
    //     }

    //     return false; // Error occurred
    // }




    
    // free content video , pdf : 
    public static function uploadFile($request, $fileKey, $errorMessagePrefix)
    {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileExtension = $file->getClientOriginalExtension();
            $newFileName = 'free.' . $fileExtension;

            try {
                $file->storeAs('free/pdf', $newFileName, 'public');
                return true; // Upload successful
            } catch (\Exception $e) {
                return false; // Upload failed
            }
        }

        return false; // No file to upload
    }










    meadi hepler :-


    
    //   public static function validateVideo($file, $maxSize = 1000000, $allowedFormats = ['mp4', 'avi'])
// {
//     $validator = Validator::make(['file' => $file], [
//         'file' => [
//             'required',
//             'mimetypes:' . implode(',', $allowedFormats),
//             'max:' . $maxSize,
//         ]
//     ]);

    //     if ($validator->fails()) {
//         dd($validator->errors());
//     }

    //     return true;
// }



