<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::with('personal_information')->first()->paginate(5);

        return view('admin.employee_index',[
            'faculties'=>$faculties
        ]);
    }

    public function create(){

        $generated_id = Faculty::generateFacultyCode();
        return view('admin.employee_create', [
            'generated_id'=>$generated_id
        ]);
    }

    public function store(Request $request){

//        $faculty = Faculty::find(1);

//        dd($faculty->personal_information->medical_info->height);

        dd($request->all());
    }
}
