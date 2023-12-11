<?php

namespace App\Http\Controllers;

use App\Models\dashboardChange;
use App\Models\HonerStudent;
use Illuminate\Http\Request;
use App\Helpers\UploadImage;
use App\Helpers\MediaValidationHelper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile; // Import the UploadedFile class

class welcomeMsg extends Controller
{
    public function welcomeMsgPage()
    {
        $pdfFiles = $this->getPdfFiles();
        // dd($pdfFiles);
        return view('admin.welcomeMsg' , compact('pdfFiles'));
    }
   
   private function getPdfFiles()
{
    $baseFolderPath = 'public/freeContentPDF';
    
    // Get files from the subdirectory '2'
    $folderPath2 = $baseFolderPath . '/2';
    $files2 = Storage::files($folderPath2);

    // Get files from the subdirectory '3'
    $folderPath3 = $baseFolderPath . '/3';
    $files3 = Storage::files($folderPath3);

    // Combine files from both subdirectories
    $pdfFiles = array_merge($files2, $files3);

    // Filter only PDF files
    $pdfFiles = array_filter($pdfFiles, function ($file) {
        return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
    });

    return $pdfFiles;
}
 
    //     private function getPdfFiles()
    // {
    //     $folderPath = 'public/freeContentPDF';
    //     $files = Storage::files($folderPath);

    //     // Filter only PDF files
    //     $pdfFiles = array_filter($files, function ($file) {
    //         return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
    //     });

    //     return $pdfFiles;
    // }

    public function dashboardImage(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $filename = UploadImage::generalUpload($request, 'image', 'file', false);
                if ($filename !== false) {
                    dashboardChange::where('id', 2)->update(['content' => $filename]);
                    return redirect()->back()->with('flash_msg', 'Image uploaded successfully.');
                }
            }
            return redirect()->back()->with('flash_msg', 'An error occurred while uploading the image.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while uploading the image: ' . $e->getMessage());
        }
    }

    public function dashboardBrief(Request $request)
    {
        try {
            $brief = $request->input('brief');
            // dd($brief);
            if ($brief) {
                dashboardChange::where('id', 1)->update(['content' => $brief]);
            }

            return redirect()->back()->with('flash_msg', 'Brief updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while uploading the Brief : ' . $e->getMessage());
        }
    }

    public function dashboardother(Request $request)
    {
        try {
            $other = $request->input('other');
            // dd($other);
            if ($other) {
                dashboardChange::where('id', 3)->update(['content' => $other]);
            }

            return redirect()->back()->with('flash_msg', 'other updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while uploading the other : ' . $e->getMessage());
        }
    }

    public function dashboardYouTubeLink(Request $request)
    {
        try {
            $link = $request->input('link');
            // dd($other);
            if ($link) {
                $videoId = $this->extractYouTubeVideoId($link); // You need to implement this function
                dashboardChange::where('id', 6)->update(['content' => $videoId]);
            }
            return redirect()->back()->with('flash_msg', 'Video updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred while uploading the other : ' . $e->getMessage());
        }
    }

    private function extractYouTubeVideoId($url)
    {
        // Regular expression to extract YouTube video ID
        $pattern = '/[?&]v=([a-zA-Z0-9_-]+)/';
        preg_match($pattern, $url, $matches);

        // Check if a match was found
        if (isset($matches[1])) {
            return $matches[1];
        }

        return null; // Return null if no video ID was found
    }

    public function siteInfo(Request $request)
    {
        try {
            $what = $request->input('what');
            $content = $request->input('content');
            // dd($other);
            if ($what) {
                dashboardChange::find($what)->update(['content' => $content]);
            }

            return redirect()->back()->with('flash_msg', 'updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred : ' . $e->getMessage());
        }
    }

    public function Groups(Request $request)
    {
        try {
            // radio button has add or delete :
            $type = $request->input('type');

            // select option week days small :
            $when = $request->input('when');

            if ($type == 'add') {
                dashboardChange::create([
                    'description' => 'currentGroups',
                    'content' => $when,
                ]);
            } else {
                dashboardChange::where([
                    'description' => 'currentGroups',
                    'content' => $when,
                ])->delete();
            }

            return redirect()->back()->with('flash_msg', 'group add successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred : ' . $e->getMessage());
        }
    }


}