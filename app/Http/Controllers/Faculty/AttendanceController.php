<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Faculty;
use App\Models\Shift;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $faculties = Faculty::with('personal_information')->paginate(5);

        if ($request->has('department') || $request->has('shift') || $request->has('attendance_date')) {

            if (request('department') || request('shift')) {

                $faculties = Faculty::with('department', 'shift')
                    ->whereHas('department', function ($query) use ($request) {
                        $query->where('department_id', $request->get('department'));
                    })
                    ->orWhereHas('shift', function ($query) use ($request) {
                        $query->where('shift_id', $request->get('shift'));
                    })
                    ->paginate(5);
            }

        }

        return Inertia::render('Faculty/Attendance/Index');
    }


    public function create(Request $request)
    {
        $shift_id = Auth::user()->select('id', 'shift_id')->get()->first();


        $shift = Shift::where('id', $shift_id->shift_id)->select('name', 'from', 'to')->get()->first();
        return Inertia::render('Faculty/Attendance/Create', [
            'shift' => $shift,
        ]);

    }
}
