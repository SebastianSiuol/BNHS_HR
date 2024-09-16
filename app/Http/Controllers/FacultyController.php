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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Reference\Reference;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::with('personal_information')->first()->paginate(5);

        return view('admin.employee-index',[
            'admin'             => Auth::user(),
            'faculties'         =>$faculties
        ]);
    }

    public function create(){
        return view('admin.employee-create', [
            'admin'             => Auth::user(),
            'generated_id'      => Faculty::generateFacultyCode(),
            'shifts'            => Shift::all(),
            'departments'       => Department::all(),
            'designations'      => Designation::all(),
            'civil_statuses'    => CivilStatus::all(),
            'name_exts'         => NameExtension::all(),
            'max_date'          => date("m/d/Y", strtotime('-21 year')),
        ]);
    }

    public function store(Request $request)
    {

//        NOTE: SANITY CHECK
//        dd($request->all());


//      START OF VALIDATIONS

//        if($request->both_address_same){
//            $request->merge([
//            'permanent_house_num'   => $request->residential_house_num,
//            'permanent_street'      => $request->residential_street,
//            'permanent_subdivision' => $request->residential_subdivision,
//            'permanent_barangay'    => $request->residential_barangay,
//            'permanent_city'        => $request->residential_city,
//            'permanent_province'    => $request->residential_province,
//            'permanent_zip_code'    => $request->residential_zip_code,
//            ]);
//        }


        $validated_inputs = $request->validate([
            'email'                         => ['required', 'string', 'email', 'max:255', 'unique:faculties'],
            'password'                      => ['required', 'string', 'min:8'],
            'date_of_joining'               => ['required', 'date', 'date_format:m-d-Y', 'after_or_equal:-1 day'],
            'department'                    => ['required'],
            'designation'                   => ['required'],
            'shift'                         => ['required'],

//          PERSONAL INFORMATION
            'first_name'                    => ['required'],
            'middle_name'                   => ['nullable'],
            'last_name'                     => ['required'],
            'name_extension'                => ['nullable'],
            'sex'                           => ['required'],
            'place_of_birth'                => ['required'],
            'date_of_birth'                 => ['required', 'date_format:m-d-Y', 'before: -18 year'],
            'contact_number'                => ['required'],
            'telephone_number'              => ['nullable'],
            'civil_status'                  => ['required'],

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
        ],[
            'date_of_birth.before' => 'The employee must be at least 18 years old!',
            'date_of_joining.after_or_equal' => 'The joining date cannot be an earlier day than today!',
        ]);
//      END OF VALIDATIONS


//      START OF INSERT
        $faculty = new Faculty;

        $faculty->email             = $validated_inputs['email'];
        $faculty->password          = $validated_inputs['password'];
        $faculty->date_of_joining   = $validated_inputs['date_of_joining'];
        $faculty->date_of_leaving   = null;
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

        // NOTE: Reference Members Storing
//        $ref_mem_01 = new ReferenceMember([
//            'name'                  => $validated_inputs['reference_name_01'],
//            'contact_number'        => $validated_inputs['reference_contact_number_01'],
//            'address'               => 'Quezon City',
//            'reference_number'      => '1',
//        ]);
//
//
//        $ref_mem_02 = NULL;
//        $have_another_ref = false;
//        if ($request->reference_name_02 && $request->reference_contact_number_02) {
//
//            $reference_02 = $request->validate([
//                'reference_name_02'             => 'required',
//                'reference_contact_number_02'   => 'required',
//            ]);
//
//            $ref_mem_02 = new ReferenceMember([
//                'name'              => $reference_02['reference_name_02'],
//                'contact_number'    => $reference_02['reference_contact_number_02'],
//                'address'           => 'Quezon City',
//                'reference_number'  => '2',
//            ]);
//
//            $have_another_ref = true;
//        }


//      START OF SAVING DETAILS
        $faculty->save();
        $faculty->personal_information()->save($psn_info);
        $psn_info->residential_address()->save($resi_addr);
        $psn_info->permanent_address()->save($perma_addr);
        $psn_info->contact_person()->save($cont_psn);
//      END OF SAVING DETAILS

        return redirect()
            ->route('employees_index')
            ->with('success', 'Employee created successfully!');
    }

    public function show(){
        return view('admin.employee_index', [
            'admin'             => Auth::user(),
        ]);
    }

    public function edit(Faculty $faculty){

        return view('admin.employee-edit', [
            'admin'             => Auth::user(),
            'faculty'               => $faculty,
            'personal_information'  => $faculty->personal_information,

//          Dropdown Choices
            'max_date'              => date("m/d/Y", strtotime('-18 year')),
            'shifts'                => Shift::all(),
            'departments'           => Department::all(),
            'designations'          => Designation::all(),
            'civil_statuses'        => CivilStatus::all(),
            'name_exts'             => NameExtension::all(),
        ]);
    }

    public function update(Request $request, Faculty $faculty){

        $validated_inputs = $request->validate([
            'email'                         => ['required', 'string', 'max:255'],
            'date_of_joining'               => ['nullable', 'date'],
            'date_of_leaving'               => ['nullable', 'date_format:m-d-Y','after:now'],
            'department'                    => ['required'],
            'designation'                   => ['required'],
            'shift'                         => ['required'],

//          PERSONAL INFORMATION
            'first_name'                    => ['required'],
            'middle_name'                   => ['nullable'],
            'last_name'                     => ['required'],
            'name_extension'                => ['nullable'],
            'sex'                           => ['required'],
            'place_of_birth'                => ['required'],
            'date_of_birth'                 => ['required', 'date_format:m-d-Y', 'after:-100 years', 'before:-18 years'],
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

        ], [
            'date_of_birth.before' => 'The employee must be at least 18 years old!',
            'date_of_leaving.after' => 'The leaving date cannot be an earlier day than today!',

        ]);
//      END OF VALIDATIONS

//      START OF EDITING
//      ACCOUNT DETAILS
        $faculty->email                     = $validated_inputs['email'];
        $faculty->date_of_joining           = $validated_inputs['date_of_joining'];
        $faculty->date_of_leaving           = $validated_inputs['date_of_leaving'];

//      PERSONAL INFORMATION DETAILS
        $psn_info = $faculty->personal_information;
        $psn_info->first_name               = $validated_inputs['first_name'];
        $psn_info->middle_name              = $validated_inputs['middle_name'];
        $psn_info->last_name                = $validated_inputs['last_name'];
        $psn_info->name_extension_id        = $validated_inputs['name_extension'];
        $psn_info->sex                      = $validated_inputs['sex'];
        $psn_info->place_of_birth           = $validated_inputs['place_of_birth'];
        $psn_info->date_of_birth            = $validated_inputs['date_of_birth'];
        $psn_info->contact_no               = $validated_inputs['contact_number'];
        $psn_info->telephone_no             = $validated_inputs['telephone_number'];
        $psn_info->civil_status_id          = $validated_inputs['marital_status'];

//      CONTACT PERSON DETAILS
        $cont_psn = $psn_info->contact_person;
        $cont_psn->name                     = $validated_inputs['contact_person_name'];
        $cont_psn->contact_no               = $validated_inputs['contact_person_number'];

//      RESIDENTIAL ADDRESS
        $res_addr = $psn_info->residential_address;
        $res_addr->house_block_no           = $validated_inputs['residential_house_num'];
        $res_addr->street                   = $validated_inputs['residential_street'];
        $res_addr->subdivision_village      = $validated_inputs['residential_subdivision'];
        $res_addr->barangay                 = $validated_inputs['residential_barangay'];
        $res_addr->city_municipality        = $validated_inputs['residential_city'];
        $res_addr->province                 = $validated_inputs['residential_province'];
        $res_addr->zip_code                 = $validated_inputs['residential_zip_code'];

//      PERMANENT ADDRESS
        $perm_addr = $psn_info->permanent_address;
        $perm_addr->house_block_no          = $validated_inputs['permanent_house_num'];
        $perm_addr->street                  = $validated_inputs['permanent_street'];
        $perm_addr->subdivision_village     = $validated_inputs['permanent_subdivision'];
        $perm_addr->barangay                = $validated_inputs['permanent_barangay'];
        $perm_addr->city_municipality       = $validated_inputs['permanent_city'];
        $perm_addr->province                = $validated_inputs['permanent_province'];
        $perm_addr->zip_code                = $validated_inputs['permanent_zip_code'];
//      END OF EDITING


//      COMMITTING CHANGED DETAILS
        $faculty->save();
        $psn_info->save();
        $cont_psn->save();
        $res_addr->save();
        $perm_addr->save();

        return redirect()
            ->route('employees_index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Faculty $faculty){

        if (Auth::user()->id == $faculty->id){
            return redirect()
                ->route('employees_index')
                ->with('error', 'Cannot delete logged-in employee!');
        }

        $faculty->delete();
        return redirect()
            ->route('employees_index')
            ->with('success', 'Employee deleted successfully!');
    }

    public function search(Request $request){

//        $search = $request->query('search');
//        $faculties = null;
//
//        if ($search) {
//            $faculties = Faculty::where('faculty_code', 'like', '%'.$search.'%')->first()->paginate(5);
//        }
////        dd($faculties);
//
//        return view('admin.employee-index')
//            ->with('faculties', $faculties)
//            ->with('admin', Auth::user());
    }
}
