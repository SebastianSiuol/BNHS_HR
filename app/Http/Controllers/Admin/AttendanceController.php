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
        [$auth_faculty_roles, $auth_department_id] = $this->getAuthRoleAndDept();

        $facultiesQuery = Faculty::select('id', 'faculty_code', 'shift_id', 'designation_id')
            ->with([
                'personal_information' => fn($query) => $query->select('faculty_id', 'first_name', 'last_name'),
                'shift' => fn($query) => $query->select('id', 'name'),
                'current_attendance',
                'designation' => fn($query) => $query->select('id', 'department_id')
                    ->with(['department' => fn($deptQuery) => $deptQuery->select('id', 'name')]),
            ]);

        if ($auth_faculty_roles->contains('hr_manager')) {
            $facultiesQuery->whereHas('designation.department', fn($query) => $query->where('id', $auth_department_id));
        }

        $faculties = $facultiesQuery->paginate(5);

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

        $today = Carbon::now()->timezone('Asia/Manila');

        $attendance = Attendance::where('faculty_id', $faculty_id)
            ->whereDate('created_at', $today)
            ->first();


        $shift = Shift::where('id', $shift_id)
            ->select('name', 'from', 'to')
            ->first();


        return Inertia::render('Admin/Attendance/Create', [
            'shift' => $shift,
            'attendance' => $attendance,
        ]);
    }


    public function report(Request $request)
    {
        [$auth_roles, $auth_dept_id] = $this->getAuthRoleAndDept();

        $facultiesQuery = $this->getAttendanceQuery();


        if ($auth_roles->contains('hr_manager')) {
            $facultiesQuery->whereHas('designation.department', fn($query) => $query->where('id', $auth_dept_id));
        }

        $faculties = $facultiesQuery->paginate(5)->withQueryString();
        $transformedFaculties = $this->transformFacultiesCollection($faculties);
        $paginatedFaculties = $faculties->setCollection($transformedFaculties);

        $departments = Department::select('id', 'name')->get();
        $shifts = Shift::select('id', 'name')->get();
        $number_of_days = $this->getMonth($request->month, $request->year);

        return Inertia::render('Admin/Attendance/IndexReport', [
            'faculties' => $paginatedFaculties,
            'departments' => $departments,
            'shifts' => $shifts,
            'noOfDays' => $number_of_days,
            'queryFilters' => [
                'department' => $request->department ?? 'default',
                'shift' => $request->shift ?? 'default',
                'month' => $request->month ?? Carbon::today()->format('m'),
                'year' => $request->year ?? Carbon::today()->format('Y'),

            ]
        ]);
    }

    public function reportFilter(Request $request)
    {
        [$auth_roles, $auth_dept_id] = $this->getAuthRoleAndDept();

        $facultiesQuery = $this->getAttendanceQuery();

        if ($request->filled('department') && $request->department != "default") {
            $facultiesQuery->whereHas('designation.department', function ($q) use ($request) {
                $q->where('id', $request->department);
            });
        }

        if ($request->filled('shift') && $request->shift != "default") {
            $facultiesQuery->where('shift_id', $request->shift);
        }

        if ($request->filled('month') && $request->filled('year')) {
            $month = $request->month;
            $year = $request->year;

            $facultiesQuery->whereHas('attendances', function ($q) use ($month, $year) {
                $q->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            })->with(['attendances' => function ($q) use ($month, $year) {
                $q->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            }]);
        }

        if ($auth_roles->contains('hr_manager')) {
            $facultiesQuery->whereHas('designation.department', fn($query) => $query->where('id', $auth_dept_id));
        }

        $faculties = $facultiesQuery->paginate(5)->withQueryString();
        $transformedFaculties = $this->transformFacultiesCollection($faculties);
        $paginatedFaculties = $faculties->setCollection($transformedFaculties);


        $departments = Department::select('id', 'name')->get();
        $shifts = Shift::select('id', 'name')->get();
        $number_of_days = $this->getMonth($request->month, $request->year);


        return Inertia::render('Admin/Attendance/IndexReport', [
            'faculties' => $paginatedFaculties,
            'departments' => $departments,
            'shifts' => $shifts,
            'noOfDays' => $number_of_days,
            'queryFilters' => [
                'department' => $request->department ?? 'default',
                'shift' => $request->shift ?? 'default',
                'month' => $request->month ?? Carbon::today()->format('m'),
                'year' => $request->year ?? Carbon::today()->format('Y'),

            ]
        ]);
    }

    public function checkIn(Request $request)
    {
        return $this->handleAttendance($request, 'checkIn');
    }

    public function checkOut(Request $request)
    {
        return $this->handleAttendance($request, 'checkOut');
    }

    public function handleAttendance(Request $request, $type)
    {
        $this->validateRequest($request);

        $faculty_id = $request->id;
        $post_time = Carbon::parse($request->postTime);

        $today = Carbon::today();

        $faculty = Faculty::find($faculty_id);

        $shift = $faculty->shift;
        if (!$shift) {
            return redirect()->back()->with(['error' => 'Shift not found for the user.'], 404);
        }

        $shift_start = Carbon::parse($shift->from)->setDate($today->year, $today->month, $today->day);
        $shift_end = Carbon::parse($shift->to)->setDate($today->year, $today->month, $today->day);


        $attendance = Attendance::where('faculty_id', $faculty_id)
            ->whereDate('created_at', $post_time->toDateString())
            ->first();

        if ($type == 'checkIn') {
            if ($attendance) {
                // If marked absent, update it for the current check-in
                if ($attendance->status === 'absent') {
                    $attendance->check_in = $post_time;
                    $attendance->status = $post_time->greaterThan($shift_start) ? 'late' : 'present';
                    $attendance->save();

                    return redirect()->back()->with(['message' => 'Absence overridden with check-in.'], 200);
                }

                return $this->redirectWithError("Already checked in for the day!", 400);
            }

            // If no attendance exists, create a new record
            $attendance = new Attendance();
            $attendance->faculty_id = $faculty_id;
            $attendance->check_in = $post_time;
            $attendance->status = $post_time->greaterThan($shift_start) ? 'late' : 'present';
            $attendance->save();

            return $this->redirectWithMessage($type, 201);
        }

        if ($type == 'checkOut') {
            if ((!$attendance) || (!$attendance->check_in && $attendance->status === 'absent')) {
                return $this->redirectWithError("You have not checked-in yet!", 400);
            }

            if ($attendance->check_out) {
                return $this->redirectWithError("Already checked out for the day!", 400);
            }

            $attendance->check_out = $post_time;
            $attendance->save();

            return $this->redirectWithMessage($type, 201);
        }

        return $this->redirectWithError("Invalid operation type.", 400);
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
        return redirect()->back()->with(['error' => $message], $status);
    }

    private function redirectWithMessage($type, $status)
    {

        switch (strtolower($type)) {
            case 'checkin':
                $message = 'Check-in successful!';
                break;
            case 'checkout':
                $message = 'Check-out successful!';
                break;
            default:
                $message = 'Invalid action!';
        }

        return redirect()->back()->with(['message' => $message], $status);
    }

    private function getAuthRoleAndDept()
    {
        $auth_dept_id = Auth::user()->designation->department_id;
        $auth_role = Auth::user()->roles->pluck('role_name');

        return [$auth_role, $auth_dept_id];
    }

    private function getAttendanceQuery()
    {
        $month = Carbon::today()->format('m');

        return Faculty::select('id', 'faculty_code', 'shift_id', 'designation_id')
            ->with([
                'personal_information' => function ($query) {
                    $query->select('faculty_id', 'first_name', 'last_name');
                },
                'attendances' => function ($query) use ($month) {
                    $query->select('id', 'faculty_id', 'check_in', 'status', 'created_at')
                        ->whereMonth('created_at', $month);
                },
                'designation' => function ($query) {
                    $query->select('id', 'department_id')
                        ->with(['department' => function ($deptQuery) {
                            $deptQuery->select('id', 'name');
                        }]);
                },
            ]);
    }

    private function transformFacultiesCollection($faculties)
    {
        $transformedCollection = $faculties->getCollection()->map(function ($faculty) {
            return [
                'faculty_code' => $faculty->faculty_code,
                'personal_information' => [
                    'first_name' => $faculty->personal_information->first_name,
                    'last_name' => $faculty->personal_information->last_name,
                ],
                'check_in_dates' => $faculty->attendances->pluck('check_in')->toArray(),
                'status' => $faculty->attendances->pluck('status', 'created_at')->toArray(),
            ];
        });


        return $transformedCollection;
    }

    private function getMonth($month = null, $year = null)
    {
        if ($year === null && $month === null) {
            $date = Carbon::now();
        } else {
            $date = Carbon::createFromDate($year, $month, 1);
        }

        return $date->daysInMonth();
    }
}
