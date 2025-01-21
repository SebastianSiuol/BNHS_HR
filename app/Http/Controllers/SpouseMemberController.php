<?php

namespace App\Http\Controllers;

use App\Models\Personalinformation\SpouseMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpouseMemberController extends Controller
{

    public function get()
    {
        $faculty = Auth::user();

        if (!$faculty || !$faculty->personal_information) {
            return response()->json([
                'message' => 'Personal information not found for the authenticated user.'
            ], 404);
        }

        $spouseMember = $faculty->personal_information->spouse_member;

        if (!$spouseMember) {
            return response()->json([
                'message' => 'No spouse member found.'
            ], 404);
        }

        $spouseData =
            [
                'publicId' => $spouseMember->public_id,
                'firstName' => $spouseMember->first_name,
                'middleName' => $spouseMember->middle_name,
                'lastName' => $spouseMember->last_name,
                'nameExtensionId' => $spouseMember->name_extension_id,
                'occupation' => $spouseMember->occupation,
                'employerBusinessName' => $spouseMember->employer_business_name,
                'businessAddress' => $spouseMember->business_address,
                'telephoneNumber' => $spouseMember->telephone_number,

            ];

        // Return the mapped records
        return response()->json($spouseData);
    }


    function update(Request $request)
    {

        $request->validate(
            [
                'first_name' => 'required|min:3',
                'middle_name' => 'nullable',
                'last_name' => 'required|min:3',
                'name_extension_id' => 'required',
                'occupation' => 'required|min:3',
                'employer_business_name' => 'nullable',
                'business_address' => 'nullable',
                'telephone_number' => 'nullable',
            ],
            [
                'first_name.required' => 'The first name is required.',
                'first_name.min' => 'The first name must be atleast 3 characters long',
                'last_name.required' => 'The last name is required.',
                'last_name.min' => 'The last name must be atleast 3 characters long',
                'name_extension_id.required' => 'Name extension is required! Select None if not applicable.',
                'occupation.required' => 'The occupation is required.',
                'employer_business_name.required' => 'The employer/business name is required.',
            ]
        );

        $faculty = Auth::user();

        $faculty->personal_information->spouse_member()->updateOrCreate(
            [
                'public_id' => $request->publicId,
            ],
            [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'name_extension_id' => $request->name_extension_id,
                'occupation' => $request->occupation,
                'employer_business_name' => $request->employer_business_name,
                'business_address' => $request->business_address,
                'telephone_number' => $request->telephone_number,
            ]
        );

        return redirect()->back()->with(['success' => 'Spouse member updated successfullly!']);
    }
}
