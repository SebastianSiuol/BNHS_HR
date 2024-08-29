@props(['max_date', 'civil_statuses'])

<div class="grid gap-4 mb-4 sm:grid-cols-2">
    <div>
        <div class="mt-4">
            <x-admin-form-label for="first_name">
                First Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="first_name" id="first_name" required="">
                First Name
            </x-admin-form-input>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="middle_name">
                Middle Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="middle_name" id="middle_name">
                Middle Name
            </x-admin-form-input>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="last_name">
                Last Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="last_name" id="last_name">
                Last Name
            </x-admin-form-input>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="name_extension">
                Name Extension
            </x-admin-form-label>
            <x-admin-form-input type="text" name="name_extension" id="name_extension">
                Name Extension
            </x-admin-form-input>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="birthdate">
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
                <input id="birthdate-picker"
                       datepicker
                       datepicker-autoselect-today
                       datepicker-max-date="{{$max_date}}"
                       name="birthdate"
                       type="text"
                       class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5      "
                       placeholder="Select date">
            </div>

        </div>

        <div class="mt-4">
            <x-admin-form-label for="contact_number">
                Contact Number
            </x-admin-form-label>
            <x-admin-form-input type="text" name="contact_number" id="contact_number">
                09xxxxxxxxx
            </x-admin-form-input>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="nationality">
                Nationality
            </x-admin-form-label>

            <x-admin-form-input type="text" name="nationality" id="nationality">
                Nationality
            </x-admin-form-input>
        </div>

        <div class="mt-4">

            <x-admin-form-label for="reference_name_01">
                Reference Name 01
            </x-admin-form-label>

            <x-admin-form-input type="text" name="reference_name_01" id="reference_name_01">
                John Doe
            </x-admin-form-input>

        </div>

        <div class="mt-4">

            <x-admin-form-label for="reference_contact_number_01">
                Reference Contact Number 01
            </x-admin-form-label>
            <x-admin-form-input type="text" name="reference_contact_number_01" id="reference_contact_number_01">
                09xxxxxxxxx
            </x-admin-form-input>

        </div>
        <div class="mt-4">

            <x-admin-form-label for="reference_name_02">
                Reference Name 02
            </x-admin-form-label>
            <x-admin-form-input type="text" name="reference_name_02" id="reference_name_02">
                Jane Doe
            </x-admin-form-input>

        </div>
        <div class="mt-4">

            <x-admin-form-label for="reference_contact_number_02">
                Reference Contact Number 02
            </x-admin-form-label>
            <x-admin-form-input type="text" name="reference_contact_number_02" id="reference_contact_number_02">
                09xxxxxxxxx
            </x-admin-form-input>

        </div>
    </div>

    <div>
        <div class="mt-4">
            <x-admin-form-label for="contact_person_name">
                Contact Person Name
            </x-admin-form-label>
            <x-admin-form-input type="text" name="contact_person_name" id="contact_person_name">
                John Doe
            </x-admin-form-input>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="contact_person_number">
                Contact Person Number
            </x-admin-form-label>
            <x-admin-form-input type="text" name="contact_person_number" id="contact_person_number">
                09xxxxxxxxx
            </x-admin-form-input>
        </div>

        <div class="mt-4">
            <x-admin-form-label for="sex">
                Sex
            </x-admin-form-label>
            <select id="sex"
                    name="sex"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                <option selected disabled>Select Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="mt-4">
            <div>
                <h6 class="font-semibold">Residential Address</h6>
            </div>
            <div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="residential_house_num">
                            House/Block/Lot No.
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_house_num" id="residential_house_num">
                            House/Block/Lot No.
                        </x-admin-form-input>

                    </div>

                    <div>

                        <x-admin-form-label for="residential_street">
                            Street
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_street" id="residential_street">
                            Street
                        </x-admin-form-input>

                    </div>
                </div>
                <div>

                    <x-admin-form-label for="residential_subdivision">
                        Subdivision/Village
                    </x-admin-form-label>
                    <x-admin-form-input type="text" name="residential_subdivision" id="residential_subdivision">
                        Subdivision/Village
                    </x-admin-form-input>

                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="residential_barangay">
                            Barangay
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_barangay" id="residential_barangay">
                            Barangay
                        </x-admin-form-input>

                    </div>
                    <div>

                        <x-admin-form-label for="residential_city">
                            City/Municipality
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_city" id="residential_city">
                            City/Municipality
                        </x-admin-form-input>

                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="residential_province">
                            Province
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_province" id="residential_province">
                            Province
                        </x-admin-form-input>

                    </div>
                    <div>

                        <x-admin-form-label for="residential_zip_code">
                            Zip Code
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="residential_zip_code" id="residential_zip_code">
                            Zip Code
                        </x-admin-form-input>

                    </div>
                </div>
            </div>

            <div>
                <h6 class="font-semibold">Permanent Address</h6>
                <div class="flex items-center mb-4 mt-2">
                    <input id="both_address_same"
                           name="both_address_same"
                           type="checkbox"
                           value="1"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="both_address_same"
                           class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        same as Residential?
                    </label>
                </div>
            </div>
            <div id="permanent_address_form">
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="permanent_house_num">
                            House/Block/Lot No.
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_house_num" id="permanent_house_num">
                            House/Block/Lot No.
                        </x-admin-form-input>

                    </div>

                    <div>

                        <x-admin-form-label for="permanent_street">
                            Street
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_street" id="permanent_street">
                            Street
                        </x-admin-form-input>

                    </div>
                </div>
                <div>

                    <x-admin-form-label for="permanent_subdivision">
                        Subdivision/Village
                    </x-admin-form-label>
                    <x-admin-form-input type="text" name="permanent_subdivision" id="permanent_subdivision">
                        Subdivision/Village
                    </x-admin-form-input>

                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="permanent_barangay">
                            Barangay
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_barangay" id="permanent_barangay">
                            Barangay
                        </x-admin-form-input>

                    </div>
                    <div>

                        <x-admin-form-label for="permanent_city">
                            City/Municipality
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_city" id="permanent_city">
                            City/Municipality
                        </x-admin-form-input>

                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div>

                        <x-admin-form-label for="permanent_province">
                            Province
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_province" id="permanent_province">
                            Province
                        </x-admin-form-input>

                    </div>
                    <div>

                        <x-admin-form-label for="permanent_zip_code">
                            Zip Code
                        </x-admin-form-label>
                        <x-admin-form-input type="text" name="permanent_zip_code" id="permanent_zip_code">
                            Zip Code
                        </x-admin-form-input>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <x-admin-form-label for="marital_status">
                Marital Status
            </x-admin-form-label>
            <select id="marital_status"
                    name="marital_status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected disabled>Select Marital Status</option>
                @foreach($civil_statuses as $civil_status)
                    <option
                        value="{{ $civil_status->id }}">{{$civil_status->civil_status}}</option>
                @endforeach

            </select>
        </div>
        <div class="mt-4">
            <x-admin-form-label for="photo">
                Photo
            </x-admin-form-label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                id="file_input" type="file">
        </div>
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
