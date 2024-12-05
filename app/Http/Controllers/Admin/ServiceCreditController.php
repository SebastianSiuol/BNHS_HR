<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ServiceCreditController extends Controller
{
    public function index () {
        return Inertia::render('Admin/ServiceCredit/Index');
    }
    public function report () {
        return Inertia::render('Admin/ServiceCredit/IndexReport');
    }
}
