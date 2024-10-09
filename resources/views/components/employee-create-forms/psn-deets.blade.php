@props(['max_date', 'civil_statuses', 'name_exts'])

<div class="gap-4 mb-4">


    {{-- First Row --}}
    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">

        {{-- FIRST NAME --}}
        <div class="required-inputs mt-4">
            <x-forms.label label_name="First Name" for="first_name" />
            <x-forms.input name="first_name" placeholder="First Name" />
        </div>

        {{-- MIDDLE NAME --}}
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Middle Name" for="middle_name" />
            <x-forms.input name="middle_name" placeholder="Middle Name" />
        </div>

        {{-- LAST NAME --}}
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Last Name" for="last_name" />
            <x-forms.input name="last_name" placeholder="Last Name" />
        </div>

        {{-- NAME EXTENSION --}}
        <div class="mt-4">
            <x-forms.label label_name="Name Extension" for="name_extension" />

            <x-forms.select name="name_extension">

                <option {{ empty(old('name_extension'))  ? 'selected=selected': '' }}  disabled value='0'>Select Name Extension</option>

            @foreach($name_exts as $name_ext)
                <option
                    value="{{ $name_ext->id }}" {{old ('name_extension') == $name_ext->id ? 'selected=selected' : ''}}>{{$name_ext->title}}</option>
            @endforeach

            </x-forms.select>

        </div>

    </div>

    {{-- Second Row --}}
    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
        {{-- PLACE OF BIRTH --}}
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Place of Birth" for="place_of_birth" />
            <x-forms.input name="place_of_birth" placeholder="Place of Birth" />
        </div>

        {{-- BIRTH DATE --}}
        <div class="mt-4">
            <x-forms.label label_name="Date of Birth" for="date_of_birth" />

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

        {{-- SEX? --}}
        <div class="mt-4">
            <x-forms.label label_name="Sex" for="sex" />

            <x-forms.select name="sex">

                <option {{ empty(old('sex'))  ? 'selected=selected': '' }} disabled value='0'>Select Sex</option>
                <option value="Male" {{ old('sex') === 'Male' ? 'selected=selected': '' }}>Male</option>
                <option value="Female" {{ old('sex') === 'Female' ? 'selected=selected': '' }}>Female</option>

            </x-forms.select>

        </div>

        {{-- MARITAL STATUS --}}
        <div class="mt-4">
            <x-forms.label label_name="Civil Status" for="civil_status"/>

            <x-forms.select name="civil_status">

                <option selected disabled value="0">Select Marital Status</option>

            @foreach($civil_statuses as $civil_status)
                <option
                    value="{{ $civil_status->id }}" {{old ('civil_status') == $civil_status->id ? 'selected=selected' : ''}}>{{$civil_status->civil_status}}</option>
            @endforeach

            </x-forms.select>


        </div>
    </div>


    {{-- Third Row --}}
    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
        {{-- CONTACT NUMBER --}}
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Contact Number" for="contact_number"/>
            <x-forms.input name="contact_number" placeholder="Contact Number" />
        </div>

        {{-- TELEPHONE NUMBER --}}
        <div class="mt-4">
            <x-forms.label label_name="Telephone Number" for="telephone_number"/>
            <x-forms.input name="telephone_number" placeholder="Telephone Number" />
        </div>

        {{-- CONTACT PERSON NAME --}}
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Contact Person Name" for="contact_person_name" />
            <x-forms.input name="contact_person_name" placeholder="Contact Person Name" />
        </div>

        {{-- CONTACT PERSON NUMBER --}}
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Contact Person Number" for="contact_person_number" />
            <x-forms.input name="contact_person_number" placeholder="Contact Person Number" />
        </div>
    </div>

        <x-divider />

    <div class="grid grid-cols-none lg:grid-cols-2 gap-16">
        <div>
            {{-- RESIDENTIAL ADDRESS --}}
            <div>
                <h6 class="font-semibold">Residential Address</h6>
            </div>

            <div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-forms.label label_name="House/Block/Lot No." for="residential_house_num" />
                        <x-forms.input name="residential_house_num" placeholder="House/Block/Lot No." />

                    </div>

                    <div class="required-inputs">

                        <x-forms.label label_name="Street" for="residential_street" />
                        <x-forms.input name="residential_street" placeholder="Street" />

                    </div>
                </div>
                <div class="required-inputs">

                    <x-forms.label label_name="Subdivision/Village" for="residential_subdivision" />
                    <x-forms.input name="residential_subdivision" placeholder="Subdivision/Village" />

                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-forms.label label_name="Barangay" for="residential_barangay" />
                        <x-forms.input name="residential_barangay" placeholder="Barangay" />

                    </div>
                    <div class="required-inputs">

                        <x-forms.label label_name="City/Municipality" for="residential_city" />
                        <x-forms.input name="residential_city" placeholder="City/Municipality" />

                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-forms.label label_name="Province" for="residential_province" />
                        <x-forms.input name="residential_province" placeholder="Province" />

                    </div>
                    <div class="required-inputs">

                        <x-forms.label label_name="Zip Code" for="residential_zip_code" />
                        <x-forms.input name="residential_zip_code" placeholder="Zip Code" />

                    </div>
                </div>
            </div>
        </div>

        <div>
            {{-- PERMANENT ADDRESS --}}
            <div class="flex gap-x-3">
                <h6 class="font-semibold">Permanent Address</h6>

{{--                <div class="flex items-center mb-4 mt-2">
                    <input id="both_address_same"
                           name="both_address_same"
                           type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="both_address_same"
                           class="ms-2 text-sm font-medium text-gray-900">
                        Same as Residential
                    </label>
                </div>--}}

                <button type="button"
                        id="same_address_button"
                        class="px-2 text-center text-sm text-white border border-blue-700 rounded-lg bg-blue-700 hover:bg-blue-800 hover:border-blue-800">
                    Same as Residential
                </button>

            </div>
            <div id="permanent_address_form">
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-forms.label label_name="House/Block/Lot No." for="permanent_house_num" />

                        <x-forms.input name="permanent_house_num" placeholder="House/Block/Lot No." />
                    </div>
                    <div class="required-inputs">
                        <x-forms.label label_name="Street" for="permanent_street" />

                        <x-forms.input name="permanent_street" placeholder="Street" />
                    </div>
                </div>
                <div class="required-inputs">
                    <x-forms.label label_name="Subdivision/Village" for="permanent_subdivision" />

                    <x-forms.input name="permanent_subdivision" placeholder="Subdivision/Village" />
                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-forms.label label_name="Barangay" for="permanent_barangay" />

                        <x-forms.input name="permanent_barangay" placeholder="Barangay" />
                    </div>
                    <div class="required-inputs">
                        <x-forms.label label_name="City" for="permanent_city" />

                        <x-forms.input name="permanent_city" placeholder="City" />
                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-forms.label label_name="Province" for="permanent_province" />

                        <x-forms.input name="permanent_province" placeholder="Province" />

                    </div>
                    <div class="required-inputs">
                        <x-forms.label label_name="Zip Code" for="permanent_zip_code" />

                        <x-forms.input name="permanent_zip_code" placeholder="Zip Code" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PHOTO --}}
    <div class="mt-4">
        <x-forms.label label_name="Photo" for="photo" />

        <x-forms.file-input name="photo"/>
    </div>

    {{-- COMMENT --}}
    <div class="mt-4">
        <x-forms.label label_name="Comment" for="comment" />
        <textarea id="comment"
                  name="comment"
                  class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500"></textarea>
    </div>
</div>

