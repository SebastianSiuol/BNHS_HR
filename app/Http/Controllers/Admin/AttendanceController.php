<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// Models
use App\Models\Attendance;
use App\Models\FacultyAccountInformation\Department;
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


        $faculties = Faculty::select('id','faculty_code', 'shift_id')
        ->with([
            'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name'),
            'shift' => fn($query) => $query->select('id', 'name'),
            'current_attendance'
        ])
        ->paginate(5);


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

        $departments = Department::all()->select('id', 'name');
        $shift = Shift::all()->select('id', 'name');

        return Inertia::render('Admin/Attendance/Index', [
            'faculties' => $faculties,
            'departments' => $departments,
            'shifts' => $shift,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty_id = Auth::user()->id;
        $shift_id = Auth::user()->shift_id;

        $today = Carbon::now()->timezone('GMT+8');

        $attendance = Attendance::where('faculty_id', $faculty_id)
            ->whereDate('check_in', $today)
            ->first();


        $shift = Shift::where('id', $shift_id)
            ->select('name', 'from', 'to')
            ->first();

        return Inertia::render('Admin/Attendance/Create', [
            'shift' => $shift,
            'attendance' => $attendance,
        ]);
    }


    public function report()
    {

        // Fetch paginated faculties with related data
        $faculties = Faculty::select('id', 'faculty_code', 'shift_id')
            ->with([
                'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name'),
                'attendances' => fn($query) => $query->select('id', 'faculty_id', 'check_in'),
            ])
            ->paginate(5); // Use pagination here

        // Transform the paginated data
        $transformedFaculties = $faculties->getCollection()->map(function ($faculty) {
            return [
                'faculty_code' => $faculty->faculty_code,
                'personal_information' => [
                    'first_name' => $faculty->personal_information->first_name,
                    'last_name' => $faculty->personal_information->last_name,
                ],
                'check_in_dates' => $faculty->attendances->pluck('check_in')->toArray(), // Extract check-in dates
            ];
        });


        // Replace the paginated collection with the transformed data
        $paginatedFaculties = $faculties->setCollection($transformedFaculties);

        $departments = Department::all()->select('id', 'name');
        $shift = Shift::all()->select('id', 'name');

        $number_of_days = Carbon::today()->daysInMonth();


        return Inertia::render('Admin/Attendance/IndexReport', [
            'faculties' => $paginatedFaculties,
            'departments' => $departments,
            'shifts' => $shift,
            'noOfDays' => $number_of_days,
        ]);


    }

    public function checkIn(Request $request)
    {
        return $this->handleAttendance($request, 'check_in');
    }

    public function checkOut(Request $request)
    {
        return $this->handleAttendance($request, 'check_out');
    }

    public function handleAttendance(Request $request, $type)
    {
        $validated = $this->validateRequest($request);
        $user_id = $validated['id'];
        $post_time = Carbon::parse($validated['postTime']);

        $faculty = Faculty::find($user_id);
        if (!$faculty) {
            return $this->redirectWithError('User not found.', 404);
        }

        $attendance = Attendance::where('faculty_id', $user_id)
            ->whereDate('check_in', $post_time->toDateString())
            ->first();

        if ($type == 'check_in') {
            if ($attendance) {
                return $this->redirectWithError("Already checked in for the day!", 400);
            }

            $attendance = new Attendance();
            $attendance->faculty_id = $user_id;
            $attendance->check_in = $post_time;
            $attendance->status = 'present';
            $attendance->save();
        }

        if ($type == 'check_out') {
            if (!$attendance) {
                return $this->redirectWithError("No check-in record found for today!", 400);
            }

            if ($attendance->check_out) {
                return $this->redirectWithError("Already checked out for the day!", 400);
            }

            $attendance->check_out = $post_time;
            $attendance->save();
        }

        return $this->redirectWithMessage($type, $attendance, 201);
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'id' => ['required'],
            'shiftTime' => ['required'],
            'postTime' => ['required'],
            'action' => ['required'],
        ]);
    }

    private function redirectWithError($message, $status)
    {
        return redirect()->route('admin.attendances.create')->with(['error' => $message], $status);
    }

    private function redirectWithMessage($type, $attendance, $status)
    {
        switch ($type){
            case 'check_in':
                $message = 'Check-in successful!';
            case 'check_out':
                $message = 'Check-out successful!';
        }

        return redirect()->route('admin.attendances.create')->with(['message' => $message, 'attendance' => $attendance], $status);
    }
}
