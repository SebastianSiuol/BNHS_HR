<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\Faculty\DashboardController as FacultyDashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\RPMSController;
use App\Http\Controllers\Faculty\RPMSController as FacultyRPMSController;
use App\Http\Controllers\Faculty\AttendanceController as FacultyAttendanceController;

// Admin Controllers
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\ServiceCreditController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
// Configurations
use App\Http\Controllers\Admin\Configuration\CompanyDetailController;
use App\Http\Controllers\Admin\Configuration\DepartmentController;
use App\Http\Controllers\Admin\Configuration\DesignationController;
use App\Http\Controllers\Admin\Configuration\SchoolPositionController;
use App\Http\Controllers\Admin\Configuration\ShiftController;

use App\Http\Controllers\JWTRedirectController;
use App\Http\Controllers\RPMSConfigurationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login.create');
})->name('/');


Route::get('/faculty/login', [FacultySessionController::class, 'create'])                           ->name('login.create');
Route::post('/faculty/login', [FacultySessionController::class, 'store'])                           ->name('login.store');



Route::middleware('redirUnauthUser')->group(function () {

    Route::post('/session/logout', [FacultySessionController::class, 'destroy'])                    ->name('session.destroy');


    /**
     * ===============================================================================
     *
     * Admin Routes
     *
     * ===============================================================================
     *
    */

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])                                          ->name('admin.dashboard');

    // Faculties
    Route::get('/admin/faculties', [FacultyController::class, 'index'])                                                 ->name('admin.faculty.index');
    Route::get('/admin/faculty/create', [FacultyController::class, 'create'])                                           ->name('admin.faculty.create');
    Route::get('/admin/faculty/{faculty}/edit', [FacultyController::class, 'edit'])                                     ->name('admin.faculty.edit');
    Route::put('/admin/faculty/{faculty}', [FacultyController::class, 'update'])                                        ->name('admin.faculty.update');
    Route::delete('/admin/faculty/{faculty}', [FacultyController::class, 'destroy'])                                    ->name('admin.faculty.destroy');
    Route::post('/admin/faculty/store', [FacultyController::class, 'store'])                                            ->name('admin.faculty.store');
    Route::get('/admin/faculty/search', [FacultyController::class, 'search'])                                           ->name('admin.faculty.search');

    // Attendances
    Route::get('/admin/attendances/check', [AttendanceController::class, 'create'])                                     ->name('admin.attendances.create');
    Route::get('/admin/attendances', [AttendanceController::class, 'index'])                                            ->name('admin.attendances.index');
    Route::get('/admin/attendances/report', [AttendanceController::class, 'report'])                                    ->name('admin.attendances.report');
    Route::post('/admin/attendance/check-in', [AttendanceController::class, 'checkIn'])                                 ->name('admin.attendances.check-in');
    Route::post('/admin/attendance/check-out', [AttendanceController::class, 'checkOut'])                               ->name('admin.attendances.check-out');

    // Leaves
    Route::get('/admin/leave/create', [LeaveController::class, 'create'])                                               ->name('admin.leaves.create');
    Route::get('/admin/leaves', [LeaveController::class, 'index'])                                                      ->name('admin.leaves.index');
    Route::get('/admin/leaves/approve', [LeaveController::class, 'approve'])                                            ->name('admin.leaves.approve');
    Route::post('/admin/leave/store', [LeaveController::class, 'store'])                                                ->name('admin.leaves.store');

    // Service Credits
    Route::get('/admin/service-credits', [ServiceCreditController::class, 'index'])                                     ->name('admin.service-credits.index');
    Route::get('/admin/service-credits/report', [ServiceCreditController::class, 'report'])                             ->name('admin.service-credits.report');

    // RPMS
    Route::get('/admin/rpms', [RPMSController::class, 'index'])                                                         ->name('admin.rpms.index');
    Route::post('/admin/rpms/config/set-date', [RPMSConfigurationController::class, 'store'])                           ->name('admin.rpms.config.store');

    // Configurations
    Route::get('/admin/config/company-details', [CompanyDetailController::class, 'index'])                              ->name('admin.config.company-details.index');
    Route::post('/admin/config/company-details', [CompanyDetailController::class, 'store'])                             ->name('admin.config.company-details.store');
    Route::patch('/admin/config/company-details', [CompanyDetailController::class, 'update'])                           ->name('admin.config.company-details.update');

    Route::get('/admin/config/departments', [DepartmentController::class, 'index'])                                     ->name('admin.config.department.index');
    Route::post('/admin/config/department', [DepartmentController::class, 'store'])                                     ->name('admin.config.department.store');
    Route::patch('/admin/config/department/{department}', [DepartmentController::class, 'update'])                      ->name('admin.config.department.update');
    Route::delete('/admin/config/department/{department}/delete', [DepartmentController::class, 'destroy'])             ->name('admin.config.department.destroy');

    Route::get('/admin/config/position', [SchoolPositionController::class, 'index'])                                    ->name('admin.config.position.index');
    Route::post('/admin/config/position/store', [SchoolPositionController::class, 'store'])                             ->name('admin.config.position.store');
    Route::patch('/admin/config/position/{school_position}', [SchoolPositionController::class, 'update'])               ->name('admin.config.position.update');
    Route::delete('/admin/config/position/{school_position}/delete', [SchoolPositionController::class, 'destroy'])      ->name('admin.config.position.destroy');

    Route::get('/admin/config/shift', [ShiftController::class, 'index'])                                                ->name('admin.config.shift.index');
    Route::post('/admin/config/shift/store', [ShiftController::class, 'store'])                                         ->name('admin.config.shift.store');
    Route::patch('/admin/config/shift/{shift}', [ShiftController::class, 'update'])                                     ->name('admin.config.shift.update');
    Route::delete('/admin/config/shift/{shift}/delete', [ShiftController::class, 'destroy'])                            ->name('admin.config.shift.destroy');




    /**
     * ===============================================================================
     *
     * Faculty Routes
     *
     * ===============================================================================
     *
    */

    Route::get('/faculty/dashboard', [FacultyDashboardController::class, 'index'])                                      ->name('faculty.dashboard');

    // Faculty
    Route::get('/faculty/leaves', [LeaveController::class, 'index'])                                                    ->name('faculty.leaves.index');
    Route::get('/faculty/leave/create', [LeaveController::class, 'create'])                                             ->name('faculty.leaves.create');
    Route::post('/faculty/leave/store', [LeaveController::class, 'store'])                                              ->name('faculty.leaves.store');

    // RPMS
    Route::get('/faculty/rpms', [FacultyRPMSController::class, 'index'])                                                ->name('faculty.rpms.index');

    // Attendances
    Route::get('/faculty/attendances/create', [FacultyAttendanceController::class, 'create'])                           ->name('faculty.attendance.create');


});

Route::get('/redirect/admin/sis', [JWTRedirectController::class, 'sisAdmin'])                                           ->name('sis.admin.redirect');
Route::get('/redirect/logistics', [JWTRedirectController::class, 'logiAdmin'])                                          ->name('logistics.admin.redirect');