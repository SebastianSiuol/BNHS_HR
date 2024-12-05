<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

// Models
use App\Models\Faculty;


class FacultyController extends Controller
{
    public function index(){

        $faculties = Faculty::with('personal_information:faculty_id,first_name,last_name', 'designation.department:id,name', 'shift:id,name')
        ->paginate(5);


        return Inertia::render('Admin/Faculty/Index', [
            'faculties' => $faculties,
        ]);
    }
    public function create(){
        return Inertia::render('Admin/Faculty/Create');
    }

    public function store(Request $request){
        dd($request->all());
    }
}
