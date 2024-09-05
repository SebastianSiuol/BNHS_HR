<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Faculty;
use App\Models\FacultyInformation\CivilStatus;
use App\Models\FacultyInformation\ContactPerson;
use App\Models\FacultyInformation\NameExtension;
use App\Models\FacultyInformation\PermanentAddress;
use App\Models\FacultyInformation\PersonalInformation;
use App\Models\FacultyInformation\ResidentialAddress;
use App\Models\ReferenceMember;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Reference\Reference;

class FacultyController extends Controller
{
//    TODO:FIX THIS
    public function index(){
        $faculties = Faculty::with('personal_information')->first()->paginate(5);

        return view('admin.employee-index',[
            'faculties'=>$faculties
        ]);
    }

    public function create(){


        return view('admin.employee-create', [
            'generated_id' => Faculty::generateFacultyCode(),
            'shifts' => Shift::all(),
            'departments' => Department::all(),
            'designations' => Designation::all(),
            'civil_statuses' => CivilStatus::all(),
            'name_exts' => NameExtension::all(),
            'max_date' => date("m/d/Y", strtotime('-21 year')),
        ]);
    }

//    public function debug_store (Request $request){
//        $faculty = new Faculty;
//
//        $faculty->email             = 'text';
//        $faculty->password          = 'text';
//        $faculty->department_id     = 1;
//        $faculty->designation_id    = 1;
//
//        $psn_info = new PersonalInformation([
//            'first_name'        => 'test',
//            'middle_name'       => 'test',
//            'last_name'         => 'test',
//            'name_extension'    => 'test',
//            'sex'               => 'test',
//            'place_of_birth'    => 'test',
//            'date_of_birth'     => 'test',
//            'telephone_no'      => 'test',
//            'contact_no'        => 'test',
//            'civil_status_id'   => 1,
//        ]);
//
//        $resi_addr = new ResidentialAddress([
//            'house_block_no'        => 'test',
//            'street'                => 'test',
//            'subdivision_village'   => 'test',
//            'barangay'              => 'test',
//            'city_municipality'     => 'test',
//            'province'              => 'test',
//            'zip_code'              => 'test',
//        ]);
//
//        $perma_addr = new PermanentAddress([
//            'house_block_no'        => 'test',
//            'street'                => 'test',
//            'subdivision_village'   => 'test',
//            'barangay'              => 'test',
//            'city_municipality'     => 'test',
//            'province'              => 'test',
//            'zip_code'              => 'test',
//        ]);
//
//        $faculty->save();
//        $faculty->personal_information()->save($psn_info);
//        $psn_info->residentiaL_address()->save($resi_addr);
//        $psn_info->permanent_address()->save($perma_addr);
//
//    }

    public function store(Request $request)
    {

//        NOTE: DEBUG PURPOSES (Comment out if done)
//        dd($request->all());


//      START OF VALIDATIONS
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

        $validated_inputs = $request->validate([
            'email'                         => ['required', 'string', 'email', 'max:255', 'unique:faculties'],
            'password'                      => ['required', 'string', 'min:8'],
            'date_of_joining'               => ['required', 'date_format:m-d-Y'],
            'date_of_leaving'               => ['required', 'date_format:m-d-Y'],
            'department'                    => ['required'],
            'designation'                   => ['required'],
            'shift'                         => ['required'],

//          PERSONAL INFORMATION
            'first_name'                    => ['required'],
            'middle_name'                   => ['required'],
            'last_name'                     => ['required'],
            'name_extension'                => ['nullable'],
            'sex'                           => ['required'],
            'place_of_birth'                => ['required'],
            'date_of_birth'                 => ['required', 'date_format:m-d-Y'],
            'contact_number'                => ['required'],
            'telephone_number'              => ['nullable'],
            'marital_status'                => ['required'],

//          CONTACT PERSON
            'contact_person_name'           => ['required'],
            'contact_person_number'         => ['nullable'],

//          ADDRESSES
            'residential_house_num'         => ['required'],
            'residential_street'            => ['required'],
            'residential_subdivision'       => ['required'],
            'residential_barangay'          => ['required'],
            'residential_city'              => ['required'],
            'residential_province'          => ['required'],
            'residential_zip_code'          => ['required'],
            'permanent_house_num'           => ['required'],
            'permanent_street'              => ['required'],
            'permanent_subdivision'         => ['required'],
            'permanent_barangay'            => ['required'],
            'permanent_city'                => ['required'],
            'permanent_province'            => ['required'],
            'permanent_zip_code'            => ['required'],

//          REFERENCE MEMBERS
            'reference_name_01'             => ['required'],
            'reference_contact_number_01'   => ['required'],
            'reference_name_02'             => ['nullable'],
            'reference_contact_number_02'   => ['nullable'],
        ]);
//      END OF VALIDATIONS


//      START OF INSERT
        $faculty = new Faculty;

        $faculty->email             = $validated_inputs['email'];
        $faculty->password          = $validated_inputs['password'];
        $faculty->date_of_joining   = $validated_inputs['date_of_joining'];
        $faculty->date_of_leaving   = $validated_inputs['date_of_leaving'];
        $faculty->department_id     = $validated_inputs['department'];
        $faculty->designation_id    = $validated_inputs['designation'];
        $faculty->shift_id          = $validated_inputs['shift'];

        $psn_info = new PersonalInformation([
            'first_name'        => $validated_inputs['first_name'],
            'middle_name'       => $validated_inputs['middle_name'],
            'last_name'         => $validated_inputs['last_name'],
            'name_extension_id' => $validated_inputs['name_extension'],
            'sex'               => $validated_inputs['sex'],
            'place_of_birth'    => $validated_inputs['place_of_birth'],
            'date_of_birth'     => $validated_inputs['date_of_birth'],
            'telephone_no'      => $validated_inputs['telephone_number'],
            'contact_no'        => $validated_inputs['contact_number'],
            'civil_status_id'   => $validated_inputs['marital_status'],
        ]);

        $cont_psn = new ContactPerson([
            'name'              => $validated_inputs['contact_person_name'],
            'contact_no'        => $validated_inputs['contact_person_number'],
        ]);

        $resi_addr = new ResidentialAddress([
            'house_block_no'        => $validated_inputs['residential_house_num'],
            'street'                => $validated_inputs['residential_street'],
            'subdivision_village'   => $validated_inputs['residential_subdivision'],
            'barangay'              => $validated_inputs['residential_barangay'],
            'city_municipality'     => $validated_inputs['residential_city'],
            'province'              => $validated_inputs['residential_province'],
            'zip_code'              => $validated_inputs['residential_zip_code'],
        ]);

        $perma_addr = new PermanentAddress([
            'house_block_no'        => $request->permanent_house_num,
            'street'                => $request->permanent_street,
            'subdivision_village'   => $request->permanent_subdivision,
            'barangay'              => $request->permanent_barangay,
            'city_municipality'     => $request->permanent_city,
            'province'              => $request->permanent_province,
            'zip_code'              => $request->permanent_zip_code,
        ]);

        $ref_mem_01 = new ReferenceMember([
            'name'                  => $validated_inputs['reference_name_01'],
            'contact_number'        => $validated_inputs['reference_contact_number_01'],
            'address'               => 'Quezon City',
            'reference_number'      => '1',
        ]);


        $ref_mem_02 = NULL;
        $have_another_ref = false;
        if ($request->reference_name_02 && $request->reference_contact_number_02) {

            $reference_02 = $request->validate([
                'reference_name_02'             => 'required',
                'reference_contact_number_02'   => 'required',
            ]);

            $ref_mem_02 = new ReferenceMember([
                'name'              => $reference_02['reference_name_02'],
                'contact_number'    => $reference_02['reference_contact_number_02'],
                'address'           => 'Quezon City',
                'reference_number'  => '2',
            ]);

            $have_another_ref = true;
        }


//      START OF SAVING DETAILS
        $faculty->save();
        $faculty->personal_information()->save($psn_info);
        $psn_info->residential_address()->save($resi_addr);
        $psn_info->contact_person()->save($cont_psn);
        $psn_info->permanent_address()->save($perma_addr);
        $psn_info->reference_members()->save($ref_mem_01);
        if($have_another_ref)
            $psn_info->reference_members()->save($ref_mem_02);
//      END OF SAVING DETAILS


        return redirect()->route('employees_index');
    }

    public function show(){
        return redirect()->route('employees_index');
    }

    public function edit(Faculty $faculty){

        return view('admin.employee-edit', [
            'faculty'               => $faculty,
            'personal_information'  => $faculty->personal_information,
            'birth_date'            => $faculty->personal_information->date_of_birth,

//            Choices Defaults
            'max_date'              => date("m/d/Y", strtotime('-21 year')),
            'departments'           => Department::all(),
            'designations'          => Designation::all(),
            'civil_statuses'        => CivilStatus::all(),
        ]);
    }

    public function update(){
        dd("Hey!");
    }

    public function destroy(Faculty $faculty){

        if (Auth::user()->id == $faculty->id){
            abort(403);
        }

        $faculty->delete();
        return redirect()->route('employees_index');
    }
}
