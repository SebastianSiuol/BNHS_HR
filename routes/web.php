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
use App\Http\Controllers\Admin\Configuration\LeaveController as LeaveConfigController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Api\DepartmentApiController;
use App\Http\Controllers\Api\DesignationApiController;
use App\Http\Controllers\Api\FacultyApiController;
use App\Http\Controllers\Api\PositionApiController;
use App\Http\Controllers\Api\ShiftApiController;
use App\Http\Controllers\ChildrenMemberController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\JWTRedirectController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ParentMemberController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RPMSConfigurationController;
use App\Http\Controllers\SpouseMemberController;
use App\Http\Controllers\SystemOptionsController;
use App\Http\Controllers\VoluntaryWorkController;
use App\Http\Controllers\WorkExperienceController;
use App\Models\ParentMember;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login.create');
})->name('/');


Route::get('/faculty/login', [FacultySessionController::class, 'create'])                                               ->name('login.create');
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])                                             ->name('auth.forgot-password.create');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])                                             ->name('auth.forgot-password.store');
Route::get('/reset-password', [ResetPasswordController::class, 'create'])                                               ->name('auth.reset-password.create');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])                                               ->name('auth.reset-password.store');
Route::post('/faculty/login', [FacultySessionController::class, 'store'])                                               ->name('login.store');


Route::middleware('auth')->group(function () {

    Route::post('/session/logout', [FacultySessionController::class, 'destroy'])                                        ->name('session.destroy');

    Route::middleware('redirUnauthUser')->group(function () {



        /**
         * ===============================================================================
         *
         * Admin Routes
         *
         * ===============================================================================
         *
         */
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])                                        ->name('admin.dashboard');

            // Faculties
            Route::get('/faculties', [FacultyController::class, 'index'])                                               ->name('admin.faculty.index');
            Route::get('/faculty/create', [FacultyController::class, 'create'])                                         ->name('admin.faculty.create');
            Route::get('/faculty/{faculty}/edit/personal-info', [FacultyController::class, 'editPsnDeets'])             ->name('admin.faculty.edit.psn-deets');
            Route::get('/faculty/{faculty}/edit/address', [FacultyController::class, 'editAddress'])                    ->name('admin.faculty.edit.address');
            Route::get('/faculty/{faculty}/edit/company-details', [FacultyController::class, 'editCompDeets'])          ->name('admin.faculty.edit.comp-deets');
            Route::get('/faculty/{faculty}/edit/roles', [FacultyController::class, 'editRoles'])                        ->name('admin.faculty.edit.roles');
            Route::put('/faculty/{public_id}/personal-info', [FacultyController::class, 'updatePsnDeets'])              ->name('admin.faculty.update.psn-deets');
            Route::put('/faculty/{public_id}/address', [FacultyController::class, 'updateAddresses'])                   ->name('admin.faculty.update.address');
            Route::put('/faculty/{public_id}/company-details', [FacultyController::class, 'updateCompDeets'])           ->name('admin.faculty.update.comp-deets');
            Route::put('/faculty/{public_id}/roles', [FacultyController::class, 'updateRoles'])                         ->name('admin.faculty.update.roles');
            Route::delete('/faculty/{faculty}', [FacultyController::class, 'destroy'])                                  ->name('admin.faculty.destroy');
            Route::post('/faculty/store', [FacultyController::class, 'store'])                                          ->name('admin.faculty.store');
            Route::get('/faculty/search', [FacultyController::class, 'search'])                                         ->name('admin.faculty.search');

            // Attendances
            Route::get('/attendances/check', [AttendanceController::class, 'create'])                                   ->name('admin.attendances.create');
            Route::get('/attendances', [AttendanceController::class, 'index'])                                          ->name('admin.attendances.index');
            Route::get('/attendances/report', [AttendanceController::class, 'report'])                                  ->name('admin.attendances.report');
            Route::get('/attendances/report/filter', [AttendanceController::class, 'reportFilter'])                     ->name('admin.attendances.report.filter');
            Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])                               ->name('admin.attendances.check-in');
            Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])                             ->name('admin.attendances.check-out');

            // Leaves
            Route::get('/leave/create', [LeaveController::class, 'create'])                                             ->name('admin.leaves.create');
            Route::get('/leaves', [LeaveController::class, 'index'])                                                    ->name('admin.leaves.index');
            Route::get('/leaves/manage', [LeaveController::class, 'manage'])                                            ->name('admin.leaves.manage');
            Route::post('/leave/store', [LeaveController::class, 'store'])                                              ->name('admin.leaves.store');
            Route::patch('/leave/manage/{leave}/action', [LeaveController::class, 'leaveAction'])                       ->name('admin.leaves.manage.action');

            // Service Credits
            Route::get('/service-credits', [ServiceCreditController::class, 'index'])                                   ->name('admin.service-credits.index');
            Route::post('/service-credits/calc', [ServiceCreditController::class, 'storeCalc'])                         ->name('admin.service-credits.store.calc');
            Route::post('/service-credits/mnl-adjust', [ServiceCreditController::class, 'mnlAdjust'])                   ->name('admin.service-credits.store.adjust');
            Route::get('/service-credits/report', [ServiceCreditController::class, 'report'])                           ->name('admin.service-credits.report');

            // RPMS
            Route::get('/rpms', [RPMSController::class, 'index'])                                                       ->name('admin.rpms.index');
            Route::get('/rpms/{id}/show', [RPMSController::class, 'show'])                                              ->name('admin.rpms.show');
            Route::get('/rpms/search', [RPMSController::class, 'search'])                                               ->name('admin.rpms.search');
            Route::post('/rpms/config/set-date', [RPMSConfigurationController::class, 'store'])                         ->name('admin.rpms.config.store');

            // Configurations
            Route::prefix('config')->group(function () {
                Route::get('/company-details', [CompanyDetailController::class, 'index'])                               ->name('admin.config.company-details.index');
                Route::post('/company-details', [CompanyDetailController::class, 'store'])                              ->name('admin.config.company-details.store');
                Route::patch('/company-details', [CompanyDetailController::class, 'update'])                            ->name('admin.config.company-details.update');

                Route::get('/departments', [DepartmentController::class, 'index'])                                      ->name('admin.config.department.index');
                Route::post('/department', [DepartmentController::class, 'store'])                                      ->name('admin.config.department.store');
                Route::patch('/department/{department}', [DepartmentController::class, 'update'])                       ->name('admin.config.department.update');
                Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])                     ->name('admin.config.department.destroy');

                Route::get('/position', [SchoolPositionController::class, 'index'])                                     ->name('admin.config.position.index');
                Route::post('/position', [SchoolPositionController::class, 'store'])                                    ->name('admin.config.position.store');
                Route::patch('/position/{school_position}', [SchoolPositionController::class, 'update'])                ->name('admin.config.position.update');
                Route::delete('/position/{school_position}', [SchoolPositionController::class, 'destroy'])              ->name('admin.config.position.destroy');

                Route::get('/leave', [LeaveConfigController::class, 'index'])                                           ->name('admin.config.leave.index');
                Route::post('/leave', [LeaveConfigController::class, 'store'])                                          ->name('admin.config.leave.store');
                Route::patch('/leave/{leave}', [LeaveConfigController::class, 'update'])                                ->name('admin.config.leave.update');
                Route::delete('/leave/{leave}', [LeaveConfigController::class, 'destroy'])                              ->name('admin.config.leave.destroy');

                Route::get('/shift', [ShiftController::class, 'index'])                                                 ->name('admin.config.shift.index');
                Route::post('/shift', [ShiftController::class, 'store'])                                                ->name('admin.config.shift.store');
                Route::patch('/shift/{shift}', [ShiftController::class, 'update'])                                      ->name('admin.config.shift.update');
                Route::delete('/shift/{shift}', [ShiftController::class, 'destroy'])                                    ->name('admin.config.shift.destroy');

                Route::get('/roles', [RoleController::class, 'index'])                                                  ->name('admin.config.role.index');

                Route::patch('/roles/{faculty}/update', [RoleController::class, 'update'])                              ->name('admin.config.role.update');
            });
        });

        /**
         * ===============================================================================
         *
         * Faculty Routes
         *
         * ===============================================================================
         *
         */

        Route::get('/faculty/systems/options', [SystemOptionsController::class, 'index'])                               ->name('faculty.systems.options');

        Route::get('/faculty/dashboard', [FacultyDashboardController::class, 'index'])                                  ->name('faculty.dashboard');

        // Faculty
        Route::get('/faculty/leave/create', [LeaveController::class, 'create'])                                         ->name('faculty.leaves.create');
        Route::get('/faculty/leaves', [LeaveController::class, 'index'])                                                ->name('faculty.leaves.index');
        Route::post('/faculty/leave/store', [LeaveController::class, 'store'])                                          ->name('faculty.leaves.store');

        // RPMS
        Route::get('/faculty/rpms', [FacultyRPMSController::class, 'index'])                                            ->name('faculty.rpms.index');
        Route::get('/faculty/rpms/search', [FacultyRPMSController::class, 'search'])                                    ->name('faculty.rpms.search');
        Route::post('/faculty/rpms', [FacultyRPMSController::class, 'store'])                                           ->name('faculty.rpms.store');
        Route::get('/faculty/rpms/{file}', [FacultyRPMSController::class, 'viewFile'])                                  ->name('faculty.rpms.file.view');
        Route::get('/faculty/rpms/download/{file}', [FacultyRPMSController::class, 'download'])                         ->name('faculty.rpms.file.download');
        Route::delete('/faculty/rpms/{file}', [FacultyRPMSController::class, 'destroy'])                                ->name('faculty.rpms.delete');


        // Attendances
        Route::get('/faculty/attendances', [FacultyAttendanceController::class, 'index'])                               ->name('faculty.attendance.index');
        Route::post('/faculty/attendance/check-in', [FacultyAttendanceController::class, 'checkIn'])                    ->name('faculty.attendances.check-in');
        Route::post('/faculty/attendance/check-out', [FacultyAttendanceController::class, 'checkOut'])                  ->name('faculty.attendances.check-out');

        //Personal Details
        Route::get('/faculty/personal-details', [PersonalDetailsController::class, 'index'])                            ->name('faculty.personal-details.index');


        /**
         * ===============================================================================
         *
         * API Routes
         *
         * ===============================================================================
         *
         */

        Route::middleware('validate.api.req')->group(function () {


            Route::get('/civil-service/all', [CivilServiceController::class, 'all'])                                    ->name('api.civil-service.all');
            Route::get('/work-experience/all', [WorkExperienceController::class, 'all'])                                ->name('api.work-experience.all');
            Route::get('/voluntary-work/all', [VoluntaryWorkController::class, 'all'])                                  ->name('api.voluntary-work.all');
            Route::get('/learning-and-development/all', [LearningAndDevelopmentController::class, 'all'])               ->name('api.learning-and-development.all');
            Route::get('/other-information/all', [OtherInformationController::class, 'all'])                            ->name('api.other-information.all');


            Route::get('/spouse-member', [SpouseMemberController::class, 'get'])                                        ->name('spouse-member.get');
            Route::get('/parent-member', [ParentMemberController::class, 'get'])                                        ->name('parent-member.get');
            Route::get('/child-member', [ChildrenMemberController::class, 'get'])                                       ->name('child-member.get');

            Route::get('/educational-background', [EducationalBackgroundController::class, 'get'])                      ->name('educ-bg.get');
        });
    });

    /**
     * ===============================================================================
     *
     * General Routes
     *
     * ===============================================================================
     *
     */

    Route::post('/announcement', [AnnouncementController::class, 'store'])                                              ->name('announcement.store');
    Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])                           ->name('announcement.destroy');

    Route::patch('/personal-information/edit', [PersonalDetailsController::class, 'update'])                            ->name('personal-information.edit.update');
    Route::patch('/civil-service', [CivilServiceController::class, 'update'])                                           ->name('civil-service.update');
    Route::patch('/work-experience', [WorkExperienceController::class, 'update'])                                       ->name('work-experience.update');
    Route::patch('/voluntary-work', [VoluntaryWorkController::class, 'update'])                                         ->name('voluntary-work.update');
    Route::patch('/learning-and-development', [LearningAndDevelopmentController::class, 'update'])                      ->name('learning-and-development.update');
    Route::patch('/other-information', [OtherInformationController::class, 'update'])                                   ->name('other-information.update');

    Route::patch('/spouse-member', [SpouseMemberController::class, 'update'])                                           ->name('spouse-member.update');
    Route::patch('/parent-member', [ParentMemberController::class, 'update'])                                           ->name('parent-member.update');
    Route::patch('/child-member', [ChildrenMemberController::class, 'update'])                                          ->name('child-member.update');

    Route::patch('/educational-background', [EducationalBackgroundController::class, 'update'])                         ->name('educ-bg.update');

    Route::patch('/leave/{leave_id}/cancel', [LeaveController::class, 'cancel'])                                        ->name('leaves.patch.cancel');
    Route::get('/leaves/{leave_id}', [LeaveController::class, 'show'])                                                  ->name('leaves.show');

    Route::get('/get-departments', [DepartmentApiController::class, 'get'])                                             ->name('api.get.departments');
    Route::get('/get-positions', [PositionApiController::class, 'get'])                                                 ->name('api.get.positions');
    Route::get('/get-shifts', [ShiftApiController::class, 'get'])                                                       ->name('api.get.shifts');
    Route::get('/get-head/{department}', [FacultyApiController::class, 'getHead'])                                      ->name('api.get.head');
    Route::get('/get-designations/{department}', [DesignationApiController::class, 'get'])                              ->name('api.get.designations');

});


Route::get('/redirect/admin/sis', [JWTRedirectController::class, 'sisAdmin'])                                           ->name('sis.admin.redirect');
Route::get('/redirect/registrar/sis', [JWTRedirectController::class, 'sisRegistrar'])                                   ->name('sis.registrar.redirect');
Route::get('/redirect/faculty/sis', [JWTRedirectController::class, 'sisFaculty'])                                       ->name('sis.faculty.redirect');

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
