@props(['max_date', 'civil_statuses', 'faculty', 'name_exts', 'psn_info'])

<div class="grid gap-4 mb-4 sm:grid-cols-2">
    <div>

        <!-- FIRST NAME -->
        <div class="validate-pd-txt-inputs mt-4">
            <x-admin-form-label for="first_name">
                First Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="first_name" id="first_name" value="{{ $psn_info->first_name }}"/>
        </div>

        <!-- MIDDLE NAME -->
        <div class="mt-4">
            <x-admin-form-label for="middle_name">
                Middle Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="middle_name" id="middle_name" value="{{ $psn_info->middle_name }}"/>
        </div>

        <!-- LAST NAME -->
        <div class="validate-pd-txt-inputs mt-4">
            <x-admin-form-label for="last_name">
                Last Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="last_name" id="last_name" value="{{ $psn_info->last_name }}"/>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="name_extension">
                Name Extension
            </x-admin-form-label>
            <select id="name_extension"
                    name="name_extension"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                <option disabled value='null'>Select Name Extension</option>
                @foreach($name_exts as $name_ext)
                    <option
                        value="{{ $name_ext->id }}" {{ $psn_info->name_extension_id == $name_ext->id ? 'selected=selected' : ''}}>{{$name_ext->title}}</option>
                @endforeach
            </select>
        </div>

        <!-- PLACE OF BIRTH -->
        <div class="validate-pd-txt-inputs mt-4">
            <x-admin-form-label for="place_of_birth">
                Place of Birth
            </x-admin-form-label>
            <x-admin-form-input type="text" name="place_of_birth" id="place_of_birth" value="{{ $psn_info->place_of_birth }}" />
        </div>

        <!-- BIRTH DATE -->
        <div class="mt-4">
            <x-admin-form-label for="date_of_birth">
                Date of Birth
            </x-admin-form-label>

            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="date_of_birth"
                       name="date_of_birth"
                       placeholder="Select date"
                       required="required"
                       pattern="^(0[1-9]|1z[0-2])-(0[1-9]|[12][0-9]|3[01])-(\d{4})$"
                       value="{{ $psn_info->date_of_birth }}"
                       datepicker
                       datepicker-autohide
                       datepicker-format="mm-dd-yyyy"
                       datepicker-autoselect-today
                       datepicker-min-date="01-01-1900"
                       datepicker-max-date="{{$max_date}}"
                       class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5">
            </div>
        </div>

        <!-- CONTACT NUMBER -->
        <div class="validate-pd-txt-inputs mt-4">
            <x-admin-form-label for="contact_number">
                Contact Number
            </x-admin-form-label>
            <x-admin-form-input type="text" name="contact_number" id="contact_number" value="{{ $psn_info->contact_no }}"/>
        </div>

        <!-- TELEPHONE NUMBER -->
        <div class="mt-4">
            <x-admin-form-label for="telephone_number">
                Telephone Number
            </x-admin-form-label>
            <x-admin-form-input type="text" name="telephone_number" id="telephone_number" value="{{ $psn_info->telephone_no }}"/>
        </div>

        <!-- NATIONALITY -->
        <div class="validate-pd-txt-inputs mt-4">
            <x-admin-form-label for="nationality">
                Nationality
            </x-admin-form-label>

            <x-admin-form-input type="text" name="nationality" id="nationality" value="Filipino"/>
        </div>
        {{--        TODO: MAKE THIS WORK--}}
{{--        <!-- REFERENCE NAME 01-->--}}
{{--        <div class="validate-pd-txt-inputs mt-4">--}}

{{--            <x-admin-form-label for="reference_name_01">--}}
{{--                Reference Name 01--}}
{{--            </x-admin-form-label>--}}

{{--            <x-admin-form-input type="text" name="reference_name_01" id="reference_name_01" value="{{ $psn_info->getFirstRefMember[0]['name'] }}">--}}
{{--                John Doe--}}
{{--            </x-admin-form-input>--}}

{{--        </div>--}}


{{--        <!-- REFERENCE NUMBER 01-->--}}
{{--        <div class="validate-pd-txt-inputs mt-4">--}}

{{--            <x-admin-form-label for="reference_contact_number_01">--}}
{{--                Reference Contact Number 01--}}
{{--            </x-admin-form-label>--}}
{{--            <x-admin-form-input type="text" name="reference_contact_number_01" id="reference_contact_number_01" value="{{ $psn_info->getFirstRefMember[0]['contact_number'] }}">--}}
{{--                09xxxxxxxxx--}}
{{--            </x-admin-form-input>--}}

{{--        </div>--}}

{{--        <!-- REFERENCE NAME 02-->--}}
{{--        <div class="mt-4">--}}

{{--            <x-admin-form-label for="reference_name_02">--}}
{{--                Reference Name 02--}}
{{--            </x-admin-form-label>--}}
{{--            <x-admin-form-input type="text" name="reference_name_02" id="reference_name_02" value="{{ old('reference_name_02') }}">--}}
{{--                Jane Doe--}}
{{--            </x-admin-form-input>--}}

{{--        </div>--}}

{{--        <!-- REFERENCE NUMBER 02-->--}}
{{--        <div class="mt-4">--}}

{{--            <x-admin-form-label for="reference_contact_number_02">--}}
{{--                Reference Contact Number 02--}}
{{--            </x-admin-form-label>--}}
{{--            <x-admin-form-input type="text" name="reference_contact_number_02" id="reference_contact_number_02" value="{{ old('reference_contact_number_02') }}">--}}
{{--                09xxxxxxxxx--}}
{{--            </x-admin-form-input>--}}

{{--        </div>--}}

    </div>
    <div>

        <!-- CONTACT PERSON NAME -->
        <div class="validate-pd-txt-inputs mt-4">
            <x-admin-form-label for="contact_person_name">
                Contact Person Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="contact_person_name" id="contact_person_name" value="{{ $psn_info->contact_person->name }}">
                John Doe
            </x-admin-form-input>
        </div>

        <!-- CONTACT PERSON NUMBER -->
        <div class="validate-pd-txt-inputs mt-4">
            <x-admin-form-label for="contact_person_number">
                Contact Person Number
            </x-admin-form-label>
            <x-admin-form-input type="text" name="contact_person_number" id="contact_person_number" value="{{ $psn_info->contact_person->contact_no }}">
                09xxxxxxxxx
            </x-admin-form-input>
        </div>

        <!-- SEX? -->
        <div class="mt-4">
            <x-admin-form-label for="sex">
                Sex
            </x-admin-form-label>
            <select id="sex"
                    name="sex"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                <option disabled>Select Sex</option>
                <option value="Male" {{ $psn_info->sex === 'Male' ? 'selected=selected': '' }}>Male</option>
                <option value="Female" {{ $psn_info->sex === 'Female' ? 'selected=selected': '' }}>Female</option>
            </select>
        </div>

        <!-- RESIDENTIAL ADDRESS -->
        <div class="mt-4">
            <div>
                <h6 class="font-semibold">Residential Address</h6>
            </div>

            <div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="validate-pd-txt-inputs">

                        <x-admin-form-label for="residential_house_num">
                            House/Block/Lot No.
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_house_num" id="residential_house_num" value="{{ $psn_info->residential_address->house_block_no }}">
                            House/Block/Lot No.
                        </x-admin-form-input>

                    </div>

                    <div class="validate-pd-txt-inputs">

                        <x-admin-form-label for="residential_street">
                            Street
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_street" id="residential_street" value="{{ $psn_info->residential_address->street }}">
                            Street
                        </x-admin-form-input>

                    </div>
                </div>
                <div class="validate-pd-txt-inputs">

                    <x-admin-form-label for="residential_subdivision">
                        Subdivision/Village
                    </x-admin-form-label>
                    <x-admin-form-input type="text" name="residential_subdivision" id="residential_subdivision" value="{{ $psn_info->residential_address->subdivision_village }}">
                        Subdivision/Village
                    </x-admin-form-input>

                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div class="validate-pd-txt-inputs">

                        <x-admin-form-label for="residential_barangay">
                            Barangay
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_barangay" id="residential_barangay" value="{{ $psn_info->residential_address->barangay }}">
                            Barangay
                        </x-admin-form-input>

                    </div>
                    <div class="validate-pd-txt-inputs">

                        <x-admin-form-label for="residential_city">
                            City/Municipality
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_city" id="residential_city" value="{{ $psn_info->residential_address->city_municipality }}">
                            City/Municipality
                        </x-admin-form-input>

                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="validate-pd-txt-inputs">

                        <x-admin-form-label for="residential_province">
                            Province
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_province" id="residential_province" value="{{ $psn_info->residential_address->province }}">
                            Province
                        </x-admin-form-input>

                    </div>
                    <div class="validate-pd-txt-inputs">

                        <x-admin-form-label for="residential_zip_code">
                            Zip Code
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_zip_code" id="residential_zip_code" value="{{ $psn_info->residential_address->zip_code }}">
                            Zip Code
                        </x-admin-form-input>

                    </div>
                </div>
            </div>

            <!-- PERMANENT ADDRESS -->
            <div>
                <h6 class="font-semibold">Permanent Address</h6>

            </div>
            <div id="permanent_address_form">
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="permanent_house_num">
                            House/Block/Lot No.
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_house_num" id="permanent_house_num" value="{{$psn_info->permanent_address->house_block_no }}">
                            House/Block/Lot No.
                        </x-admin-form-input>

                    </div>

                    <div>

                        <x-admin-form-label for="permanent_street">
                            Street
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_street" id="permanent_street" value="{{$psn_info->permanent_address->street }}">
                            Street
                        </x-admin-form-input>

                    </div>
                </div>
                <div>

                    <x-admin-form-label for="permanent_subdivision">
                        Subdivision/Village
                    </x-admin-form-label>
                    <x-admin-form-input type="text" name="permanent_subdivision" id="permanent_subdivision" value="{{$psn_info->permanent_address->subdivision_village }}">
                        Subdivision/Village
                    </x-admin-form-input>

                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="permanent_barangay">
                            Barangay
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_barangay" id="permanent_barangay" value="{{$psn_info->permanent_address->barangay }}">
                            Barangay
                        </x-admin-form-input>

                    </div>
                    <div>

                        <x-admin-form-label for="permanent_city">
                            City/Municipality
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_city" id="permanent_city" value="{{$psn_info->permanent_address->city_municipality }}">
                            City/Municipality
                        </x-admin-form-input>

                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="permanent_province">
                            Province
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_province" id="permanent_province" value="{{$psn_info->permanent_address->province }}">
                            Province
                        </x-admin-form-input>

                    </div>
                    <div>

                        <x-admin-form-label for="permanent_zip_code">
                            Zip Code
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_zip_code" id="permanent_zip_code" value="{{$psn_info->permanent_address->zip_code }}">
                            Zip Code
                        </x-admin-form-input>

                    </div>
                </div>
            </div>
        </div>


        <!-- MARITAL STATUS -->
        <div class="mt-4">
            <x-admin-form-label for="marital_status">
                Marital Status
            </x-admin-form-label>
            <select id="marital_status"
                    name="marital_status"
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option disabled value="0">Select Marital Status</option>
                @foreach($civil_statuses as $civil_status)
                    <option
                        value="{{ $civil_status->id }}" {{$psn_info->civil_status_id == $civil_status->id ? 'selected=selected' : ''}}>{{$civil_status->civil_status}}</option>
                @endforeach

            </select>
        </div>

        <!-- PHOTO -->
        <div class="mt-4">
            <x-admin-form-label for="photo">
                Photo
            </x-admin-form-label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                id="file_input" type="file">
        </div>

        <!-- COMMENT -->
        <div class="mt-4">
            <x-admin-form-label for="comment">
                Comment
            </x-admin-form-label>
            <textarea disabled
                      id="comment"
                      name="comment"
                      class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

    </div>
</div>
