@props(['max_date', 'civil_statuses', 'name_exts'])

<div class="validate-all gap-4 mb-4">

    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
        <!-- FIRST NAME -->
        <div class="required-inputs mt-4">
            <x-admin-form-label for="first_name">
                First Name
            </x-admin-form-label>
            <x-admin-form-input name="first_name" />
        </div>

        <!-- MIDDLE NAME -->
        <div class="required-inputs mt-4">
            <x-admin-form-label for="middle_name">
                Middle Name
            </x-admin-form-label>
            <x-admin-form-input name="middle_name" />
        </div>

        <!-- LAST NAME -->
        <div class="required-inputs mt-4">
            <x-admin-form-label for="last_name">
                Last Name
            </x-admin-form-label>
            <x-admin-form-input name="last_name" />
        </div>

        <!-- NAME EXTENSION -->
        <div class="mt-4">
            <x-admin-form-label for="name_extension">
                Name Extension
            </x-admin-form-label>
            <select id="name_extension"
                    name="name_extension"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                <option {{ empty(old('name_extension'))  ? 'selected=selected': '' }}  disabled value='0'>Select Name Extension</option>
                @foreach($name_exts as $name_ext)
                    <option
                        value="{{ $name_ext->id }}" {{old ('marital_status') == $name_ext->id ? 'selected=selected' : ''}}>{{$name_ext->title}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
        <!-- PLACE OF BIRTH -->
        <div class="required-inputs mt-4">
            <x-admin-form-label for="place_of_birth">
                Place of Birth
            </x-admin-form-label>
            <x-admin-form-input name="place_of_birth" />
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
                       value="{{ old('date_of_birth') }}"
                       datepicker
                       datepicker-autohide
                       datepicker-format="mm-dd-yyyy"
                       datepicker-autoselect-today
                       datepicker-min-date="01-01-1940"
                       datepicker-max-date="{{$max_date}}"
                       class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5">
            </div>
        </div>

        <!-- SEX? -->
        <div class="mt-4">
            <x-admin-form-label for="sex">
                Sex
            </x-admin-form-label>
            <select id="sex"
                    name="sex"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">
                <option {{ empty(old('sex'))  ? 'selected=selected': '' }} disabled value='0'>Select Sex</option>
                <option value="Male" {{ old('sex') === 'Male' ? 'selected=selected': '' }}>Male</option>
                <option value="Female" {{ old('sex') === 'Female' ? 'selected=selected': '' }}>Female</option>
            </select>
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
                <option selected disabled value="0">Select Marital Status</option>
                @foreach($civil_statuses as $civil_status)
                    <option
                        value="{{ $civil_status->id }}" {{old ('marital_status') == $civil_status->id ? 'selected=selected' : ''}}>{{$civil_status->civil_status}}</option>
                @endforeach

            </select>
        </div>
    </div>


    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
        <!-- CONTACT NUMBER -->
        <div class="required-inputs mt-4">
            <x-admin-form-label for="contact_number">
                Contact Number
            </x-admin-form-label>
            <x-admin-form-input name="contact_number" />
        </div>

        <!-- TELEPHONE NUMBER -->
        <div class="mt-4">
            <x-admin-form-label for="telephone_number">
                Telephone Number
            </x-admin-form-label>
            <x-admin-form-input name="telephone_number" />
        </div>

        <!-- CONTACT PERSON NAME -->
        <div class="required-inputs mt-4">
            <x-admin-form-label for="contact_person_name">
                Contact Person Name
            </x-admin-form-label>
            <x-admin-form-input name="contact_person_name" />
        </div>

        <!-- CONTACT PERSON NUMBER -->
        <div class="required-inputs mt-4">
            <x-admin-form-label for="contact_person_number">
                Contact Person Number
            </x-admin-form-label>
            <x-admin-form-input name="contact_person_number" />
        </div>
    </div>

        <x-divider />

    <div class="grid grid-cols-none lg:grid-cols-2 gap-2">
        <div>
            <!-- RESIDENTIAL ADDRESS -->
            <div>
                <h6 class="font-semibold">Residential Address</h6>
            </div>

            <div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-admin-form-label for="residential_house_num">
                            House/Block/Lot No.
                        </x-admin-form-label>
                        <x-admin-form-input name="residential_house_num" />

                    </div>

                    <div class="required-inputs">

                        <x-admin-form-label for="residential_street">
                            Street
                        </x-admin-form-label>
                        <x-admin-form-input name="residential_street" />

                    </div>
                </div>
                <div class="required-inputs">

                    <x-admin-form-label for="residential_subdivision">
                        Subdivision/Village
                    </x-admin-form-label>
                    <x-admin-form-input name="residential_subdivision" />

                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-admin-form-label for="residential_barangay">
                            Barangay
                        </x-admin-form-label>
                        <x-admin-form-input name="residential_barangay" />

                    </div>
                    <div class="required-inputs">

                        <x-admin-form-label for="residential_city">
                            City/Municipality
                        </x-admin-form-label>
                        <x-admin-form-input name="residential_city" />

                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-admin-form-label for="residential_province">
                            Province
                        </x-admin-form-label>
                        <x-admin-form-input name="residential_province" />

                    </div>
                    <div class="required-inputs">

                        <x-admin-form-label for="residential_zip_code">
                            Zip Code
                        </x-admin-form-label>
                        <x-admin-form-input name="residential_zip_code" />

                    </div>
                </div>
            </div>
        </div>

        <div>
            <!-- PERMANENT ADDRESS -->
            <div>
                <h6 class="font-semibold">Permanent Address</h6>
                {{--                <div class="flex items-center mb-4 mt-2">--}}
                {{--                    <input id="both_address_same"--}}
                {{--                           name="both_address_same"--}}
                {{--                           type="checkbox"--}}
                {{--                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">--}}
                {{--                    <label for="both_address_same"--}}
                {{--                           class="ms-2 text-sm font-medium text-gray-900">--}}
                {{--                        Same as Residential--}}
                {{--                    </label>--}}
                {{--                </div>--}}
            </div>
            <div id="permanent_address_form">
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-admin-form-label for="permanent_house_num">
                            House/Block/Lot No.
                        </x-admin-form-label>
                        <x-admin-form-input name="permanent_house_num" />
                    </div>
                    <div class="required-inputs">
                        <x-admin-form-label for="permanent_street">
                            Street
                        </x-admin-form-label>
                        <x-admin-form-input name="permanent_street" />
                    </div>
                </div>
                <div class="required-inputs">
                    <x-admin-form-label for="permanent_subdivision">
                        Subdivision/Village
                    </x-admin-form-label>
                    <x-admin-form-input name="permanent_subdivision" />
                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-admin-form-label for="permanent_barangay">
                            Barangay
                        </x-admin-form-label>
                        <x-admin-form-input name="permanent_barangay" />
                    </div>
                    <div class="required-inputs">
                        <x-admin-form-label for="permanent_city">
                            City/Municipality
                        </x-admin-form-label>
                        <x-admin-form-input name="permanent_city" />
                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-admin-form-label for="permanent_province">
                            Province
                        </x-admin-form-label>
                        <x-admin-form-input name="permanent_province" />

                    </div>
                    <div class="required-inputs">
                        <x-admin-form-label for="permanent_zip_code">
                            Zip Code
                        </x-admin-form-label>
                        <x-admin-form-input name="permanent_zip_code" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PHOTO -->
    <div class="mt-4">
        <x-admin-form-label for="photo">
            Photo
        </x-admin-form-label>
        <input
            id="file_input"
            type="file"
            disabled="disabled"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
        >
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

