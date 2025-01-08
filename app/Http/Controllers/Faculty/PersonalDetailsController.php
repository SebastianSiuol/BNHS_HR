<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculty = Auth::user();
        $psn_info = $faculty->personal_information;

        $personalInfo = [
            'email' => [
                'email' => $faculty->email,
            ],
            'personal_information' => [
                'id' => $psn_info->id,
                'first_name' => $psn_info->first_name,
                'middle_name' => $psn_info->middle_name,
                'last_name' => $psn_info->last_name,
                'name_extension' => $psn_info->name_extension->title,
                'place_of_birth' => $psn_info->place_of_birth,
                'date_of_birth' => $psn_info->date_of_birth,
                'sex' => $psn_info->sex,
                'civil_status' => $psn_info->civil_status->civil_status,
                'contact_number' => $psn_info->contact_no,
                'telephone_number' => $psn_info->telephone_no,
                'contact_person_name' => $psn_info->contact_person->name,
                'contact_person_number' => $psn_info->contact_person->contact_no,
            ],
            'addresses' => [
                'residential_id' => $psn_info->residential_address->id,
                'residential_house_num' => $psn_info->residential_address->house_block_no,
                'residential_street' => $psn_info->residential_address->street,
                'residential_subdivision' => $psn_info->residential_address->subdivision_village,
                'residential_barangay' => $psn_info->residential_address->barangay,
                'residential_city' => $psn_info->residential_address->city_municipality,
                'residential_province' => $psn_info->residential_address->province,
                'residential_zip_code' => $psn_info->residential_address->zip_code,
                'permanent_id' => $psn_info->permanent_address->id,
                'permanent_house_num' => $psn_info->permanent_address->house_block_no,
                'permanent_street' => $psn_info->permanent_address->street,
                'permanent_subdivision' => $psn_info->permanent_address->subdivision_village,
                'permanent_barangay' => $psn_info->permanent_address->barangay,
                'permanent_city' => $psn_info->permanent_address->city_municipality,
                'permanent_province' => $psn_info->permanent_address->province,
                'permanent_zip_code' => $psn_info->permanent_address->zip_code,
            ],
            'phil_ids' => [
                'gsis_id_no' => $psn_info->phil_id_cards->gsis_id_no ?? "",
                'pag_ibig_id_no' => $psn_info->phil_id_cards->pag_ibig_id_no ?? "",
                'sss_no' => $psn_info->phil_id_cards->sss_no ?? "",
                'tin_no' => $psn_info->phil_id_cards->tin_no ?? "",
                'philhealth_no' => $psn_info->phil_id_cards->philhealth_no ?? "",
            ],
            'medical_info' => [
                'height' => $psn_info->medical_info->height ?? "",
                'weight' => $psn_info->medical_info->weight ?? "",
                'blood_type' => $psn_info->medical_info->blood_type ?? "",
            ]
        ];

        return Inertia::render('Faculty/PersonalDetails/Index', [
            'personalInfo' => $personalInfo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'personal_information.first_name' => 'required|string|max:255',
            'personal_information.middle_name' => 'nullable|string|max:255',
            'personal_information.last_name' => 'required|string|max:255',
            'personal_information.name_extension_id' => 'nullable',
            'personal_information.date_of_birth' => 'required|date|before:today',
            'personal_information.place_of_birth' => 'required|string|max:255',
            'personal_information.sex' => 'required|string|in:Male,Female',
            'personal_information.civil_status_id' => 'required|integer|in:1,2,3,4',

            'addresses.residential.house_num' => 'nullable|string|max:255',
            'addresses.residential.street' => 'nullable|string|max:255',
            'addresses.residential.subdivision' => 'nullable|string|max:255',
            'addresses.residential.barangay' => 'required|string|max:255',
            'addresses.residential.city' => 'required|string|max:255',
            'addresses.residential.province' => 'required|string|max:255',
            'addresses.residential.zip_code' => 'required|string|max:10',

            'addresses.permanent.house_num' => 'nullable|string|max:255',
            'addresses.permanent.street' => 'nullable|string|max:255',
            'addresses.permanent.subdivision' => 'nullable|string|max:255',
            'addresses.permanent.barangay' => 'required|string|max:255',
            'addresses.permanent.city' => 'required|string|max:255',
            'addresses.permanent.province' => 'required|string|max:255',
            'addresses.permanent.zip_code' => 'required|string|max:10',

            'phil_ids.gsis_id_no' => 'nullable|string|max:20',
            'phil_ids.pag_ibig_id_no' => 'nullable|string|max:20',
            'phil_ids.sss_no' => 'nullable|string|max:20',
            'phil_ids.tin_no' => 'nullable|string|max:20',
            'phil_ids.philhealth_no' => 'nullable|string|max:20',

            'medical_information.height' => 'required|int',
            'medical_information.weight' => 'required|int',
            'medical_information.blood_type' => 'nullable',

            'contact_information.contact_number' => 'required|string',
            'contact_information.telephone_number' => 'nullable|string|max:20',
            'contact_information.email' => 'required|email|max:255',
        ]);

        // Find the personal information record
        $faculty = Auth::user();
        $personalInformation = $faculty->personal_information;

        // Update Personal Information
        $personalInformation->update([
            'first_name' => $validatedData['personal_information']['first_name'],
            'middle_name' => $validatedData['personal_information']['middle_name'],
            'last_name' => $validatedData['personal_information']['last_name'],
            'name_extension_id' => $validatedData['personal_information']['name_extension_id'],
            'date_of_birth' => $validatedData['personal_information']['date_of_birth'],
            'place_of_birth' => $validatedData['personal_information']['place_of_birth'],
            'sex' => $validatedData['personal_information']['sex'],
            'civil_status_id' => $validatedData['personal_information']['civil_status_id'],
            'contact_no' => $validatedData['contact_information']['contact_number'],
            'telephone_no' => $validatedData['contact_information']['telephone_number'],
        ]);

        // Update Residential Address
        $personalInformation->residentiaL_address()->updateOrCreate([], [
            'house_block_no' => $validatedData['addresses']['residential']['house_num'],
            'street' => $validatedData['addresses']['residential']['street'],
            'subdivision_village' => $validatedData['addresses']['residential']['subdivision'],
            'barangay' => $validatedData['addresses']['residential']['barangay'],
            'city_municipality' => $validatedData['addresses']['residential']['city'],
            'province' => $validatedData['addresses']['residential']['province'],
            'zip_code' => $validatedData['addresses']['residential']['zip_code'],
        ]);

        // Update Permanent Address
        $personalInformation->permanent_address()->updateOrCreate([], [
            'house_block_no' => $validatedData['addresses']['permanent']['house_num'],
            'street' => $validatedData['addresses']['permanent']['street'],
            'subdivision_village' => $validatedData['addresses']['permanent']['subdivision'],
            'barangay' => $validatedData['addresses']['permanent']['barangay'],
            'city_municipality' => $validatedData['addresses']['permanent']['city'],
            'province' => $validatedData['addresses']['permanent']['province'],
            'zip_code' => $validatedData['addresses']['permanent']['zip_code'],
        ]);

        // Update Government IDs
        $personalInformation->phil_id_cards()->updateOrCreate([], [
            'gsis_id_no' => $validatedData['phil_ids']['gsis_id_no'],
            'pag_ibig_id_no' => $validatedData['phil_ids']['pag_ibig_id_no'],
            'sss_no' => $validatedData['phil_ids']['sss_no'],
            'tin_no' => $validatedData['phil_ids']['tin_no'],
            'philhealth_no' => $validatedData['phil_ids']['philhealth_no'],
        ]);

        // Update Medical Information
        $personalInformation->medical_info()->updateOrCreate([], [
            'height' => $validatedData['medical_information']['height'],
            'weight' => $validatedData['medical_information']['weight'],
            'blood_type' => $validatedData['medical_information']['blood_type'],
        ]);

        // Update Contact Information in Faculty
        $personalInformation->faculty()->update([
            'email' => $validatedData['contact_information']['email'],
        ]);

        return redirect()->back()->with('success', 'Personal Information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
