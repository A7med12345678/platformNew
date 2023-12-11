<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
{

    public function expirment()
    {
       
      // Assuming you want to fetch the file names from the "expirments" folder in the "public" directory
      $videosPath = 'expirments'; // This is the folder path relative to the "public" directory

      // Get all the files in the "public/expirments" folder
      $videoFiles = Storage::files($videosPath);

      dd($videoFiles);
      return view('students.expirment', compact('videoFiles'));
    }
    
}
