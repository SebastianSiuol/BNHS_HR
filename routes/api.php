<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Middleware\ApiKeyMiddleware;

//Authentication Service
Route::middleware(ApiKeyMiddleware::class)->group(function () {
    Route::post("/register", [ApiController::class, "register"]);

    Route::post("/login", [ApiController::class, "login"]);

    Route::get("/send-email", [ApiController::class, "sendemail"]);

    Route::group(["middleware" => ["auth:sanctum"]], function() {
        Route::get("/logout", [ApiController::class, "logout"]);
    });
});
//Authentication Service



