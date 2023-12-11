<?php

namespace App\Http\Controllers\Dashboard\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function video_upload(Request $request)
    {
        try {
            // Validation
            $request->validate([
                'video_title'   => 'required',
                'video' => 'required|file',
                'chunkIndex' => 'required|integer',
                'totalChunks' => 'required|integer',
            ]);
            info($request);

            $file = $request->file('video');
            $chunkIndex = $request->input('chunkIndex');
            $totalChunks = $request->input('totalChunks');
            $originalExtension = $file->getClientOriginalExtension();
            $filename =  $request->video_title  . '.mp4';
            $chunkFilename = 'chunk_' . $chunkIndex . '_' . $filename;

            // Save the chunk
            Storage::disk('local')->put('temp/' . $chunkFilename, file_get_contents($file));
            // If this is the last chunk, combine all the chunks into a single file
            if ($chunkIndex == $totalChunks - 1) {
                info(['totalChunks' => $totalChunks]);
                $this->combineChunks($filename, $totalChunks);
            }

            return response()->json(['status' => 'success', 'path' => $request->video_title .'.mp4']);
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Error in video_upload: " . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function combineChunks($filename, $totalChunks)
    {
        try {
            $handle = fopen(storage_path('app/public/videos/' . $filename), 'wb');

            if (!$handle) {
                throw new \Exception("Could not open file for writing: " . $filename);
            }
            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkFilename = 'chunk_' . $i . '_' . $filename;
                $chunkPath = storage_path('app/temp/' . $chunkFilename);
                info($chunkPath);
                if (!file_exists($chunkPath)) {
                    throw new \Exception("Chunk not found: " . $chunkFilename);
                }
                info($handle);
                fwrite($handle, file_get_contents($chunkPath));
                unlink($chunkPath); // Delete the chunk
            }

            fclose($handle);
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Error in combineChunks: " . $e->getMessage());

            throw $e;  // Re-throw the exception to be caught in the calling method
        }
    }

    // public function video_upload (Request $request)
    // {

    //     $file = $request->file('video');
    //     $chunkIndex = $request->input('chunkIndex');
    //     $totalChunks = $request->input('totalChunks');
    //     $filename = time() . $file->getClientOriginalName();

    //     $chunkFilename = 'chunk_' . $chunkIndex . '_' . $filename;
    //     Storage::disk('local')->put('temp/' . $chunkFilename, file_get_contents($file));

    //     if ($chunkIndex == $totalChunks - 1) {
    //         $this->combineChunks($filename, $totalChunks);
    //     }

    //     return response()->json(['status' => 'success']);
    // }

    // private function combineChunks($filename, $totalChunks)
    // {
    //     $handle = fopen(public_path('images/videos/' . $filename), 'wb');
    //     for ($i = 0; $i < $totalChunks; $i++) {
    //         $chunkFilename = 'chunk_' . $i . '_' . $filename;
    //         $chunkPath = storage_path('app/temp/' . $chunkFilename);
    //         fwrite($handle, file_get_contents($chunkPath));
    //         unlink($chunkPath);
    //     }

    //     fclose($handle);
    // }

    public function video_delete (Request $request)
    {
        if ($request->has('path'))
        {
            $expired_path = public_path("storage/" . $request->path);

            if (file_exists($expired_path)) {
                unlink($expired_path);
            } else {
                return 'file not found';
            }

            return __('site.Deleted Successfully');
        }
        return true;
    }
}
