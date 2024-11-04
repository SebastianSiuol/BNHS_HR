<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\Configuration\SchoolPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('admin.configuration.position.index',[
            'admin' => Auth::user(),
            'school_positions' => SchoolPosition::paginate(5),
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
