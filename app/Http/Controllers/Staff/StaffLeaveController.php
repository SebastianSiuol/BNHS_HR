<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_leaves = Leave::where('faculty_id', Auth::user()->id)->with('leave_types')->get();

        return view('staff.leave.index', [
            'leaves' => $user_leaves
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.leave.create', [
            'user' => Auth::user(),
            'leave_types' => LeaveType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* Validates Leave Type before Proceeding. */
         $request->validate([
            'leave_type' => 'required', 'abort',
        ]);

        /* Finds the Requested Leave to Retrieve its Days */
        $leave_type = LeaveType::find($request->leave_type);

        /* Validates Input depending on the Requested Leave Type */
        if ($leave_type->days) {

            $validated_input = $request->validate([
                'leave_type' => ['required'],
                'start_leave_date' => ['required', 'date_format:m-d-Y', 'after_or_equal:-1 day'],
                'leave_reason' => ['required'],
            ], [
                'start_leave_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
            ]);

            $end_date = LeaveType::calculateLeaveEndDate($validated_input['start_leave_date'], $leave_type->days);

        } else {
            $validated_input = $request->validate([
                'leave_type' => ['required'],
                'start_leave_date' => ['required', 'date_format:m-d-Y', 'after_or_equal:-1 day'],
                'no_leave_days' => ['required'],
                'leave_reason' => ['required'],
            ], [
                'start_leave_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
            ]);

            $end_date = LeaveType::calculateLeaveEndDate($validated_input['start_leave_date'], $validated_input['no_leave_days']);

        };

        $user = Auth::user();

        $leave = new Leave([
            'leave_types_id' => $validated_input['leave_type'],
            'start_date' => $validated_input['start_leave_date'],
            'leave_date' => $end_date,
            'document' => "Document",
            'reason' => $validated_input['leave_reason'],
        ]);

        $user->leaves()->save($leave);

        return redirect()->route('staff.leave.index');
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
        dd("What's up!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
