<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\s;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::paginate(5);

        return view('admin.configuration.shift.index', compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* Validate Requests */
        $validated_inputs = $request->validate([
            'name'              => ['required', 'string', 'max:255', 'unique:shifts,name'],
            'start_time'        => ['required', 'date_format:H:i'],
            'end_time'          => ['required', 'date_format:H:i','after:start_time'],
            'shift_description' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'Shift Name is required',
            'name.unique' => 'Shift already exists',
            'start_time.required' => 'Start Time is required',
            'end_time.required' => 'End Time is required',
            'end_time.after' => 'End time must be after Start Time',
            'shift_description.required' => 'Shift Description is required',
        ]);

        /* Insert validated requests */
        $shift = new Shift;
        $shift->name = strtolower($validated_inputs['name']);
        $shift->from = $validated_inputs['start_time'];
        $shift->to = $validated_inputs['end_time'];
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
            'start_time'        => ['required', 'date_format:H:i'],
            'end_time'          => ['required', 'date_format:H:i','after:start_time'],
        ],[
            'name.required' => 'Shift Name is required',
            'start_time.required' => 'Start Time is required',
            'end_time.required' => 'End Time is required',
            'end_time.after' => 'End time must be after Start Time',
        ]);

        $shift->name = strtolower($validated_inputs['name']);
        $shift->from = $validated_inputs['start_time'];
        $shift->to = $validated_inputs['end_time'];
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
                return back()->with('error', 'Cannot delete the shift because there is an existing faculty account in the department.');
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
