<?php

use App\Http\Controllers\Admin\Configuration\DepartmentController;
use App\Http\Controllers\Admin\Configuration\DesignationController;
use App\Http\Controllers\Admin\Configuration\ShiftController;
Use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\AdminLeaveController;
use App\Http\Controllers\Staff\StaffLeaveController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Faculty;


Route::get('/get-designations', [DesignationController::class, 'getDesignations']);

Route::get('/staff/leave', [StaffLeaveController::class, 'index'])->name('staff.leave.index');
Route::get('/staff/leave/create', [StaffLeaveController::class, 'create'])->name('staff.leave.create');
Route::post('/staff/leave/create', [StaffLeaveController::class, 'store'])->name('staff.leave.store');
Route::get('/employees/export', [FacultyController::class, 'export'])->name('employees_export');

Route::middleware('redirectIfAuth')->group(function () {
    Route::view('/','index')->name('/');
    Route::get('/faculty/login', [FacultySessionController::class, 'create'])->name('faculty_login');
    Route::post('/faculty/login', [FacultySessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/faculty/logout', [FacultySessionController::class, 'destroy'])->name('faculty_logout');

    Route::middleware(['role:admin'])->group(function () { // Routes for admin
        Route::get('/admin/home', function () {
            return view('admin.dashboard', [
                'admin'              => Auth::user(),
                'total_employees'    => Faculty::all()->count(),
            ]);
        })->name('admin_index');

        Route::get('/admin/employees/search', [FacultyController::class, 'search'])                 ->name('admin_employees_search');

//      Employee Management Routes
        Route::get('/admin/employees', [FacultyController::class, 'index'])                         ->name('employees.index');
        Route::get('/admin/employees/create', [FacultyController::class, 'create'])                 ->name('employees.create');
        Route::post('/admin/employees', [FacultyController::class, 'store'])                        ->name('employees_store');
        Route::get('/admin/employees/{faculty}', [FacultyController::class, 'show'])                ->name('employees.show');
        Route::get('/admin/employees/{faculty}/edit', [FacultyController::class, 'edit'])           ->name('employees_edit');
        Route::patch('/admin/employees/{faculty}', [FacultyController::class, 'update'])            ->name('employees_update');
        Route::delete('/admin/employees/{faculty}/delete', [FacultyController::class, 'destroy'])   ->name('employees_destroy');
//      Attendance Routes
        Route::get('/admin/attendances', [AttendanceController::class, 'index'])                    ->name('admin.attendances.index');
        Route::get('/admin/attendances/report', [AttendanceController::class, 'report'])            ->name('admin.attendances.report');
//      Leave Routes
        Route::get('/admin/leaves', [AdminLeaveController::class, 'index'])                              ->name('admin.leaves.index');
        Route::get('/admin/leaves/create', [AdminLeaveController::class, 'create'])                      ->name('admin.leaves.create');
//      Configuration Routes
        Route::get('/admin/config/details', []);
        Route::get('/admin/config/department', [DepartmentController::class, 'index'])              ->name('department_config_index');
        Route::get('/admin/config/position', []);
        Route::get('/admin/config/shift', [ShiftController::class, 'index'])                        ->name('shift_config_index');
    });


    // Routes for staff
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/staff/home', function() {
            return view('staff.dashboard', []);
        })->name('staff_index');
    });

});
