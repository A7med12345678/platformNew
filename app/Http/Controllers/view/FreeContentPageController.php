<?php

namespace App\Http\Controllers\view;

use App\Models\freeContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FreeContentPageController extends Controller
{
    const DEFAULT_SORT = 2;

    // -------------------------------- Free Content : --------------------------------------

    // add or delete : 
    public function storeFreeContent(Request $request)
    {
        try {
            $type = $request->input('type');
            $new_url = $request->input('new_url');
            $grade = $request->input('grade');

            // Retrieve the existing data from the database
            // $existingData = json_decode(freeContent::pluck('urlfreeContent')->first(), true) ?: [];

            if ($type == 'add') {
                $videoId = $this->extractYouTubeVideoId($new_url);
                // dd($videoId);

                if ($videoId) {
                    // $existingData[] = $videoId;
                    $this->updateFreeContent(
                        // $existingData,
                        $videoId,
                        $grade
                    );
                }
            } elseif ($type == 'delete') {
                $videoId = $this->extractYouTubeVideoId($new_url);

                // $indexToDelete = array_search($videoId, $existingData);

                // if ($indexToDelete !== false) {
                //     unset($existingData[$indexToDelete]);
                //     $existingData = array_values($existingData);
                //     $this->updateFreeContent($existingData);
                //     return redirect()->back()->with('flash_msg', 'URL deleted successfully!');
                // }

                // Find the frecontent by URL
                $frecontent = freeContent::where('urlfreeContent', $videoId)->first();
                // dd($frecontent);
                // Check if the frecontent exists
                if (!$frecontent) {
                    return redirect()->back()->with('done', 'frecontent not found');
                }

                // Delete the frecontent
                $frecontent->delete();



            }

            return redirect()->back()->with('flash_msg', 'Done!');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_msg', 'An error occurred: ' . $e->getMessage());
        }
    }

    private function updateFreeContent(
        // array $data,
        $new_url,
        $grade
    ) {
        // Encode the updated array and store it in the database
        // freeContent::updateOrInsert(['id' => 1], ['urlfreeContent' => json_encode($data)]);
        freeContent::create([
            'urlfreeContent' => $new_url,
            'grade' => $grade,
        ]);
    }

    private function extractYouTubeVideoId($url)
    {
        // Regular expression to extract YouTube video ID
        $pattern = '/[?&]v=([a-zA-Z0-9_-]+)/';
        preg_match($pattern, $url, $matches);

        // Check if a match was found
        return isset($matches[1]) ? $matches[1] : null;
    }

    // get page : 



    public function freeContentPDF(Request $request)
    {
        $sort = $request->input('sort') ?? self::DEFAULT_SORT;

        //   $sort = $request->input('sort') ?? 2;
        //   dd($sort);

        $pdfFiles = $this->getPdfFiles($sort);
        // dd($pdfFiles);
        return view('freeContentPDF', compact('pdfFiles'));
    }

    private function getPdfFiles($sort)
    {
        $folderPath = 'public/freeContentPDF/' . $sort;
        $files = Storage::files($folderPath);

        // foreach ($pdfFiles as $pdfFile) {
        //     // Extract numeric part from the path using regular expression
        //     preg_match('/\/(\d+)\//', $pdfFile, $matches);
        //     $numericPart = isset($matches[1]) ? $matches[1] : '';

        //     // Extract path after 'public' using Str::after
        //     $extractedPath = Str::after($pdfFile, 'public');

        // }

        // Filter only PDF files
        $pdfFiles = array_filter($files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
        });

        return $pdfFiles;
    }


    public function getFreeContent(Request $request)
    {
        $sort = $request->input('sort') ?? self::DEFAULT_SORT;
        // Retrieve the encoded data from the database and decode it into an array
        $encodedData = freeContent::where('grade', $sort)->pluck('urlfreeContent');
        // $encodedData = freeContent::pluck('urlfreeContent')->first();
        // $freeContent = json_decode($encodedData, true) ?: [];

        // Initialize an array to store the extracted YouTube video URLs and titles
        $videoData = [];

        // Iterate through the array and convert video IDs to full YouTube URLs
        foreach ($encodedData as $item) {
            // Check if the item is a valid YouTube video ID (non-empty) and not already in the list
            if (!empty($item) && is_string($item) && strlen($item) === 11) {
                // Construct the full YouTube URL by appending the video ID
                $videoUrl = "https://www.youtube.com/embed/{$item}";

                // Fetch video title using YouTube Data API
                $videoTitle = $this->getVideoTitle($item);

                // Add the video URL and title to the list
                $videoData[] = [
                    'url' => $videoUrl,
                    'title' => $videoTitle
                ];
            }
        }
        
        // dd($videoData);
        return view('freeContent', compact('videoData'));
    }

    private function getVideoTitle($videoId)
    {
        // Your YouTube Data API key
        $apiKey = "AIzaSyBWMgBc4zxM7TIFj5Gl77ysIPjGS39u91U";

        // API endpoint URL
        $apiUrl = "https://www.googleapis.com/youtube/v3/videos";

        // Parameters for the API request
        $params = [
            'id' => $videoId,
            'key' => $apiKey,
            'part' => 'snippet'
        ];

        // Make the API request using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Parse the response and extract the video title
        $responseData = json_decode($response, true);
        $videoTitle = $responseData['items'][0]['snippet']['title'] ?? '';

        return $videoTitle;
    }


}