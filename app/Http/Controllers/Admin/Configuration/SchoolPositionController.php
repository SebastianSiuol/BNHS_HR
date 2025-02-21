<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Configuration\SchoolPosition;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SchoolPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $school_positions = SchoolPosition::select('public_id','title','level', 'allotment')
            ->withCount('faculties')
            ->paginate(5);


        return Inertia::render('Admin/Config/Position/Index',[
            'school_positions' => $school_positions,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_inputs = $request->validate([
            'position_title' => ['required', 'string', 'max:255', 'unique:school_positions,title'],
            'position_level' => ['required'],
            'position_allotment' => ['required', 'int', 'min:1', 'max:500']
        ],[
            'position_title.required' => 'A title is required!',
            'position_allotment.min' => 'The allotment must be atleast 1!',
            'position_allotment.max' => 'The allotment must not be above 500!',
        ]);

        $store_position = new SchoolPosition();
        $store_position->title = $validated_inputs['position_title'];
        $store_position->level = $validated_inputs['position_level'];
        $store_position->allotment = $validated_inputs['position_allotment'];
        $store_position->save();

        return back()->with('success', 'Position added successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $public_id)
    {
        // Get schoolPosition
        $update_position = SchoolPosition::where('public_id', $public_id)->withCount('faculties')->get()->first();

        // Validate requests
        $validated_inputs = $request->validate(
            [
                'position_title' => ['required', 'string', 'max:255', Rule::unique('school_positions', 'title')->ignore($update_position->id),],
                'position_level' => ['required'],
                'position_allotment' => ['required', 'int', 'min:1', 'max:500']
            ],
            [
                'position_title.unique' => 'Position title cannot change to an existing position.',
                'position_title.required' => 'A title is required!',
                'position_allotment.min' => 'The allotment must be atleast 1!',
                'position_allotment.max' => 'The allotment must not be above 500!',
            ]
        );

        // Assign inputs to variables
        $updated_title = $validated_inputs['position_title'];
        $updated_level = $validated_inputs['position_level'];
        $updated_allotment = $validated_inputs['position_allotment'];

        // Check if allotment will be below than the current assigned faculties
        $count_of_faculty = $update_position->faculties_count;
        if ($updated_allotment < $count_of_faculty) {
            return redirect()->back()->with('error', 'Allotment cannot be below than the assigned faculties!');
        }

        // Assign Input to Existing Table
        $update_position->title = $updated_title;
        $update_position->level = $updated_level;
        $update_position->allotment = $updated_allotment;
        $update_position->save();

        // Redirect success message if finished.
        return redirect()->back()->with('success', 'Position edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $public_id)
    {
        try {
            $selected_position = SchoolPosition::where('public_id', $public_id)->get()->first();
            $selected_position->delete();
            return back()->with('success', 'Position deleted successfully!');
        } catch (QueryException $e) {

            // Check if the error is related to a foreign key constraint
            if ($e->getCode() == '23000') {
                return back()->with('error', 'Cannot delete the position because there is an existing faculty account.');
            }
            // For any other database-related errors, handle them here
            return back()->with('error', 'An error occurred while deleting the position. Please try again.');

        }
    }
}
