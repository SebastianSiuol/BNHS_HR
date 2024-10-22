<?php

use App\Http\Controllers\Admin\Configuration\CompanyDetailController;
use App\Http\Controllers\Admin\Configuration\DepartmentController;
use App\Http\Controllers\Admin\Configuration\DesignationController;
use App\Http\Controllers\Admin\Configuration\PositionController;
use App\Http\Controllers\Admin\Configuration\ShiftController;
use App\Http\Controllers\Api\LeaveTypeApiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
Use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\AdminLeaveController;
use App\Http\Controllers\ServiceCreditController;
use App\Http\Controllers\Staff\StaffLeaveController;
use Illuminate\Support\Facades\Route;
use App\Models\Faculty;


Route::get('/get-designations', [DesignationController::class, 'getDesignations'])->name('api.get.designations');
Route::get('/get-leave-type', [LeaveTypeApiController::class, 'getLeaveType'])->name('api.get.leave.type');

Route::get('/staff/leave', [StaffLeaveController::class, 'index'])->name('staff.leave.index');
Route::get('/staff/leave/create', [StaffLeaveController::class, 'create'])->name('staff.leave.create');
Route::post('/staff/leave/create', [StaffLeaveController::class, 'store'])->name('staff.leave.store');

Route::get('/employees/export', [FacultyController::class, 'export'])->name('employees_export');

Route::middleware('redirectIfAuth')->group(function () {

    Route::view('/','index')->name('/');
    Route::get('/faculty/login', [FacultySessionController::class, 'create'])->name('faculty_login');
    Route::post('/faculty/login', [FacultySessionController::class, 'store']);

    Route::get('/faculty/forgot-password', [ForgotPasswordController::class, 'create'])->name('auth.forgot-password.create');
    Route::post('/faculty/forgot-password', [ForgotPasswordController::class, 'store'])->name('auth.forgot-password.store');
    Route::get('/faculty/new-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/faculty/new-password', [ResetPasswordController::class, 'store'])->name('password.reset.store');

});

Route::middleware('auth')->group(function () {

    Route::post('/faculty/logout', [FacultySessionController::class, 'destroy'])->name('faculty_logout');

    Route::middleware(['role:admin'])->group(function () { // Routes for admin
        /*
        |-----------------------------------------------------------------------------
        |
        |
        |   Administration Role
        |
        |
        |-----------------------------------------------------------------------------
        */

        Route::get('/admin/home', function () {
            return view('admin.dashboard', [
                'total_employees' => Faculty::all()->count(),
            ]);
        })->name('admin.index');

        /*
        |   Search Routes
        */
        Route::get('/admin/employees/search', [FacultyController::class, 'search'])                             ->name('admin_employees_search');
        Route::get('/admin/config/shift/search', [ShiftController::class, 'search'])                          ->name('admin.config.shift.search');

        /*
        |   Employee Management Routes
        */
        Route::get('/admin/employees', [FacultyController::class, 'index'])                                     ->name('employees.index');
        Route::get('/admin/employees/create', [FacultyController::class, 'create'])                             ->name('employees.create');
        Route::post('/admin/employees', [FacultyController::class, 'store'])                                    ->name('employees.store');
        Route::get('/admin/employees/{faculty}', [FacultyController::class, 'show'])                            ->name('employees.show');
        Route::get('/admin/employees/{faculty}/edit', [FacultyController::class, 'edit'])                       ->name('employees_edit');
        Route::patch('/admin/employees/{faculty}', [FacultyController::class, 'update'])                        ->name('employees_update');
        Route::delete('/admin/employees/{faculty}/delete', [FacultyController::class, 'destroy'])               ->name('employees_destroy');

        /*
        |   Attendance Routes
        */
        Route::get('/admin/attendances', [AttendanceController::class, 'index'])                                ->name('admin.attendances.index');
        Route::get('/admin/attendances/report', [AttendanceController::class, 'report'])                        ->name('admin.attendances.report');

        /*
        |   Leave Routes
        */
        Route::get('/admin/leaves', [AdminLeaveController::class, 'index'])                                     ->name('admin.leaves.index');
        Route::get('/admin/leaves/create', [AdminLeaveController::class, 'create'])                             ->name('admin.leaves.create');
        Route::patch('/admin/leave/status/action', [AdminLeaveController::class, 'statusAction'])              ->name('staff.leave.statusAction');

        Route::get('/admin/service-credits',[ServiceCreditController::class, 'index'])                          ->name('admin.service-credits.index');

        /*
        |   Configuration Routes
        */
        Route::get('/admin/config/company_details', [CompanyDetailController::class, 'index'])                  ->name('admin.config.company_details.index');
        Route::post('/admin/config/company_details', [CompanyDetailController::class, 'store'])                 ->name('admin.config.company_details.store');
        Route::patch('/admin/config/company_details', [CompanyDetailController::class, 'update'])               ->name('admin.config.company_details.update');

        Route::get('/admin/config/department', [DepartmentController::class, 'index'])                          ->name('admin.config.department.index');
        Route::post('/admin/config/department/store', [DepartmentController::class, 'store'])                   ->name('admin.config.department.store');
        Route::patch('/admin/config/department/{department}', [DepartmentController::class, 'update'])          ->name('admin.config.department.update');
        Route::delete('/admin/config/department/{department}/delete', [DepartmentController::class, 'destroy']) ->name('admin.config.department.destroy');

        Route::get('/admin/config/position', [PositionController::class, 'index'])                              ->name('admin.config.position.index');

        Route::get('/admin/config/shift', [ShiftController::class, 'index'])                                    ->name('admin.config.shift.index');
        Route::post('/admin/config/shift/store', [ShiftController::class, 'store'])                             ->name('admin.config.shift.store');
        Route::patch('/admin/config/shift/{shift}', [ShiftController::class, 'update'])                         ->name('admin.config.shift.update');
        Route::delete('/admin/config/shift/{shift}/delete', [ShiftController::class, 'destroy'])                ->name('admin.config.shift.destroy');


    });





    Route::middleware(['role:faculty'])->group(function () {
        /*
        |--------------------------------------------------------------------------
        | Faculty Role
        |--------------------------------------------------------------------------
        */

        Route::get('/staff/home', function() {
            return view('staff.dashboard', []);
        })->name('staff.index');
    });

});
