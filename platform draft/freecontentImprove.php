// Route::post('delfreeCon', [FreeContentPageController::class, 'destroyFreeContent'])->name('delfreeCon');


{{-- <h3>Delete Video : </h3>
        <form method="POST" action="{{ route('delfreeCon') }}">
            @csrf
            <!-- Laravel CSRF protection token -->

            <div class="mb-3">
                <label for="url_to_delete" class="form-label">Url to delete : </label>
                <input type="text" class="form-control" id="url_to_delete" name="url_to_delete" required>
            </div>

            <button type="submit" class="btn btn-primary"
                onclick="return confirm('Are you sure you want to remove this video ?')">remove</button>
        </form>

        <hr class="mt-5 mb-5"> --}}

// public function storeFreeContent(Request $request)
    // {

    //     // radio button has add or delete :
    //     $type = $request->input('type');

    //     // select option week days small :
    //     $new_url = $request->input('new_url');

    //     if ($type == 'add') {

    //         // Retrieve the existing data from the database
    //         $existingData = json_decode(freeContent::pluck('urlfreeContent')->first(), true) ?: [];

    //         // Extract the video IDs from the new URL and add them to the array
    //         $new_url = $request->input('new_url');
    //         $videoId = $this->extractYouTubeVideoId($new_url); // You need to implement this function
    //         if ($videoId) {
    //             $existingData[] = $videoId;
    //         }

    //         // Encode the updated array and store it in the database
    //         freeContent::updateOrInsert(['id' => 1], ['urlfreeContent' => json_encode($existingData)]);

    //     } else {

    //         $videoId = $this->extractYouTubeVideoId($new_url); // You need to implement this function

    //         // Retrieve the existing data from the database
    //         $existingData = json_decode(freeContent::pluck('urlfreeContent')->first(), true) ?: [];

    //         // Find the index of the URL to be deleted in the array
    //         $indexToDelete = array_search($videoId, $existingData);

    //         // If the URL exists in the array, remove it
    //         if ($indexToDelete !== false) {
    //             unset($existingData[$indexToDelete]);

    //             // Re-index the array to maintain consecutive keys
    //             $existingData = array_values($existingData);

    //             // Encode the updated array and store it in the database
    //             freeContent::updateOrInsert(['id' => 1], ['urlfreeContent' => json_encode($existingData)]);

    //             return redirect()->back()->with('flash_msg', 'URL deleted successfully!');
    //         }
    //     }


    //     return redirect()->back()->with('flash_msg', 'Done!');
    // }
    // private function extractYouTubeVideoId($url)
    // {
    //     // Regular expression to extract YouTube video ID
    //     $pattern = '/[?&]v=([a-zA-Z0-9_-]+)/';
    //     preg_match($pattern, $url, $matches);

    //     // Check if a match was found
    //     if (isset($matches[1])) {
    //         return $matches[1];
    //     }

    //     return null; // Return null if no video ID was found
    // }
    // public function destroyFreeContent(Request $request)
    // {
    //     // Get the URL to be deleted from the form input
    //     $urlToDelete = $request->input('url_to_delete');

    //     $videoId = $this->extractYouTubeVideoId($urlToDelete); // You need to implement this function

    //     // Retrieve the existing data from the database
    //     $existingData = json_decode(freeContent::pluck('urlfreeContent')->first(), true) ?: [];

    //     // Find the index of the URL to be deleted in the array
    //     $indexToDelete = array_search($videoId, $existingData);

    //     // If the URL exists in the array, remove it
    //     if ($indexToDelete !== false) {
    //         unset($existingData[$indexToDelete]);

    //         // Re-index the array to maintain consecutive keys
    //         $existingData = array_values($existingData);

    //         // Encode the updated array and store it in the database
    //         freeContent::updateOrInsert(['id' => 1], ['urlfreeContent' => json_encode($existingData)]);

    //         return redirect()->back()->with('flash_msg', 'URL deleted successfully!');
    //     }

    //     return redirect()->back()->with('flash_msg', 'URL not found!');
    // }

