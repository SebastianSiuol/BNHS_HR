<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedStaffController;
use App\Http\Controllers\AuthenticatedAdminController;

Route::view('/', 'welcome')->name('/');

//Authentication
Route::get('/staff/login', [AuthenticatedStaffController::class, 'create'])->name('staff_login');
Route::post('/staff/login', [AuthenticatedStaffController::class, 'store'])->name('staff_login');

Route::get('/admin/login', [AuthenticatedAdminController::class, 'create'])->name('admin_login');
Route::post('/admin/login', [AuthenticatedAdminController::class, 'store'])->name('admin_login');

Route::view('/admin/login','auth.admin_login');




Route::middleware('auth')->group(function () {

    // Routes for admin
    Route::middleware(['role:admin'])->group(function () {
//        Route::view('/admin/dashboard', 'admin.index')->name('admin_index');
        Route::view('/admin/home', 'admin.dashboard')->name('admin_index');
        Route::view('/admin/employee', 'admin.employee_page');
    });

    // Routes for staff
    Route::middleware(['role:staff'])->group(function () {
        Route::view('/staff/dashboard', 'staff.index')->name('staff_index');
    });


    Route::post('/staff/logout', [AuthenticatedStaffController::class, 'destroy']);
});
