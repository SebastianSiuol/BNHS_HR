<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\CivilServiceController;
use App\Http\Controllers\Faculty\DashboardController as FacultyDashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\LearningAndDevelopmentController;
use App\Http\Controllers\OtherInformationController;
use App\Http\Controllers\RPMSController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Faculty\RPMSController as FacultyRPMSController;
use App\Http\Controllers\Faculty\AttendanceController as FacultyAttendanceController;
use App\Http\Controllers\Faculty\PersonalDetailsController;

// Admin Controllers
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\ServiceCreditController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Configurations
use App\Http\Controllers\Admin\Configuration\CompanyDetailController;
use App\Http\Controllers\Admin\Configuration\DepartmentController;
use App\Http\Controllers\Admin\Configuration\SchoolPositionController;
use App\Http\Controllers\Admin\Configuration\ShiftController;
use App\Http\Controllers\Admin\Configuration\RoleController;

use App\Http\Controllers\JWTRedirectController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RPMSConfigurationController;
use App\Http\Controllers\SpouseMemberController;
use App\Http\Controllers\VoluntaryWorkController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login.create');
})->name('/');


Route::get('/faculty/login', [FacultySessionController::class, 'create'])                           ->name('login.create');
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])                         ->name('auth.forgot-password.create');
Route::get('/forgot-password', [ForgotPasswordController::class, 'store'])                         ->name('auth.forgot-password.store');
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
    Route::get('/admin/leaves/manage', [LeaveController::class, 'manage'])                                              ->name('admin.leaves.manage');
    Route::post('/admin/leave/store', [LeaveController::class, 'store'])                                                ->name('admin.leaves.store');
    Route::patch('/admin/leave/{leave}/cancel', [LeaveController::class, 'cancel'])                                     ->name('admin.leaves.patch.cancel');
    Route::patch('/admin/leave/manage/{leave}/action', [LeaveController::class, 'leaveAction'])                         ->name('admin.leaves.manage.action');

    // Service Credits
    Route::get('/admin/service-credits', [ServiceCreditController::class, 'index'])                                     ->name('admin.service-credits.index');
    Route::post('/admin/service-credits/calc', [ServiceCreditController::class, 'storeCalc'])                           ->name('admin.service-credits.store.calc');
    Route::post('/admin/service-credits/mnl-adjust', [ServiceCreditController::class, 'mnlAdjust'])                     ->name('admin.service-credits.store.adjust');
    Route::get('/admin/service-credits/report', [ServiceCreditController::class, 'report'])                             ->name('admin.service-credits.report');

    // RPMS
    Route::get('/admin/rpms', [RPMSController::class, 'index'])                                                         ->name('admin.rpms.index');
    Route::post('/admin/rpms/config/set-date', [RPMSConfigurationController::class, 'store'])                           ->name('admin.rpms.config.store');

    Route::middleware('assign.api.key.req')->group(function () {

    // Configurations
    Route::get('/admin/config/company-details', [CompanyDetailController::class, 'index'])                              ->name('admin.config.company-details.index');
    Route::post('/admin/config/company-details', [CompanyDetailController::class, 'store'])                             ->name('admin.config.company-details.store');
    Route::patch('/admin/config/company-details', [CompanyDetailController::class, 'update'])                           ->name('admin.config.company-details.update');

    Route::get('/admin/config/departments', [DepartmentController::class, 'index'])                                     ->name('admin.config.department.index');
    Route::post('/admin/config/department', [DepartmentController::class, 'store'])                                     ->name('admin.config.department.store');
    Route::patch('/admin/config/department/{department}', [DepartmentController::class, 'update'])                      ->name('admin.config.department.update');
    Route::delete('/admin/config/department/{department}', [DepartmentController::class, 'destroy'])                    ->name('admin.config.department.destroy');

    Route::get('/admin/config/position', [SchoolPositionController::class, 'index'])                                    ->name('admin.config.position.index');
    Route::post('/admin/config/position', [SchoolPositionController::class, 'store'])                                   ->name('admin.config.position.store');
    Route::patch('/admin/config/position/{school_position}', [SchoolPositionController::class, 'update'])               ->name('admin.config.position.update');
    Route::delete('/admin/config/position/{school_position}', [SchoolPositionController::class, 'destroy'])             ->name('admin.config.position.destroy');

    Route::get('/admin/config/shift', [ShiftController::class, 'index'])                                                ->name('admin.config.shift.index');
    Route::post('/admin/config/shift', [ShiftController::class, 'store'])                                               ->name('admin.config.shift.store');
    Route::patch('/admin/config/shift/{shift}', [ShiftController::class, 'update'])                                     ->name('admin.config.shift.update');
    Route::delete('/admin/config/shift/{shift}', [ShiftController::class, 'destroy'])                                   ->name('admin.config.shift.destroy');

    Route::get('/admin/config/roles', [RoleController::class, 'index'])                                                 ->name('admin.config.role.index');

    Route::patch('/admin/config/roles/{faculty}/update', [RoleController::class, 'update'])                             ->name('admin.config.role.update');
});


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
    Route::get('/faculty/rpms/search', [FacultyRPMSController::class, 'search'])                                        ->name('faculty.rpms.search');
    Route::post('/faculty/rpms', [FacultyRPMSController::class, 'store'])                                               ->name('faculty.rpms.store');
    Route::get('/faculty/rpms/{file}', [FacultyRPMSController::class, 'viewFile'])                                      ->name('faculty.rpms.file.view');
    Route::get('/faculty/rpms/download/{file}', [FacultyRPMSController::class, 'download'])                             ->name('faculty.rpms.file.download');
    Route::delete('/faculty/rpms/{file}', [FacultyRPMSController::class, 'destroy'])                                    ->name('faculty.rpms.delete');


    // Attendances
    Route::get('/faculty/attendances/create', [FacultyAttendanceController::class, 'create'])                           ->name('faculty.attendance.create');

    //Personal Details
    Route::get('/faculty/personal-details', [PersonalDetailsController::class, 'index'])                                ->name('faculty.personal-details.index');


    /**
     * ===============================================================================
     *
     * API Routes
     *
     * ===============================================================================
     *
     */

        Route::middleware('validate.api.req')->group(function () {
            Route::middleware('intApiKey')->group(function () {


            });
                Route::get('/civil-service/all', [CivilServiceController::class, 'all'])                                ->name('api.civil-service.all');
                Route::get('/work-experience/all', [WorkExperienceController::class, 'all'])                            ->name('api.work-experience.all');
                Route::get('/voluntary-work/all', [VoluntaryWorkController::class, 'all'])                              ->name('api.voluntary-work.all');
                Route::get('/learning-and-development/all', [LearningAndDevelopmentController::class, 'all'])           ->name('api.learning-and-development.all');
                Route::get('/other-information/all', [OtherInformationController::class, 'all'])                        ->name('api.other-information.all');

        });

    /**
     * ===============================================================================
     *
     * General Routes
     *
     * ===============================================================================
     *
    */

    Route::patch('/personal-information/edit', [PersonalDetailsController::class, 'update'])                            ->name('personal-information.edit.update');
    Route::patch('/civil-service', [CivilServiceController::class, 'update'])                                           ->name('civil-service.update');
    Route::patch('/work-experience', [WorkExperienceController::class, 'update'])                                       ->name('work-experience.update');
    Route::patch('/voluntary-work', [VoluntaryWorkController::class, 'update'])                                         ->name('voluntary-work.update');
    Route::patch('/learning-and-development', [LearningAndDevelopmentController::class, 'update'])                      ->name('learning-and-development.update');
    Route::patch('/other-information', [OtherInformationController::class, 'update'])                                   ->name('other-information.update');

    Route::patch('/spouse-member', [SpouseMemberController::class, 'update'])                                           ->name('spouse-member.update');




});


Route::get('/redirect/admin/sis', [JWTRedirectController::class, 'sisAdmin'])                                           ->name('sis.admin.redirect');
Route::get('/redirect/logistics', [JWTRedirectController::class, 'logiAdmin'])                                          ->name('logistics.admin.redirect');
Route::get('/call', [APIController::class, 'callApi']) ->name('call.api.proxy');


    /*
    / ===============================================================================
    /
    / Public Export Routes
    /
    / ===============================================================================
    */
Route::get('/export/faculties', [FacultyController::class, 'export'])                                                   ->name('faculty.export.all');
Route::get('/export/faculty/pds', [FacultyController::class, 'pds'])                                                    ->name('faculty.export.pds');
