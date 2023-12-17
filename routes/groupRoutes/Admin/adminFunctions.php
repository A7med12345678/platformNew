<?php

use App\Http\Controllers\activationController;
use App\Http\Controllers\complainController;
use App\Http\Controllers\apiExam;
use App\Http\Controllers\CourseRequestController;
use App\Http\Controllers\instructionsController;
use App\Http\Controllers\timeTableController;
use App\Http\Controllers\welcomeMsg;
use App\Http\Controllers\pdfGenerate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\toDoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\adminChatController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\view\FreeContentPageController;
use App\Http\Controllers\editStudentController;


//pass students and controlling to admin dashboard :
Route::resource("/Admin", StudentController::class);
Route::resource("/Chat", adminChatController::class);
Route::resource("/toDo", toDoController::class);

// admin edits students : 
Route::get('admin/editStudentPage/{id}', [editStudentController::class, 'editStudentPage'])->name('admin/editStudentPage');
Route::post('admin/updateStudent/{id}', [editStudentController::class, 'updateStudent'])->name('admin/updateStudent');
Route::get('admin/destroyStudent/{id}', [editStudentController::class, 'destroyStudent'])->name('admin/destroyStudent');
Route::get('admin/forceStopManager/{id}', [editStudentController::class, 'forceStopManager'])->name('admin/forceStopManager');
Route::get('admin/activationManager/{id}', [editStudentController::class, 'activationManager'])->name('admin/activationManager');

// activation : 
Route::post('admin/studentSearch', [activationController::class, 'studentSearch'])->name('admin/studentSearch');
Route::post('admin/deleteLessonfromuser/{index}/{user}', [activationController::class, 'deleteLessonfromuser'])->name('admin/deleteLessonfromuser');
Route::post('admin/addLessonToUser', [activationController::class, 'addLessonToUser'])->name('admin/addLessonToUser');
Route::post('admin/forceStop', [activationController::class, 'forceStop'])->name('admin/forceStop');
Route::post('admin/disableAllGrades', [activationController::class, 'disableAllGrades'])->name('admin/disableAllGrades');
Route::post('admin/disableGrade', [activationController::class, 'disableGrade'])->name('admin/disableGrade');
Route::post('admin/updatePayment', [activationController::class, 'updatePayment'])->name('admin/updatePayment');
Route::post('admin/developMode', [activationController::class, 'developMode'])->name('admin/developMode');
Route::post('admin/addGrade', [activationController::class, 'addGrade'])->name('admin/addGrade');

// best and worthst :
Route::post('/getStatistics', [QuizController::class, 'sumExams'])->name('getStatistics');
Route::post('/getStatisticsHW', [QuizController::class, 'sumExamsHW'])->name('getStatisticsHW');

// assesment preview :
Route::post('admin/examShow/details', [QuizController::class, 'fetchJsonFile'])->name('admin/examShow/details');
Route::post('admin/examShow/Questions', [QuizController::class, 'showExamPhoto'])->name('admin/examShow/Questions');
Route::post('admin/HWShow/details', [QuizController::class, 'fetchJsonFileHW'])->name('admin/HWShow/details');
Route::post('admin/HWShow/Questions', [QuizController::class, 'showHWPhoto'])->name('admin/HWShow/Questions');

// disable assesment :
Route::post('disableExam', [QuizController::class, 'disableExam'])->name('disableExam');
Route::post('disableHW', [QuizController::class, 'disableHW'])->name('disableHW');

Route::post('updateAssigmentAccess', [QuizController::class, 'updateAssigmentAccess'])->name('updateAssigmentAccess');


// enable assesment again :
Route::post('quiz/enable-exam', [QuizController::class, 'enableExam'])->name('quiz/enable-exam');
Route::post('quiz/enable-HW', [QuizController::class, 'enableHW'])->name('quiz/enable-HW');

// complain : 
Route::post('complainDone/{id}', [complainController::class, 'complainDone'])->name('complainDone');
Route::post('aproveComplain/{id}', [complainController::class, 'aproveComplain'])->name('aproveComplain');
Route::post('destroyComplain/{id}', [complainController::class, 'destroyComplain'])->name('destroyComplain');

// pdf generator (exam , hw): 
Route::post('singleGrade', [pdfGenerate::class, 'singleGrade'])->name('singleGrade');
Route::post('singleGradeHW', [pdfGenerate::class, 'singleGradeHW'])->name('singleGradeHW');

Route::post('allGrades', [pdfGenerate::class, 'allGrades'])->name('allGrades');
Route::post('allGradesHW', [pdfGenerate::class, 'allGradesHW'])->name('allGradesHW');

Route::post('groupStudent', [pdfGenerate::class, 'groupStudent'])->name('groupStudent');
Route::post('groupStudentHW', [pdfGenerate::class, 'groupStudentHW'])->name('groupStudentHW');

// wesite dashboard functions :
Route::post('dashboardImage', [welcomeMsg::class, 'dashboardImage'])->name('dashboardImage');
Route::post('dashboardBrief', [welcomeMsg::class, 'dashboardBrief'])->name('dashboardBrief');
Route::post('dashboardother', [welcomeMsg::class, 'dashboardother'])->name('dashboardother');
Route::post('siteInfo', [welcomeMsg::class, 'siteInfo'])->name('siteInfo');
Route::post('dashboardYouTubeLink', [welcomeMsg::class, 'dashboardYouTubeLink'])->name('dashboardYouTubeLink');
Route::post('editGroups', [welcomeMsg::class, 'Groups'])->name('editGroups');
Route::post('storePoster', [FileUploadController::class, 'storePoster'])->name('storePoster');

Route::post('storePDFFree', [FileUploadController::class, 'storePDFFree'])->name('storePDFFree');
Route::get('deletePDFFree/{id}', [FileUploadController::class, 'deletePDFFree'])->name('deletePDFFree');

// free content :
Route::post('freeCon', [FreeContentPageController::class, 'storeFreeContent'])->name('freeCon');

// (exam) uploading using controller :
// Route::post('uploadWeekSec', [FileUploadController::class, 'uploadWeekSec'])->name('uploadWeekSec');
Route::post('uploadExamQ', [FileUploadController::class, 'uploadExamQ']);

// (homework)  uploading using controller :
Route::post('admin/storeExam', [apiExam::class, 'storeExam'])->name('admin/storeExam');
Route::post('admin/storeHW', [apiExam::class, 'storeHW'])->name('admin/storeHW');
Route::post('admin/uploadExamHW', [FileUploadController::class, 'uploadExamHW'])->name('admin/uploadExamHW');

// pdf for each lesson :
Route::post('storePDF', [FileUploadController::class, 'storePDF'])->name('storePDF');
Route::post('deletePDF', [FileUploadController::class, 'deletePDF'])->name('deletePDF');

// instructions : 
Route::post('addInstructions', [instructionsController::class, 'addInstructions'])->name('addInstructions');
Route::post('deleteInstructions/{id}', [instructionsController::class, 'deleteInstructions'])->name('deleteInstructions');
Route::post('editInstructions/{id}', [instructionsController::class, 'editInstructions'])->name('editInstructions');

// course buy request : 
Route::post('statusCourseRequest/{student}/{course}', [CourseRequestController::class, 'statusCourseRequest'])->name('statusCourseRequest');
Route::get('deleteRequestCourseAdmin/{id}', [CourseRequestController::class, 'deleteRequestCourseAdmin'])->name('deleteRequestCourseAdmin');
Route::get('mailCoursePayment/{user}', [CourseRequestController::class, 'mailCoursePayment'])->name('mailCoursePayment');

// time table :
Route::post('addToTimeTable', [timeTableController::class, 'addToTimeTable'])->name('addToTimeTable');
Route::get('deleteTimeTable/{id}', [timeTableController::class, 'deleteTimeTable'])->name('deleteTimeTable');


Route::get('admin/logAllQueries', [StudentController::class, 'logAllQueries'])->name('admin/logAllQueries');

?>