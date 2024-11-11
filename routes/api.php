<?php

use App\Http\Controllers\Api\FacultyApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiKeyMiddleware;

//Authentication Service
Route::middleware(ApiKeyMiddleware::class)->group(function () {

    Route::get("retrieve/faculties", [FacultyApiController::class, "index"]);
    Route::get("v5/retrieve/faculty", [FacultyApiController::class, "v5"]);

    Route::get("retrieve", [FacultyApiController::class, "retrieveAFaculty"]);

});



