@props(['max_date', 'civil_statuses', 'faculty', 'name_exts', 'psn_info'])

<div class="mb-4">
    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">

        <!-- FIRST NAME -->
        <div class="required-inputs mt-4">
            <x-forms.label label_name="First Name" for="first_name"/>
            <x-forms.input name="first_name" placeholder="First Name" value="{{ $psn_info->first_name }}"/>
        </div>

        <!-- MIDDLE NAME -->
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Middle Name" for="middle_name"/>
            <x-forms.input name="middle_name" placeholder="Middle Name" value="{{ $psn_info->middle_name }}"/>
        </div>

        <!-- LAST NAME -->
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Last Name" for="last_name"/>
            <x-forms.input name="last_name" placeholder="Last Name" value="{{ $psn_info->last_name }}"/>
        </div>

        <!-- NAME EXTENSION -->
        <div class="mt-4">
            <x-forms.label label_name="Name Extension" for="name_extension"/>


            <x-forms.select name="name_extension">

                <option {{ empty(old('name_extension'))  ? 'selected=selected': '' }}  disabled value='0'>Select Name
                    Extension
                </option>

                @foreach($name_exts as $name_ext)
                    <option
                        value="{{ $name_ext->id }}" {{ $psn_info->name_extension_id == $name_ext->id ? 'selected=selected' : ''}}>{{$name_ext->title}}</option>
                @endforeach

            </x-forms.select>

        </div>

    </div>

    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
        <!-- PLACE OF BIRTH -->
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Place of Birth" for="place_of_birth" />
            <x-forms.input name="place_of_birth" placeholder="Place of Birth" value="{{ $psn_info->place_of_birth }}"/>
        </div>

        <!-- BIRTH DATE -->
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
                       value="{{ $psn_info->date_of_birth }}"
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
            <x-forms.label label_name="Sex" for="sex" />

            <x-forms.select name="sex">

                <option disabled>Select Sex</option>
                <option value="Male" {{ $psn_info->sex === 'Male' ? 'selected=selected': '' }}>Male</option>
                <option value="Female" {{ $psn_info->sex === 'Female' ? 'selected=selected': '' }}>Female</option>

            </x-forms.select>

        </div>

        <!-- MARITAL STATUS -->
        <div class="mt-4">
            <x-forms.label label_name="Civil Status" for="civil_status"/>

            <x-forms.select name="civil_status">

                <option disabled value="0">Select Civil Status</option>
                @foreach($civil_statuses as $civil_status)
                    <option
                        value="{{ $civil_status->id }}" {{$psn_info->civil_status_id == $civil_status->id ? 'selected=selected' : ''}}>{{$civil_status->civil_status}}</option>
                @endforeach

            </x-forms.select>


        </div>
    </div>

    <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
        <!-- CONTACT NUMBER -->
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Contact Number" for="contact_number"/>
            <x-forms.input name="contact_number" placeholder="Contact Number" value="{{ $psn_info->contact_no }}" />
        </div>

        <!-- TELEPHONE NUMBER -->
        <div class="mt-4">
            <x-forms.label label_name="Telephone Number" for="telephone_number"/>
            <x-forms.input name="telephone_number" placeholder="Telephone Number" value="{{ $psn_info->telephone_no }}" />
        </div>

        <!-- CONTACT PERSON NAME -->
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Contact Person Name" for="contact_person_name" />
            <x-forms.input name="contact_person_name" placeholder="Contact Person Name" value="{{ $psn_info->contact_person->name }}" />
        </div>

        <!-- CONTACT PERSON NUMBER -->
        <div class="required-inputs mt-4">
            <x-forms.label label_name="Contact Person Number" for="contact_person_number" />
            <x-forms.input name="contact_person_number" placeholder="Contact Person Number" value="{{ $psn_info->contact_person->contact_no }}" />
        </div>
    </div>

    <x-divider />

    <div class="grid grid-cols-none lg:grid-cols-2 gap-16">
        <div>
            <!-- RESIDENTIAL ADDRESS -->
            <div>
                <h6 class="font-semibold">Residential Address</h6>
            </div>

            <div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-forms.label label_name="House/Block/Lot No." for="residential_house_num" />
                        <x-forms.input name="residential_house_num" placeholder="House/Block/Lot No." value="{{ $psn_info->residential_address->house_block_no }}"/>

                    </div>

                    <div class="required-inputs">

                        <x-forms.label label_name="Street" for="residential_street" />
                        <x-forms.input name="residential_street" placeholder="Street" value="{{ $psn_info->residential_address->street }}"/>

                    </div>
                </div>
                <div class="required-inputs">

                    <x-forms.label label_name="Subdivision/Village" for="residential_subdivision" />
                    <x-forms.input name="residential_subdivision" placeholder="Subdivision/Village" value="{{ $psn_info->residential_address->subdivision_village }}"/>

                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-forms.label label_name="Barangay" for="residential_barangay" />
                        <x-forms.input name="residential_barangay" placeholder="Barangay" value="{{ $psn_info->residential_address->barangay }}"/>

                    </div>
                    <div class="required-inputs">

                        <x-forms.label label_name="City/Municipality" for="residential_city" />
                        <x-forms.input name="residential_city" placeholder="City/Municipality" value="{{ $psn_info->residential_address->city_municipality }}"/>

                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">

                        <x-forms.label label_name="Province" for="residential_province" />
                        <x-forms.input name="residential_province" placeholder="Province" value="{{ $psn_info->residential_address->province }}"/>

                    </div>
                    <div class="required-inputs">

                        <x-forms.label label_name="Zip Code" for="residential_zip_code" />
                        <x-forms.input name="residential_zip_code" placeholder="Zip Code" value="{{ $psn_info->residential_address->zip_code }}"/>

                    </div>
                </div>
            </div>
        </div>

        <div>
            <!-- PERMANENT ADDRESS -->
            <div>
                <h6 class="font-semibold">Permanent Address</h6>
            </div>
            <div id="permanent_address_form">
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-forms.label label_name="House/Block/Lot No." for="permanent_house_num" />

                        <x-forms.input name="permanent_house_num" placeholder="House/Block/Lot No." value="{{$psn_info->permanent_address->house_block_no }}"/>
                    </div>
                    <div class="required-inputs">
                        <x-forms.label label_name="Street" for="permanent_street" />

                        <x-forms.input name="permanent_street" placeholder="Street" value="{{$psn_info->permanent_address->street }}"/>
                    </div>
                </div>
                <div class="required-inputs">
                    <x-forms.label label_name="Subdivision/Village" for="permanent_subdivision" />

                    <x-forms.input name="permanent_subdivision" placeholder="Subdivision/Village" value="{{$psn_info->permanent_address->subdivision_village }}"/>
                </div>
                <div class="mt-2 grid gap-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-forms.label label_name="Barangay" for="permanent_barangay" />

                        <x-forms.input name="permanent_barangay" placeholder="Barangay" value="{{$psn_info->permanent_address->barangay }}"/>
                    </div>
                    <div class="required-inputs">
                        <x-forms.label label_name="City" for="permanent_city" />

                        <x-forms.input name="permanent_city" placeholder="City" value="{{$psn_info->permanent_address->city_municipality }}"/>
                    </div>
                </div>
                <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                    <div class="required-inputs">
                        <x-forms.label label_name="Province" for="permanent_province" />

                        <x-forms.input name="permanent_province" placeholder="Province" value="{{$psn_info->permanent_address->province }}"/>

                    </div>
                    <div class="required-inputs">
                        <x-forms.label label_name="Zip Code" for="permanent_zip_code" />

                        <x-forms.input name="permanent_zip_code" placeholder="Zip Code" value="{{$psn_info->permanent_address->zip_code }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PHOTO -->
    <div class="mt-4">
        <x-forms.label label_name="Photo" for="photo" />

        <x-forms.file-input name="photo"/>
    </div>

    <!-- COMMENT -->
    <div class="mt-4">
        <x-forms.label label_name="Comment" for="comment" />
        <textarea id="comment"
                  name="comment"
                  class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500"></textarea>
    </div>
</div>
