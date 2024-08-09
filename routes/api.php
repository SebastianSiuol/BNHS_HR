<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\URL;

//Authentication Service
Route::post("/register", [ApiController::class, "register"]);

Route::post("/login", [ApiController::class, "login"]);

Route::get("/send-email", [ApiController::class, "sendemail"]);

Route::group(["middleware" => ["auth:sanctum"]], function() {
    Route::get("/logout", [ApiController::class, "logout"]);
});
//Authentication Service



