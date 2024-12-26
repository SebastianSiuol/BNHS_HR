<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use function Symfony\Component\String\s;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::paginate(5);

        return Inertia::render('Admin/Config/Shift/Index', compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* Validate Requests */
        $validated_inputs = $request->validate([
            'name'              => ['required', 'string', 'max:255', 'unique:shifts,name'],
            'start_time'        => ['required', 'date'],
            'end_time'          => ['required', 'date','after:start_time'],
            'shift_description' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'Shift Name is required',
            'name.unique' => 'Shift already exists',
            'start_time.required' => 'Start Time is required',
            'end_time.required' => 'End Time is required',
            'end_time.after' => 'End time must be after Start Time',
            'shift_description.required' => 'Shift Description is required',
        ]);

        $formatted_start_date = Carbon::parse($request->start_time)->setTimezone('GMT+8')->setDate(2000, 1, 1);
        $formatted_end_date = Carbon::parse($request->end_time)->setTimezone('GMT+8')->setDate(2000, 1, 1);


        /* Insert validated requests */
        $shift = new Shift;
        $shift->name = strtolower($validated_inputs['name']);
        $shift->from = $formatted_start_date;
        $shift->to = $formatted_end_date;
        $shift->description = $validated_inputs['shift_description'];
        $shift->save();

        /* Redirect */
        return redirect()->route('admin.config.shift.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        /* Validate Requests */
        $validated_inputs = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'start_time'        => ['required', 'date'],
            'end_time'          => ['required', 'date','after:start_time'],
        ],[
            'name.required' => 'Shift Name is required',
            'start_time.required' => 'Start Time is required',
            'end_time.required' => 'End Time is required',
            'end_time.after' => 'End time must be after Start Time',
        ]);

        $formatted_start_date = Carbon::parse($request->start_time)->setTimezone('GMT+8')->setDate(2000, 1, 1);
        $formatted_end_date = Carbon::parse($request->end_time)->setTimezone('GMT+8')->setDate(2000, 1, 1);

        $shift->name = strtolower($validated_inputs['name']);
        $shift->from = $formatted_start_date;
        $shift->to = $formatted_end_date;
        $shift->save();

        return back()->with('success', 'Shift has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        try {
            $shift->delete();
            return back()->with('success', 'Shift deleted successfully!');
        } catch (QueryException $e) {

            // Check if the error is related to a foreign key constraint
            if ($e->getCode() == '23000') {
                return back()->with('error', 'Cannot delete shift because there is an existing faculty using the shift!');
            }
            // For any other database-related errors, handle them here
            return back()->with('error', 'An error occurred while deleting the shift. Please try again.');

        }

    }

    public function search(Request $request){
        $query = request('query');

        $shifts = Shift::where('name', 'LIKE', '%'.$query.'%')->paginate(5);

        return view('admin.configuration.shift.index', compact('shifts'));
    }
}
