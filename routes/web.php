<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Auth\FacultySessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return redirect()->route('login.create');
})->name('/');


Route::get('/faculty/login', [FacultySessionController::class, 'create'])->name('login.create');
Route::post('/faculty/login', [FacultySessionController::class, 'store'])->name('login.store');


Route::middleware('auth')->group(function () {

    Route::post('/faculty/logout', [FacultySessionController::class, 'destroy'])->name('login.destroy');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/faculty/create', [FacultyController::class, 'create'])->name('faculty.create');

});
