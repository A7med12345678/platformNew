<?php


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\pdfGenerate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\view\WelcomePageController;
use App\Http\Controllers\view\FreeContentPageController;
use App\Http\Controllers\view\parentFollowUpController;
use App\Http\Controllers\CourseRequestController;
use App\Http\Controllers\adminDashboardController;
use App\Http\Controllers\LanguageController;


Route::get('adminDashboard', [adminDashboardController::class, 'index'])->name('adminDashboard');

// home routes :
Route::get('/', [WelcomePageController::class, 'index'])->name('welcome');

// uploda videos :
Route::post('/store', [FileUploadController::class, 'store'])->name('store');
Route::post('/upload-video', [FileUploadController::class, 'video_upload'])->name('video_upload');

// Free Content page :
Route::get('FreeContent', [FreeContentPageController::class, 'getFreeContent'])->name('FreeContent');
Route::get('freeContentPDF', [FreeContentPageController::class, 'freeContentPDF'])->name('freeContentPDF');

// parent reports : 
Route::view('parentPDF', 'parentPdf')->name('parentPDF');
Route::get('parentGet', [parentFollowUpController::class, 'parentGet'])->name('parentGet');

Route::get('courseBuyGuest', [CourseRequestController::class, 'courseBuyGuest'])->name('courseBuyGuest');
Route::post('submitCourseRequest', [CourseRequestController::class, 'submitCourseRequest'])->name('submitCourseRequest');
Route::post('getCourseRequest', [CourseRequestController::class, 'getCourseRequest'])->name('getCourseRequest');


// both admin & parent 
Route::post('/singleStudent', [pdfGenerate::class, 'singleStudent'])->name('singleStudent');
Route::post('/singleStudentChart', [pdfGenerate::class, 'singleStudentChart'])->name('singleStudentChart');

Route::post('/singleStudentHW', [pdfGenerate::class, 'singleStudentHW'])->name('singleStudentHW');
Route::post('/singleStudentChartHW', [pdfGenerate::class, 'singleStudentChartHW'])->name('singleStudentChartHW');

Route::post('/changeLanguage', [LanguageController::class, 'changeLanguage'])->name('changeLanguage');

Route::get('/opt', function () {
    Artisan::call('optimize');
    return redirect()->back();
    //    return Artisan::call('optimize');
})->name('opt');

// link storage command :
Route::get('/link', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

// Login routes:
Auth::routes();

?>