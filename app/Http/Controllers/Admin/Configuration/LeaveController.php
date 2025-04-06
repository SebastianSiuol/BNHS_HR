<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\LeaveType;
use Inertia\Inertia;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class LeaveController extends Controller
{
    private function getLeaveTypeByPubId(string $public_id){
        return LeaveType::where('public_id', $public_id)->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leave_types = LeaveType::select('public_id', 'name', 'for', 'days')->paginate(5);


        return Inertia::render('Admin/Config/Leave/Index', [
            'leaveTypes' => $leave_types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:leave_types,name'],
            'for' => ['required'],
            'is_service_credits' => ['required', 'boolean'],
            'days' => [
                'required_if:is_service_credits,false',
                'integer',
                'min:1',
                'max:1460',
                'nullable',
            ],
        ]);

        $validator->validate();

        try {
            DB::beginTransaction();
            LeaveType::create([
                'name' => $request->name,
                'days' => $request->is_service_credits ? null : $request->days,
                'for' => $request->for,
                'is_service_credits' => $request->is_service_credits,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Leave Type Created Successfully');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Leave type cannot be created'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $leave)
    {
        $leave_type = $this->getLeaveTypeByPubId($leave); // Get model first

        Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('leave_types', 'name')->ignore($leave_type->id),
            ],
            'for' => ['required'],
            'is_service_credits' => ['required', 'boolean'],
        ])->sometimes('days', ['required', 'integer', 'min:1', 'max:1460'], function ($input) {
                return !$input->is_service_credits;
        })->validate();


        try {
            DB::beginTransaction();
            $leave_type->update([
                'name' => $request->name,
                'days' => $request->is_service_credits ? null : $request->days,
                'for' => $request->for,
                'is_service_credits' => $request->is_service_credits,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Leave Type Deleted Successfully');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Leave type cannot be deleted'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $leave)
    {
        try {
            DB::beginTransaction();
            $leave_type = $this->getLeaveTypeByPubId($leave);
            if (!$leave_type) {
                return redirect()->back()->with('error', 'Leave Type Not Found');
            }
            $leave_type->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Leave Type Deleted Successfully');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Leave type cannot be deleted'], 400);
        }
    }
}
