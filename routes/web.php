<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedStaffController;
use App\Http\Controllers\AuthenticatedAdminController;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\FacultyController;

Route::get('/', function(){
    return view('index');
})->name('/');

//Authentication
Route::get('/staff/login', [AuthenticatedStaffController::class, 'create'])->name('staff_login');
Route::post('/staff/login', [AuthenticatedStaffController::class, 'store']);

Route::get('/admin/login', [AuthenticatedAdminController::class, 'create'])->name('admin_login');
Route::post('/admin/login', [AuthenticatedAdminController::class, 'store']);
Route::post('/admin/logout', [AuthenticatedAdminController::class, 'destroy'])->name('admin_logout');

Route::get('/faculty/login', [FacultySessionController::class, 'create'])->name('login');
Route::post('/faculty/login', [FacultySessionController::class, 'store']);
Route::post('/faculty/logout', [FacultySessionController::class, 'destroy'])->name('logout');


Route::get('/staff/home', function() {
    return view('staff.dashboard', []);
})->name('staff_index');





Route::middleware('auth')->group(function () {
    Route::middleware(['role:admin'])->group(function () { // Routes for admin

        Route::get('/admin/home', function() {
            return view('admin.dashboard', [
                'admin'              => Auth::user(),
                'total_employees'    => Faculty::all()->count(),
            ]);
        })->name('admin_index');


        Route::get('/admin/employees/search', [FacultyController::class, 'search'])->name('employees_search');

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

        Route::get('/admin/leaves', [LeaveController::class, 'index'])->name('leaves_index');
        Route::get('/admin/leaves/create', [LeaveController::class, 'create'])->name('leaves_create');


        Route::post('/admin/employees/debug_store', [FacultyController::class, 'debug_store'])->name('employees_debug_store');
    });




    // Routes for staff
//    Route::middleware(['role:staff'])->group(function () {
//        Route::view('/staff/home', 'staff.index')->name('staff_index');
//    });


    Route::post('/staff/logout', [AuthenticatedStaffController::class, 'destroy']);
});
