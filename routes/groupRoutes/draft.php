<?php


Route::get('/composer-update', function () {
    // Run the composer update command
    $output = shell_exec('composer update');

    // Output the result or perform other actions
    return '<pre>' . $output . '</pre>';
})->name('composer-update');

// Route::middleware(['auth', 'throttle:60,1'])->group(function () {

?>