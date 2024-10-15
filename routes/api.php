<?php

use App\Http\Controllers\Api\FacultyApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiKeyMiddleware;

//Authentication Service
Route::middleware(ApiKeyMiddleware::class)->group(function () {

    Route::get("v4/retrieve/faculty", [FacultyApiController::class, "index"]);

//    Route::post("/register", [ApiController::class, "register"]);
//    Route::post("/login", [ApiController::class, "login"]);
//    Route::group(["middleware" => ["auth:sanctum"]], function() {
//        Route::get("/logout", [ApiController::class, "logout"]);
//    });
});



