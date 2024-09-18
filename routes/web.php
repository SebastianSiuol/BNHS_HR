<?php

Use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\Staff\StaffLeaveController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Faculty;

// Welcome page
Route::view('/','index')->name('/');

//Authentication
Route::get('/faculty/login', [FacultySessionController::class, 'create'])->name('faculty_login');
Route::post('/faculty/login', [FacultySessionController::class, 'store']);
Route::post('/faculty/logout', [FacultySessionController::class, 'destroy'])->name('faculty_logout');
//Authentication


Route::get('/staff/leave', [StaffLeaveController::class, 'index'])->name('staff_leave_index');
Route::get('/staff/leave/create', [StaffLeaveController::class, 'create'])->name('staff_leave_create');
Route::post('/staff/leave/create', [StaffLeaveController::class, 'store'])->name('staff_leave_store');


Route::middleware('auth')->group(function () {

    Route::middleware(['role:admin'])->group(function () { // Routes for admin

        Route::get('/admin/home', function () {
            return view('admin.dashboard', [
                'admin'              => Auth::user(),
                'total_employees'    => Faculty::all()->count(),
            ]);
        })->name('admin_index');


        Route::get('/admin/employees/search', [FacultyController::class, 'search'])                 ->name('employees_search');

        Route::get('/admin/employees', [FacultyController::class, 'index'])                         ->name('employees_index');
        Route::get('/admin/employees/create', [FacultyController::class, 'create'])                 ->name('employees_create');
        Route::post('/admin/employees', [FacultyController::class, 'store'])                        ->name('employees_store');
        Route::get('/admin/employees/{faculty}', [FacultyController::class, 'show'])                ->name('employees_show');
        Route::get('/admin/employees/{faculty}/edit', [FacultyController::class, 'edit'])           ->name('employees_edit');
        Route::patch('/admin/employees/{faculty}', [FacultyController::class, 'update'])            ->name('employees_update');
        Route::delete('/admin/employees/{faculty}/delete', [FacultyController::class, 'destroy'])   ->name('employees_destroy');

        Route::get('/admin/attendances', [AttendanceController::class, 'index'])                    ->name('attendances_index');
        Route::get('/admin/attendances/report', [AttendanceController::class, 'report'])            ->name('attendances_report');

        Route::get('/admin/leaves', [LeaveController::class, 'index'])                              ->name('leaves_index');
        Route::get('/admin/leaves/create', [LeaveController::class, 'create'])                      ->name('leaves_create');
    });


    // Routes for staff
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/staff/home', function() {
            return view('staff.dashboard', []);
        })->name('staff_index');
    });

});
