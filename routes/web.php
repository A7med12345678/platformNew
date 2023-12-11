<?php
// git config --global core.autocrlf true

use App\Http\Controllers\SelectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:1000,1'])->group(function () {

    Route::get('/mailbook/dashboard', 'MailbookController@dashboard')->name('mailbook.dashboard');

    require __DIR__ . '/groupRoutes/generalRoutes.php';


    // CheckSingleSession
    Route::middleware(['auth'])->group(function () {


        Route::middleware(['web', 'admin'])->group(function () {

            // admin nav routes : 
            require __DIR__ . '/groupRoutes/Admin/adminNav.php';

            // admin show functions routes :
            require __DIR__ . '/groupRoutes/Admin/adminFunctions.php';

        });


        Route::middleware(['web', 'Sadmin'])->group(function () {


            // Sadmin nav routes : 
            require __DIR__ . '/groupRoutes/Sadmin/SadminFunctions.php';

            // Sadmin show functions routes :
            require __DIR__ . '/groupRoutes/Sadmin/SadminNav.php';

        });

        // , 'student'
        Route::middleware(['web'])->group(function () {

            Route::view('clear', 'clear')->name('clear');

            // student or admin login redirection :
            Route::get('/home2', function () {
                return view('home');
            })->name('home2');
            Route::get('home', [SelectController::class, 'homeStudent'])->name('home');

            // Route::get('/home', function () {
            //     return view('home2');
            // })->name('home');

            //  ------------------------------------student dashboard----------------------------------

            require __DIR__ . '/groupRoutes/studentDashboard.php';
        });
    });

});