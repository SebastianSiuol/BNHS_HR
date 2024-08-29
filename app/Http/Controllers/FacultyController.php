<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Faculty;
use App\Models\FacultyInformation\CivilStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::with('personal_information')->first()->paginate(5);

        return view('admin.employee_index',[
            'faculties'=>$faculties
        ]);
    }

    public function create(){


        return view('admin.employee_create', [
            'generated_id' => Faculty::generateFacultyCode(),
            'departments' => Department::all(),
            'designations' => Designation::all(),
            'civil_statuses' => CivilStatus::all(),
            'max_date' => date("m/d/Y", strtotime('-21 year')),
        ]);
    }

    public function store(Request $request)
    {

//        dd(date("m/d/Y", strtotime('-21 year')));
        dd($request->all());


        $faculty = Faculty::create([
            'email' => request('email'),
            'password' => request('password'),
            'department_id' => request('department'),
            'designation_id' => request('designation'),
        ]);

        $personal_info = $faculty->personal_information()->create([
            'first_name' => request('name'),
            'middle_name' => request('name'),
            'last_name' => request('name'),
            'name_extension' => request('name'),
            'sex' => request('sex'),
            'place_of_birth' => 'Quezon City',
            'date_of_birth' => request('birthdate'),
            'telephone_no' => '+123-4567-890',
            'contact_no' => request('contact_number'),
            'civil_status_id' => request('marital_status'),
        ]);

        $personal_info->reference_members()->create([
            'name' => request('reference_name_01'),
            'contact_number' => request('reference_phone_01'),
            'address' => 'Quezon City',
        ]);

        if ($request->reference_name_02) {
            $reference_02 = $request->validate([
                'reference_name_02' => 'required',
                'reference_phone_02' => 'required',
            ]);

            $personal_info->reference_members()->create([
                'name' => $reference_02['reference_name_02'],
                'contact_number' => $reference_02['reference_phone_02'],
                'address' => 'Quezon City',
            ]);
        }

        $faculty->save();

        return redirect()->route('employees_index');
    }

    public function show(){
        return redirect()->route('employees_index');
    }

    public function destroy(Faculty $faculty){

        if (Auth::user()->id == $faculty->id){
            abort(403);
        }

        $faculty->delete();
        return redirect()->route('employees_index');
    }
}
