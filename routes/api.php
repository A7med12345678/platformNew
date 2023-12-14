<?php
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\chatApiController;
use App\Http\Controllers\Api\adminDashboardApiController;
use App\Http\Controllers\Api\toDoApiController;
use App\Http\Controllers\Api\examAddApiController;
use App\Http\Controllers\Api\complainApiController;
use App\Http\Controllers\Api\courseBuyApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routes that do not require authentication
Route::post('/auth/register', [AuthApiController::class, 'createUser']);
Route::post('/auth/login', [AuthApiController::class, 'loginUser']);


// Routes that require authentication
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // chat : 
    Route::get('/chat/index', [chatApiController::class, 'index']);
    Route::get('/chat/showAllChats', [chatApiController::class, 'showAllChats']);
    Route::post('/chat/store', [chatApiController::class, 'store']);
    // Route::get('/chat/storeShowChat', [chatApiController::class, 'storeShowChat']);

    // admin dashboard : 
    Route::get('/admin/dashboard', [adminDashboardApiController::class, 'index']);

    // to do : 
    Route::post('/toDo/store', [toDoApiController::class, 'store']);
    Route::get('/toDo/destroy/{id}', [toDoApiController::class, 'destroy']);

    // exam api :
    Route::post('/examApi/storeExam', [examAddApiController::class, 'storeExam']);
    Route::post('/examApi/storeHW', [examAddApiController::class, 'storeHW']);

    Route::post('/complain/store', [complainApiController::class, 'complainInsert']);
    Route::get('/complain/showAllComplains', [complainApiController::class, 'showAllComplains']);
    Route::post('/complain/complainDone/{id}', [complainApiController::class, 'complainDone']);
    Route::get('/complain/destroyComplain/{id}', [complainApiController::class, 'destroyComplain']);
    Route::get('/complain/approveComplain/{id}', [complainApiController::class, 'approveComplain']);


    Route::get('/buy/courseBuyRequests', [courseBuyApiController::class, 'courseBuyRequestsPage']);
    Route::post('/buy/store', [courseBuyApiController::class, 'submitCourseRequest']);
    Route::get('/buy/getCourseRequest', [courseBuyApiController::class, 'getCourseRequest']);
    Route::get('/buy/deliverCourseRequest/{id}', [courseBuyApiController::class, 'deliverCourseRequest']);
    Route::post('/buy/storeStudent/{id}', [courseBuyApiController::class, 'requestCourse']);
    Route::get('/buy/destroyStudent/{id}', [courseBuyApiController::class, 'deleteRequestCourse']);

    
    
    
    Route::post('/logout', [AuthApiController::class, 'logout']);
});
