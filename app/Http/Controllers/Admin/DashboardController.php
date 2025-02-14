<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Faculty;
use App\Models\Attendance;
use App\Models\FacultyAccountInformation\Department;
use App\Models\Leave;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

        $total_employees = Faculty::all()->count();
        $total_present_today = Attendance::whereDate('created_at', today())->whereIn('status',['present','late'])->count();
        $total_absent_today = Attendance::whereDate('created_at', today())->where('status', 'absent')->count();
        $total_leave_today = Leave::whereDate('created_at', today())->count();
        $announcements = Announcement::latest()->take(3)->get();

        $department_count = Department::with(['designations.faculties'])
        ->get()
            ->mapWithKeys(function ($department) {
                $facultyCount = $department->designations->sum(function ($designation) {
                    return $designation->faculties->count();
                });

                return [$department->name => $facultyCount];
            });

        $attendance_count = Attendance::whereDate('created_at', today())
            ->get()
            ->groupBy('status')
            ->mapWithKeys(fn($items, $status) => [$status => $items->count()]);

        $mappedAnnouncements = $announcements->map(function ($annc) {
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
            'totalAbsentToday' => $total_absent_today,
            'totalLeaveToday' => $total_leave_today,
            'announcements' => $mappedAnnouncements,
            'departmentCount' => $department_count,
            'attendanceCount' => $attendance_count,
        ]);
    }




}
