<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedStaffController;
use App\Http\Controllers\AuthenticatedAdminController;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\FacultyController;

Route::view('/', 'welcome')->name('landing_page');

//Authentication
Route::get('/staff/login', [AuthenticatedStaffController::class, 'create'])->name('staff_login');
Route::post('/staff/login', [AuthenticatedStaffController::class, 'store'])->name('staff_login');

Route::get('/admin/login', [AuthenticatedAdminController::class, 'create'])->name('admin_login');
Route::post('/admin/login', [AuthenticatedAdminController::class, 'store'])->name('admin_login');
Route::post('/admin/logout', [AuthenticatedAdminController::class, 'destroy'])->name('admin_logout');

//Route::view('/admin/login','auth.admin_login');




Route::middleware('auth')->group(function () {

    // Routes for admin
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/admin/home', function() {

            $faculty = Auth::user();

            return view('admin.dashboard', ['faculty' => $faculty]);
        })->name('admin_index');

        Route::get('/admin/employees', [FacultyController::class, 'index'])->name('employees_index');
        Route::get('/admin/employees/create', [FacultyController::class, 'create'])->name('employees_create');
        Route::post('/admin/employees', [FacultyController::class, 'store'])->name('employees_store');
        Route::get('/admin/employees/{faculty}', [FacultyController::class, 'show'])->name('employees_show');
        Route::delete('/admin/employees/{faculty}/delete', [FacultyController::class, 'destroy'])->name('employees_destroy');

    });




    // Routes for staff
    Route::middleware(['role:staff'])->group(function () {
        Route::view('/staff/dashboard', 'staff.index')->name('staff_index');
    });


    Route::post('/staff/logout', [AuthenticatedStaffController::class, 'destroy']);
});
