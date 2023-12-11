<?php


use App\Http\Controllers\complainController;
use App\Http\Controllers\CourseRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\StudentController;


//  exam :
Route::get('weeks/weekExam', [SelectController::class, 'weekExam'])->name('weeks/weekExam');
Route::get('weeks/weekHW', [SelectController::class, 'weekHW'])->name('weeks/weekHW');
Route::post('quiz/process-score', [QuizController::class, 'processScore'])->name('quiz/process-score');
Route::post('quiz/processScoreHW', [QuizController::class, 'processScoreHW'])->name('quiz/processScoreHW');
// processScoreHW
Route::resource("/weeks", SelectController::class);

// lectures :
Route::get('/archive', [SelectController::class, 'archive'])->name('archive');
Route::get('/currentWeek', [SelectController::class, 'currentWeek'])->name('currentWeek');

// complain :

Route::get('/complain', [complainController::class, 'complainPage'])->name('complain');
Route::post('complainInsert', [complainController::class, 'complainInsert'])->name('complainInsert');

// edit acount :

Route::get('/editAccunt/{center_code}', [StudentController::class, 'editAccunt'])->name('editAccunt');
Route::post('/updateAccount/{center_code}', [StudentController::class, 'updateAccount'])->name('updateAccount');


// FAQ Q :

Route::get('/FAQquestions', [SelectController::class, 'FAQquestions'])->name('FAQquestions');


Route::get('/requestCourse/{course}', [CourseRequestController::class, 'requestCourse'])->name('requestCourse');
Route::get('/deleteRequestCourse/{course}', [CourseRequestController::class, 'deleteRequestCourse'])->name('deleteRequestCourse');
Route::get('/courseBuy', [SelectController::class, 'courseBuy'])->name('courseBuy');
Route::get('/timeTable', [SelectController::class, 'timeTable'])->name('timeTable');


Route::post('/liveStream', [SelectController::class, 'liveStream'])->name('liveStream');

Route::post('/updateProfile/{id}', [StudentController::class, 'updateProfile'])->name('updateProfile');
Route::post('/studentSwithcourse', [StudentController::class, 'studentSwithcourse'])->name('studentSwithcourse');

Route::get('/deliverCourseRequest/{id}', [CourseRequestController::class, 'deliverCourseRequest'])->name('deliverCourseRequest');

?>