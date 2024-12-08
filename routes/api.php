<?php

use App\Http\Controllers\Api\DepartmentApiController;
use App\Http\Controllers\Api\DesignationApiController;
use App\Http\Controllers\Api\FacultyApiController;
use App\Http\Controllers\Api\PositionApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\ShiftApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('intApiKey')->group(function (){

    Route::get('/admin/faculty/create/check-email', [FacultyApiController::class, 'checkEmail'])->name('api.check.email');
    Route::get('/admin/faculty/show',[FacultyApiController::class, 'showFaculty'])->name('api.admin.faculty.show');
    Route::get('/get-departments', [DepartmentApiController::class, 'get'])->name('api.get.departments');
    Route::get('/get-positions', [PositionApiController::class, 'get'])->name('api.get.positions');
    Route::get('/get-shifts', [ShiftApiController::class, 'get'])->name('api.get.shifts');
    Route::get('/roles', [RoleApiController::class, 'get'])->name('api.roles.get');
    Route::get('/get-designations', [DesignationApiController::class, 'getDesignations'])->name('api.get.designations');

});