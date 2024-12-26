<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Config/Role/Index');
    }
}
