<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpouseMemberController extends Controller
{
    function update(Request $request){

        $validated = $request->validate([
            'first_name' => 'required|min:3',
            'middle_name' => 'nullable',
            'last_name' => 'required|min:3',
            'name_extension_id' => 'required',
            'occupation' => 'required|min:3',
            'employer_business_name' => 'required|min:3',
            'business_address' => 'nullable',
            'telephone_number' => 'nullable',
        ],[
            'first_name.required' => 'The first name is required.',
            'first_name.min' => 'The first name must be atleast 3 characters long',
            'last_name.required' => 'The last name is required.',
            'last_name.min' => 'The last name must be atleast 3 characters long',
            'occupation.required' => 'The occupation is required.',
            'employer_business_name.required' => 'The employer/business name is required.',
        ]
    );

        return redirect()->back()->with(['success' => 'Spouse member updated successfullly!']);
    }
}
