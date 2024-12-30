<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Leave;
use App\Models\LeaveType;

class LeaveController extends Controller
{
    public function index(Request $request)
    {

        $user_leaves = Leave::where('faculty_id', Auth::user()->id)
            ->select('id', 'start_date', 'end_date', 'reason', 'status', 'leave_types_id')
            ->with(['leave_types' => fn($query) => $query->select('id', 'name', 'days')])
            ->paginate(5);



        $render_url = $this->getRenderUrl($request, [
            'admin' => 'Admin/Leave/Index',
            'faculty' => 'Faculty/Leave/Index',
        ]);

        return Inertia::render($render_url, [
            'leaves' => $user_leaves,
        ]);
    }

    public function create(Request $request)
    {
        if (Leave::isThereLeaveActive()) {

            $render_url = $this->getRenderUrl($request, [
                'admin' => 'admin.leaves.index',
                'faculty' => 'faculty.leaves.index',
            ], true);

            return redirect($render_url)->with('error', 'You currently have an active request!');
        }


        $leave_types = LeaveType::all()->select('id', 'name', 'days');
        $service_credit = Auth::user()->service_credit;


        $render_url = $this->getRenderUrl($request, [
            'admin' => 'Admin/Leave/Create',
            'faculty' => 'Faculty/Leave/Create',
        ]);

        return Inertia::render($render_url, [
            'leaveTypes' => $leave_types,
            'serviceCredit' => $service_credit,
        ]);
    }


    public function store(Request $request)
    {

        /* Validates Leave Type before Proceeding. */
        $request->validate(['leave_type' => 'required']);

        /* Finds the Requested Leave to Retrieve its Days */
        $leave_type = LeaveType::findOrFail($request->leave_type);

        /* Validates Normal Requests */
        $validate_request = [
            'leave_type' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'reason' => ['required'],
        ];

        /* If no days are found, validate the no_of_days input */
        if (!$leave_type->days) {
            $validate_request['no_of_days'] = ['required'];
        }

        $validated_input = $request->validate($validate_request, [
            'start_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
        ]);

        // Calculates Leave End Date
        $end_date = LeaveType::calculateLeaveEndDate(
            $validated_input['start_date'],
            $leave_type->days ?? $validated_input['no_of_days']
        );

        // Creates new Instance of Leave Model
        $leave = new Leave([
            'leave_types_id' => $validated_input['leave_type'],
            'start_date' => $validated_input['start_date'],
            'end_date' => $end_date,
            'document' => "Document",
            'reason' => $validated_input['reason'],
        ]);

        // Assigns the instance of Leave to the Authenticated User and Save it.
        Auth::user()->leaves()->save($leave);

        $render_url = $this->getRenderUrl($request, [
            'admin' => 'admin.leaves.index',
            'faculty' => 'faculty.leaves.index',
        ], true);


        return redirect($render_url)->with('success', 'Leave request addded successfully!');
    }

    public function cancel(Request $request, Leave $leave)
{
    $request->validate([
        'action' => 'required|in:cancel',
    ]);

    // Check if the leave status is 'pending'
    if ($leave->status !== 'pending') {
        return redirect()->back()->with('error', 'Cannot cancel leave. Only pending requests can be cancelled.');
    }

    // Proceed with cancellation
    $leave->status = 'cancelled';
    $leave->save();

    $render_url = $this->getRenderUrl($request, [
        'admin' => 'admin.leaves.index',
        'faculty' => 'faculty.leaves.index',
    ], true);

    return redirect($render_url)->with('success', 'Leave request cancelled successfully!');
}

    public function manage(){

        $leaves_requests = Leave::select('id', 'leave_types_id', 'faculty_id','start_date', 'end_date','document', 'reason', 'status')
            ->with([
                'faculty' => fn($query) => $query->select('id', 'faculty_code', 'service_credit')
                    ->with(['personal_information' => fn($subQuery) => $subQuery->select('id','faculty_id','first_name', 'last_name')]),
                'leave_types' => fn($query) => $query->select('id', 'name')
            ])
            ->paginate(5);

        return Inertia::render('Admin/Leave/Manage', [
            'leaveRequests' => $leaves_requests,
        ]);
    }


    public function leaveAction(Request $request, Leave $leave)
{
    // Validate the request action
    $request->validate([
        'action' => 'required|in:approve,reject,cancel',
    ]);

    // Perform the requested action
    if ($request->action === 'approve') {
        if ($leave->status === 'approved') {
            return redirect()->route('admin.leaves.manage')->withErrors(['error' => 'This leave request is already approved.']);
        }
        $leave->status = 'approved';
        $message = 'Leave approved successfully!';
    } elseif ($request->action === 'reject') {
        if ($leave->status === 'rejected') {
            return redirect()->route('admin.leaves.manage')->withErrors(['error' => 'This leave request is already rejected.']);
        }
        $leave->status = 'rejected';
        $message = 'Leave rejected successfully!';
    }elseif($request->action === 'cancel') {
        if ($leave->status === 'cancelled') {
            return redirect()->route('admin.leaves.index')->withErrors(['error' => 'This leave request is already cancelled.']);
        }
        $leave->status = 'cancelled';
        $message = 'Leave cancelled successfully!';
    } else {
        return redirect()->route('admin.leaves.manage')->withErrors(['error' => 'Invalid action specified.']);
    }

    // Save the leave status
    $leave->save();

    // Redirect with success message
    return redirect()->route('admin.leaves.manage')->with(['success' => $message]);
}







    private function getRenderUrl(Request $request, array $url_map, bool $use_route_format = false)
    {
        $url_request = strtolower($request->segment(1));
        if (array_key_exists($url_request, $url_map)) {
            return $use_route_format ? route($url_map[$url_request]) : $url_map[$url_request];
        }
        abort(404);
    }

}
