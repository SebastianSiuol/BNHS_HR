<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacultyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'email'                         => ['required', 'string', 'email', 'max:255', 'unique:faculties'],
            'date_of_joining'               => ['required', 'date_format:Y-m-d', 'after_or_equal:-1 day'],
            'designation_id'                => ['required'],
            'shift_id'                      => ['required'],
            'roles_id'                      => ['required', 'array'],
            'position_id'                   => ['required'],
            // 'photo'                         => ['required', 'file', 'mimes:jpeg,jpg,png', 'max:5000'],

    //          PERSONAL INFORMATION
            'first_name'                    => ['required'],
            'middle_name'                   => ['nullable'],
            'last_name'                     => ['required'],
            'name_extension_id'             => ['nullable'],
            'sex'                           => ['required'],
            'place_of_birth'                => ['required'],
            'date_of_birth'                 => ['required', 'date_format:Y-m-d', 'before: -18 year'],
            'contact_number'                => ['required'],
            'telephone_number'              => ['nullable'],
            'civil_status_id'               => ['required'],
            'department_head'               => ['nullable'],

    //          CONTACT PERSON
            'contact_person_name'           => ['required'],
            'contact_person_number'         => ['nullable'],

    //          ADDRESSES
            'residential_houseNumber'           => ['required'],
            'residential_street'                => ['required'],
            'residential_subdivision'           => ['required'],
            'residential_barangayName'          => ['required'],
            'residential_cityName'              => ['required'],
            'residential_provinceName'          => ['required'],
            'residential_zipCode'               => ['required'],

            // CONDITIONAL PERMANENT ADDRESS
            'permanent_houseNumber'             => ['required_unless:sameAddress,true'],
            'permanent_street'                   => ['required_unless:sameAddress,true'],
            'permanent_subdivision'             => ['required_unless:sameAddress,true'],
            'permanent_barangayName'            => ['required_unless:sameAddress,true'],
            'permanent_cityName'                => ['required_unless:sameAddress,true'],
            'permanent_provinceName'            => ['required_unless:sameAddress,true'],
            'permanent_zipCode'            => ['required_unless:sameAddress,true'],

            'sameAddress'                   => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_of_birth.before' => 'The employee must be at least 18 years old!',
            'date_of_joining.after_or_equal' => 'The joining date cannot be an earlier day than today!',
        ];
    }
}
