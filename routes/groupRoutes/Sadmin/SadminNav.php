<?php

use App\Http\Controllers\resetTablesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\removeAdminController;

Route::get('admin/resetTables', [resetTablesController::class, 'resetTablesPage'])->name('admin/resetTables');
Route::get('admin/removeAdmin', [removeAdminController::class, 'removeAdminPage'])->name('admin/removeAdmin');

?>