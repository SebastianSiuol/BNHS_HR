<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Attendance;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {

        $total_employees = Faculty::all()->count();
        $total_present_today = Attendance::whereDate('check_in', today())->count();
        return Inertia::render('Admin/Dashboard', [
            'totalEmployees' => $total_employees,
            'totalPresentToday' => $total_present_today,
        ]);
    }


}
