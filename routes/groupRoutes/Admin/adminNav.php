<?php

use App\Http\Controllers\activationController;
use App\Http\Controllers\CourseRequestController;
use App\Http\Controllers\editStudentController;
use App\Http\Controllers\instructionsController;
use App\Http\Controllers\timeTableController;
use App\Http\Controllers\adminDashboardController;
use App\Http\Controllers\pdfGenerate;
use App\Http\Controllers\welcomeMsg;
use App\Http\Controllers\complainController;
use App\Http\Controllers\adminChatController;

use Illuminate\Support\Facades\Route;

// admin nav routes : 
Route::view('admin/addLec', 'admin.addLec')->name('admin/addLec');
Route::view('admin/addExam', 'admin.addExam')->name('admin/addExam');
Route::view('admin/AssesmantShow', 'admin.AssesmantShow')->name('admin/AssesmantShow');
Route::view('admin/AssesmentManager', 'admin.AssesmentManager')->name('admin/AssesmentManager');
Route::view('admin/addHW', 'admin.addHW')->name('admin/addHW');

Route::get('admin/report', [pdfGenerate::class, 'reportPage'])->name('admin/report');
Route::get('admin/payment', [activationController::class, 'paymentPage'])->name('admin/payment');
Route::get('admin/welcomeMsg', [welcomeMsg::class, 'welcomeMsgPage'])->name('admin/welcomeMsg');
Route::get('admin/showAllActivations', [activationController::class, 'showAllActivations'])->name('Admin/showAllActivations');
Route::get('admin/instructions', [instructionsController::class, 'instructionPage'])->name('admin/instructions');
Route::get('admin/showAll', [editStudentController::class, 'showAllData'])->name('Admin/showAll');
Route::get('admin/courseBuyRequests', [CourseRequestController::class, 'courseBuyRequestsPage'])->name('admin/courseBuyRequests');
Route::get('admin/timeTable', [timeTableController::class, 'timeTablePage'])->name('admin/timeTable');
Route::get('admin/showAllComplains', [complainController::class, 'showAllComplains'])->name('admin/showAllComplains');
Route::get('admin/showAllChats', [adminChatController::class, 'showAllChats'])->name('Admin/showAllChats');
Route::post('admin/manageActivations', [activationController::class, 'manageActivations'])->name('Admin/manageActivations');

// testing : 
Route::get('admin/online', [adminDashboardController::class, 'online'])->name('admin/online');


// Route::view('admin/reportHW', 'admin.reportHW')->name('admin/reportHW'); 
// Route::view('admin/HWShow', 'admin.HWShow')->name('admin/HWShow');
// Route::view('admin/HWManager', 'admin.HWManager')->name('admin/HWManager');
// Route::view('admin/instructions', 'admin.instructions')->name('admin/instructions');



?>