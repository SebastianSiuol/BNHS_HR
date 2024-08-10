<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/staff/log_in', function(){
    return view('staff_login');
});

Route::get('/admin/log_in', function(){
    return view('admin_login');
});
