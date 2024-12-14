<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Faculty\DashboardController as FacultyDashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\RPMSController;
use App\Http\Controllers\Faculty\RPMSController as FacultyRPMSController;
use App\Http\Controllers\Faculty\AttendanceController as FacultyAttendanceController;

// Admin Controllers
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\ServiceCreditController;

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

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])                      ->name('admin.dashboard');

    // Faculties
    Route::get('/admin/faculties', [FacultyController::class, 'index'])                             ->name('admin.faculty.index');
    Route::get('/admin/faculty/create', [FacultyController::class, 'create'])                       ->name('admin.faculty.create');
    Route::get('/admin/faculty/{faculty}/edit', [FacultyController::class, 'edit'])                 ->name('admin.faculty.edit');
    Route::put('/admin/faculty/{faculty}', [FacultyController::class, 'update'])                    ->name('admin.faculty.update');
    Route::delete('/admin/faculty/{faculty}', [FacultyController::class, 'destroy'])                ->name('admin.faculty.destroy');
    Route::post('/admin/faculty/store', [FacultyController::class, 'store'])                        ->name('admin.faculty.store');
    Route::get('/admin/faculty/search', [FacultyController::class, 'search'])                       ->name('admin.faculty.search');

    // Attendances
    Route::get('/admin/attendances/check', [AttendanceController::class, 'create'])                 ->name('admin.attendances.create');
    Route::get('/admin/attendances', [AttendanceController::class, 'index'])                        ->name('admin.attendances.index');
    Route::get('/admin/attendances/report', [AttendanceController::class, 'report'])                ->name('admin.attendances.report');
    Route::post('/admin/attendnace/check-in', [AttendanceController::class, 'checkIn'])             ->name('admin.attendances.check-in');
    Route::post('/admin/attendnace/check-out', [AttendanceController::class, 'checkOut'])           ->name('admin.attendances.check-out');

    // Leaves
    Route::get('/admin/leave/create', [LeaveController::class, 'create'])                           ->name('admin.leaves.create');
    Route::get('/admin/leaves', [LeaveController::class, 'index'])                                  ->name('admin.leaves.index');
    Route::get('/admin/leaves/approve', [LeaveController::class, 'approve'])                        ->name('admin.leaves.approve');
    Route::post('/admin/leave/store', [LeaveController::class, 'store'])                            ->name('admin.leaves.store');

    // Service Credits
    Route::get('/admin/service-credits', [ServiceCreditController::class, 'index'])                 ->name('admin.service-credits.index');
    Route::get('/admin/service-credits/report', [ServiceCreditController::class, 'report'])         ->name('admin.service-credits.report');

    // RPMS
    Route::get('/admin/rpms', [RPMSController::class, 'index'])                                     ->name('admin.rpms.index');
    Route::post('/admin/rpms/config/set-date', [RPMSConfigurationController::class, 'store'])       ->name('admin.rpms.config.store');




    /**
     * ===============================================================================
     *
     * Faculty Routes
     *
     * ===============================================================================
     *
    */

    Route::get('/faculty/dashboard', [FacultyDashboardController::class, 'index'])                  ->name('faculty.dashboard');

    // Faculty
    Route::get('/faculty/leaves', [LeaveController::class, 'index'])                                ->name('faculty.leaves.index');
    Route::get('/faculty/leave/create', [LeaveController::class, 'create'])                         ->name('faculty.leaves.create');
    Route::post('/faculty/leave/store', [LeaveController::class, 'store'])                          ->name('faculty.leaves.store');

    // RPMS
    Route::get('/faculty/rpms', [FacultyRPMSController::class, 'index'])                            ->name('faculty.rpms.index');

    // Attendances
    Route::get('/faculty/attendances/create', [FacultyAttendanceController::class, 'create'])       ->name('faculty.attendance.create');


});

Route::get('/redirect/admin/sis', [JWTRedirectController::class, 'sisAdmin'])                       ->name('sis.admin.redirect');
Route::get('/redirect/logistics', [JWTRedirectController::class, 'logiAdmin'])                      ->name('logistics.admin.redirect');