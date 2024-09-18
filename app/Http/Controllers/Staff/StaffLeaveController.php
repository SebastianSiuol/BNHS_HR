<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('staff.leave-index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leave_types = LeaveType::all();

        return view('staff.leave-create', [
            'leave_types' => $leave_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_input = $request->validate([
            'leave_type' => ['required'],
            'start_leave_date' => ['required', 'date_format:m-d-Y', 'after_or_equal:-1 day'],
            'end_leave_date' => ['required', 'date_format:m-d-Y', 'after:start_leave_date'],
            'leave_reason' => ['required'],
        ],[
            'start_leave_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
            'end_leave_date.after' => 'The To* date must be after the From* date!',

        ]);

        $faculty = Auth::user();

        $leave = new Leave([
            'leave_type_id'    => $validated_input['leave_type'],
            'start_date'        => $validated_input['start_leave_date'],
            'leave_date'        => $validated_input['end_leave_date'],
            'document'          => "Document",
            'reason'            => $validated_input['leave_reason'],
            'approved'          => false,
        ]);


        $faculty->leaves()->save($leave);

        return redirect()->route('staff_leave_index');
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
}
