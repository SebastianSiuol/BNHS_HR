<?php

use App\Http\Controllers\Api\FacultyApiController;
use App\Http\Controllers\Api\JWTAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiKeyMiddleware;

//Authentication Service
Route::middleware(ApiKeyMiddleware::class)->group(function () {

    /* Retrieves List */
    Route::get("retrieve/faculties", [FacultyApiController::class, "index"]);
    Route::get("v5/retrieve/faculty", [FacultyApiController::class, "v5"]);

    /* Retrieves a Single List */
    Route::get("retrieve", [FacultyApiController::class, "retrieveAFaculty"]);

    Route::post("logout", [FacultyApiController::class, "destroy"]);

    Route::post("login", [JWTAuthController::class, "store"]);
});



