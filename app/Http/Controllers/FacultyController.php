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

        return view('admin.employee-index',[
            'faculties'=>$faculties
        ]);
    }

    public function create(){


        return view('admin.employee-create', [
            'generated_id' => Faculty::generateFacultyCode(),
            'departments' => Department::all(),
            'designations' => Designation::all(),
            'civil_statuses' => CivilStatus::all(),
            'max_date' => date("m/d/Y", strtotime('-21 year')),
        ]);
    }

    public function store(Request $request)
    {

        if($request->both_address_same){
            $request->merge([
            'permanent_house_num'   => $request->residential_house_num,
            'permanent_street'      => $request->residential_street,
            'permanent_subdivision' => $request->residential_subdivision,
            'permanent_barangay'    => $request->residential_barangay,
            'permanent_city'        => $request->residential_city,
            'permanent_province'    => $request->residential_province,
            'permanent_zip_code'    => $request->residential_zip_code,
            ]);
        }

//        NOTE: DEBUG PURPOSES (Comment out if done)
//        dd($request->all());


        $faculty = Faculty::create([
            'email' => request('email'),
            'password' => request('password'),
            'department_id' => request('department'),
            'designation_id' => request('designation'),
        ]);

        $personal_info = $faculty->personal_information()->create([
            'first_name' => request('first_name'),
            'middle_name' => request('middle_name'),
            'last_name' => request('last_name'),
            'name_extension' => request('name_extension'),
            'sex' => request('sex'),
            'place_of_birth' => 'Quezon City',
            'date_of_birth' => request('birthdate'),
            'telephone_no' => '+123-4567-890',
            'contact_no' => request('contact_number'),
            'civil_status_id' => request('marital_status'),
        ]);

        $personal_info->residential_address()->create([
            'house_block_no'        => $request->residential_house_num,
            'street'                => $request->residential_street,
            'subdivision_village'   => $request->residential_subdivision,
            'barangay'              => $request->residential_barangay,
            'city_municipality'     => $request->residential_city,
            'province'              => $request->residential_province,
            'zip_code'              => $request->residential_zip_code,
        ]);

        $personal_info->permanent_address()->create([
            'house_block_no'        => $request->permanent_house_num,
            'street'                => $request->permanent_street,
            'subdivision_village'   => $request->permanent_subdivision,
            'barangay'              => $request->permanent_barangay,
            'city_municipality'     => $request->permanent_city,
            'province'              => $request->permanent_province,
            'zip_code'              => $request->permanent_zip_code,
        ]);

        $personal_info->reference_members()->create([
            'name' => request('reference_name_01'),
            'contact_number' => request('reference_contact_number_01'),
            'address' => 'Quezon City',
        ]);

        if ($request->reference_name_02) {
            $reference_02 = $request->validate([
                'reference_name_02' => 'required',
                'reference_contact_number_02' => 'required',
            ]);

            $personal_info->reference_members()->create([
                'name' => $reference_02['reference_name_02'],
                'contact_number' => $reference_02['reference_contact_number_02'],
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
