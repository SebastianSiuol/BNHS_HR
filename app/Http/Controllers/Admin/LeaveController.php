<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

// Models
use App\Models\Leave;
use App\Models\LeaveType;

class LeaveController extends Controller
{
    public function index(Request $request)
    {

        $user_leaves = Leave::where('faculty_id', Auth::user()->id)
            ->select('public_id','start_date', 'end_date', 'status', 'document', 'leave_types_id')
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

    public function show($leave_id){
        $leave = Leave::where('public_id', $leave_id)->get()->first();

        if (!$leave) {
            return response()->json(['error' => 'Leave not found'], 404);
        }

        if (!Storage::disk('public')->exists($leave->document)) {
            abort(404, 'File not found.');
        }


        $file_url = Storage::disk('public')->url($leave->document);


        $leaveDetails = [
            'publicId' => $leave->public_id,
            'startDate' => $leave->start_date,
            // 'startDate' => '2024-01-02',
            'endDate' => $leave->end_date,
            'document' => $file_url,
            'status' => $leave->status,
        ];

        return response()->json($leaveDetails);
    }

    public function create(Request $request)
    {
        if (Leave::isThereLeaveActive()) {

            return redirect()->back()->with('error', 'You currently have an active request!');
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


        $request->validate(['leave_type' => 'required']);

        $leave_type = LeaveType::findOrFail($request->leave_type);

        $validate_request = [
            'leave_type' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'leave_document' => ['required']
        ];

        if (!$leave_type->days) {
            $validate_request['no_of_days'] = ['required', 'gt:0'];
        }

        $validated_input = $request->validate($validate_request, [
            'start_date.after_or_equal' => 'The From* date cannot be an earlier day than today!',
        ]);

        $end_date = LeaveType::calculateLeaveEndDate(
            $validated_input['start_date'],
            $leave_type->days ?? $validated_input['no_of_days']
        );

        $public_user_id = Auth::user()->public_id;
        $leave_document = $request->file('leave_document');
        $leave_document_path = $leave_document->store(('/leave_documents/'. $public_user_id . '/'), 'public');

        Leave::create([
            'faculty_id' => Auth::id(),
            'leave_types_id' => $validated_input['leave_type'],
            'start_date' => $validated_input['start_date'],
            'end_date' => $end_date,
            'document' => $leave_document_path,
        ]);

        // Auth::user()->leaves->save($leave);

        $render_url = $this->getRenderUrl($request, [
            'admin' => 'admin.leaves.index',
            'faculty' => 'faculty.leaves.index',
        ], true);


        return redirect($render_url)->with('success', 'Leave request addded successfully!');
    }

    public function cancel(Request $request, $leave_id)
    {
        $request->validate([
            'action' => 'required|in:cancel',
        ]);

        $leave = Leave::where('public_id', $leave_id)->get()->first();


        // Check if the leave status is 'pending'
        if ($leave->status !== 'pending') {
            return redirect()->back()->with('error', 'Cannot cancel leave. Only pending requests can be cancelled.');
        }

        // Proceed with cancellation
        $leave->status = 'cancelled';
        $leave->save();

        return redirect()->back()->with('success', 'Leave request cancelled successfully!');
    }

    public function manage()
    {

        $auth_faculty = Auth::user();
        $auth_department_id = $auth_faculty->designation->department_id;
        $auth_faculty_roles = $auth_faculty->roles->pluck('role_name');

        $leaveQuery = Leave::select('id', 'public_id', 'leave_types_id', 'faculty_id', 'start_date', 'end_date', 'document', 'status')
            ->with([
                'faculty' => fn($query) => $query->select('id', 'faculty_code', 'service_credit')
                    ->with(['personal_information' => fn($subQuery) => $subQuery->select('id', 'faculty_id', 'first_name', 'last_name')]),
                'leave_types' => fn($query) => $query->select('id', 'name')
            ]);

            if ($auth_faculty_roles->contains('hr_manager')) {
                $leaveQuery->whereHas('faculty.designation.department', fn($query) => $query->where('id', $auth_department_id));
            }

            $leaves_requests = $leaveQuery->paginate(5);

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
        } elseif ($request->action === 'cancel') {
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
