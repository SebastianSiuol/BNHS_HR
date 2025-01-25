<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Faculty;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {

        $total_employees = Faculty::all()->count();
        $total_present_today = Attendance::whereDate('check_in', today())->count();
        $announcements = Announcement::latest()->take(3)->get();

        $mappedAnnouncements = $announcements->map(function ($annc){
            return [
                'id' => $annc->id,
                'title' => $annc->title,
                'description' => $annc->description,
                'fileUrl' => $annc->announcement_file ? Storage::disk('public')->url($annc->announcement_file) : null,
                'createdAt' => $annc->created_at,
            ];
        });
        return Inertia::render('Admin/Dashboard', [
            'totalEmployees' => $total_employees,
            'totalPresentToday' => $total_present_today,
            'announcements' => $mappedAnnouncements
        ]);
    }




}
