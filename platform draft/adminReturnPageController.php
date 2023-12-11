<?php

namespace App\Http\Controllers;

use App\Models\courseRequest;
use App\Models\instruction;
use App\Models\timeTable;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Agent\Facades\Agent;
use Spatie\Browsershot\Browsershot;


class adminReturnPageController extends Controller
{

    //  --------------------------------------- Online : ------------------------------------------
  

    // private function getBrowserImage($browserName)
    // {
    //     // Map browser names to image URLs
    //     $browserImages = [
    //         'Chrome' => "https://cdnjs.cloudflare.com/ajax/libs/browser-logos/74.0.0/chrome/chrome.svg",
    //         'Firefox' => "https://cdnjs.cloudflare.com/ajax/libs/browser-logos/74.0.0/firefox/firefox.svg",
    //         'Safari' => "https://cdnjs.cloudflare.com/ajax/libs/browser-logos/74.0.0/safari/safari.svg",
    //         'Edge' => "https://cdnjs.cloudflare.com/ajax/libs/browser-logos/74.0.0/edge/edge.svg",
    //     ];

    //     // Check if the browser name is in the mapping
    //     if (isset($browserImages[$browserName])) {
    //         return $browserImages[$browserName];
    //     }

    //     // Default image if browser name is not recognized
    //     return asset('img/default.png');
    // }

   

   

    // public function removeAdmin(Request $request)
    // {
    //     $admins = User::where('role', 'admin')->get(); // Fetching admins with 'role' of 'admin'
    //     return view('admin.adminManager', compact('admins'));

    // }

   


    // --------------------------------------------------------




  


}
