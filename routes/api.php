<?php

use App\Http\Controllers\Api\FacultyApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiKeyMiddleware;

//Authentication Service
Route::middleware(ApiKeyMiddleware::class)->group(function () {

    Route::get("retrieve/faculty", [FacultyApiController::class, "index"]);

});



