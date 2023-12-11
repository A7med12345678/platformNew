<?php

namespace App\Helpers;

use App\Models\dashboardChange;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UploadImage
{

    public static function generalUpload(Request $request, $folderName, $key, $rename, $if_renamed = null)
    {
        if (!empty($request->file($key))) {
            $file = $request->file($key);

            if ($rename == true) {
                $uniqueFileName = $if_renamed . '.' . $file->extension();
            } else {
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uniqueFileName = $originalFileName . '_' . time() . '.' . $file->extension();
            }

            $path = $request->file($key)->storeAs($folderName, $uniqueFileName, 'public');
            return $uniqueFileName;
        } else {
            return false;
        }
    }

    public static function generalDelete($filePath)
    {

        // return $filePath;
        if (Storage::exists($filePath)) {
            try {
                Storage::delete($filePath);
                return true; // Deletion successful
            } catch (\Exception $e) {
                return false; // Deletion failed
            }
        }

        return false; // No file to delete
    }
}