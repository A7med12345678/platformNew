<?php

use App\Http\Controllers\resetTablesController;
use App\Http\Controllers\removeAdminController;
use Illuminate\Support\Facades\Route;

Route::get('pormoteAdmin/{id}', [removeAdminController::class, 'pormoteAdmin'])->name('pormoteAdmin');
Route::get('deleteAdmin/{id}', [removeAdminController::class, 'deleteAdmin'])->name('deleteAdmin');

Route::match(['get', 'post'], 'archiveSpecialLogs', [resetTablesController::class, 'archiveSpecialLogs'])->name('archiveSpecialLogs');
Route::post('actionTables', [resetTablesController::class, 'actionTables'])->name('actionTables');

?>