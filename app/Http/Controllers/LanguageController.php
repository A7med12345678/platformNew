<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $user = Auth::user();
        // dd($user ? 'yes' : 'no');
        $selectedLocale = $request->input('language');

        if (
            // $user &&
            in_array($selectedLocale, config('app.supported_locales'))
        ) {
            // dd('dd');
            // Store the selected locale in the session
            session(['locale' => $selectedLocale]);
        }

        return back();
    }

}
