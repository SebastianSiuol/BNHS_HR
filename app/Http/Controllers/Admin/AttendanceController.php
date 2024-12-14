<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// Models
use App\Models\Attendance;
use App\Models\Shift;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $faculties = Faculty::with('personal_information')->paginate(5);

        if($request->has('department') || $request->has('shift') || $request->has('attendance_date')) {

            if(request('department') || request('shift')) {

                $faculties = Faculty::with('department', 'shift')
                    ->whereHas('department', function ($query) use($request) {
                        $query->where('department_id', $request->get('department'));
                    })
                    ->orWhereHas('shift', function ($query) use($request) {
                        $query->where('shift_id', $request->get('shift'));
                    })
                    ->paginate(5);
            }

        }
//        dd($faculties->isEmpty());

        // return view('admin.attendance.index', [
        //     'admin'     => Auth::user(),
        //     'faculties' => $faculties,
        //     'departments' => Department::all(),
        //     'shifts'    => Shift::all(),
        // ]);

        return Inertia::render('Admin/Attendance/Index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $shift = Auth::user()->select('id','shift_id')
        // ->with([
        //     'personal_information:id',
        //     'shift' => fn($query) => $query->select('id','from','to')
        // ])->get()->first();


            $shift_id = Auth::user()->select('id','shift_id')->get()->first();


            $shift = Shift::where('id', $shift_id->shift_id)->select('name','from','to')->get()->first();



        return Inertia::render('Admin/Attendance/Create', [
            'shift' => $shift,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function report(){
        return Inertia::render('Admin/Attendance/IndexReport');

        // return view('admin.attendance.report', [
        //     'faculties'  => Faculty::all()->first()->paginate(5)
        // ]);
    }

    public function checkIn(Request $request){

        $validated = $request->validate([
            'id' => ['required'],
            'shiftTime' => ['required'],
            'postTime' => ['required'],
            'action' => ['required'],
        ]);


        $user_id = $validated['id'];
        $post_time = Carbon::parse($validated['postTime']);


        // Check if the user exists
        $faculty = Faculty::find($user_id);
        if (!$faculty) {
            return redirect()->route('admin.attendances.create')->with(['error' => 'User not found.'], 404);
        }


        // Check if a check-in exists for the current day
        $existingAttendance = Attendance::where('faculty_id', $user_id)
            ->whereDate('check_in', $post_time->toDateString())
            ->first();

        if ($existingAttendance) {
            return redirect()->route('admin.attendances.create')->with(['error' => 'Already checked-in for the current day!'], 400);
        }


        // Create a new attendance record
        $attendance = new Attendance();
        $attendance->faculty_id = $user_id;
        $attendance->check_in = $post_time;
        $attendance->status = 'present';
        $attendance->save();

        return redirect()->route('admin.attendances.create')->with(['message' => 'Check-in successful.', 'attendance' => $attendance], 201);
    }

}
