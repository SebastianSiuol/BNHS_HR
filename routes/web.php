<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedStaffController;

Route::view('/', 'welcome')->name('/');

//Authentication
Route::get('/staff/login', [AuthenticatedStaffController::class, 'create'])->name('login');
Route::post('/staff/login', [AuthenticatedStaffController::class, 'store'])->name('login');

Route::view('/admin/login','auth.admin_login');


Route::middleware('auth')->group(function () {
    Route::view('/staff/dashboard', 'staff.index')->name('staff_index');

    Route::post('/staff/logout', [AuthenticatedStaffController::class, 'destroy']);
});
