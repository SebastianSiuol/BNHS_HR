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
        $school_positions = SchoolPosition::select('id','title','level')
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
        ],[
            'position_title.required' => 'Position title is required!',
        ]);

        $store_position = new SchoolPosition();
        $store_position->title = $validated_inputs['position_title'];
        $store_position->level = $validated_inputs['position_level'];
        $store_position->save();

        return back()->with('success', 'Position added successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolPosition $school_position)
    {
        $validated_inputs = $request->validate([
            'position_title' => ['required', 'string', 'max:255', Rule::unique('school_positions', 'title')->ignore($school_position->id),],
            'position_level' => ['required'],
        ],
            ['position_title.unique' => 'Position title cannot change to an existing position.']);

        $update_position = $school_position;
        $update_position->title = $validated_inputs['position_title'];
        $update_position->level = $validated_inputs['position_level'];
        $update_position->save();

        return back()->with('success', 'Position edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolPosition $school_position)
    {
        try {
            $school_position->delete();
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
