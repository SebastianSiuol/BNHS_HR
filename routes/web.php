<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedStaffController;
use App\Http\Controllers\AuthenticatedAdminController;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\FacultyController;

Route::get('/', function(){
    return view('welcome');
})->name('/');

//Authentication
Route::get('/staff/login', [AuthenticatedStaffController::class, 'create'])->name('staff_login');
Route::post('/staff/login', [AuthenticatedStaffController::class, 'store']);

Route::get('/admin/login', [AuthenticatedAdminController::class, 'create'])->name('admin_login');
Route::post('/admin/login', [AuthenticatedAdminController::class, 'store']);
Route::post('/admin/logout', [AuthenticatedAdminController::class, 'destroy'])->name('admin_logout');

//Route::view('/admin/login','auth.admin_login');




Route::middleware('auth')->group(function () {

    // Routes for admin
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/admin/home', function() {

            $faculty = Auth::user();

            $total_employees = Faculty::all()->count();

            return view('admin.dashboard', [
                'faculty' => $faculty,
                'total_employees' => $total_employees,
            ]);

        })->name('admin_index');

//      Start of Employee Resource
        Route::get('/admin/employees', [FacultyController::class, 'index'])->name('employees_index');
        Route::get('/admin/employees/create', [FacultyController::class, 'create'])->name('employees_create');
        Route::post('/admin/employees', [FacultyController::class, 'store'])->name('employees_store');
        Route::get('/admin/employees/{faculty}', [FacultyController::class, 'show'])->name('employees_show');
        Route::get('/admin/employees/{faculty}/edit', [FacultyController::class, 'edit'])->name('employees_edit');
        Route::patch('/admin/employees/{faculty}', [FacultyController::class, 'update'])->name('employees_update');
        Route::delete('/admin/employees/{faculty}/delete', [FacultyController::class, 'destroy'])->name('employees_destroy');
//      End of Employee Resource

        Route::get('/admin/attendances', [AttendanceController::class, 'index'])->name('attendances_index');
        Route::get('/admin/attendances/report', [AttendanceController::class, 'report'])->name('attendances_report');

        Route::get('/admin/leaves', [LeaveController::class, 'index'])->name('attendances_index');
        Route::get('/admin/leaves/create', [LeaveController::class, 'create'])->name('attendances_report');


        Route::post('/admin/employees/debug_store', [FacultyController::class, 'debug_store'])->name('employees_debug_store');
    });




    // Routes for staff
    Route::middleware(['role:staff'])->group(function () {
        Route::view('/staff/dashboard', 'staff.index')->name('staff_index');
    });


    Route::post('/staff/logout', [AuthenticatedStaffController::class, 'destroy']);
});
