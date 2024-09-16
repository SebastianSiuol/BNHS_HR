@props(['faculty'])

<div class="pb-5 pl-5 flex-1">
    <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

        <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-950 text-blue-950 md:text-2xl">
            Personal Details
        </h1>

        <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
            <div class="mt-4">
                <x-admin-show-label for="first_name">First Name</x-admin-show-label>
                <x-admin-show-input name="first_name" id="first_name"
                                    value="{{$faculty->personal_information->first_name}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for="middle_name">Middle Name</x-admin-show-label>
                <x-admin-show-input name="middle_name" id="middle_name"
                                    value="{{$faculty->personal_information->middle_name}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for="last_name">Last Name</x-admin-show-label>
                <x-admin-show-input name="last_name" id="last_name"
                                    value="{{$faculty->personal_information->last_name}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for="name_extension">Extension Name</x-admin-show-label>
                <x-admin-show-input name="name_extension" id="name_extension"
                                    value="{{ ($faculty->personal_information->name_extension == null) ? 'None' : $faculty->personal_information->name_extension->title  }}"/>
            </div>
        </div>
        <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
            <div class="mt-4">
                <x-admin-show-label for="date_of_birth">Date of Birth</x-admin-show-label>
                <x-admin-show-input name="date_of_birth" id="date_of_birth"
                                    value="{{$faculty->personal_information->date_of_birth}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for="date_of_birth">Place of Birth</x-admin-show-label>
                <x-admin-show-input name="date_of_birth" id="date_of_birth"
                                    value="{{$faculty->personal_information->place_of_birth}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for=sex>Sex</x-admin-show-label>
                <x-admin-show-input name=sex id=sex value="{{ $faculty->personal_information->sex }}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for=marital_status>Marital Status</x-admin-show-label>
                <x-admin-show-input name=marital_status id=marital_status
                                    value="{{$faculty->personal_information->civil_status->civil_status}}"/>
            </div>
        </div>

        <div class="grid grid-cols-none lg:grid-cols-4 gap-4">
            <div class="mt-4">
                <x-admin-show-label for="contact_number">Contact Number</x-admin-show-label>
                <x-admin-show-input name="contact_number" id="contact_number"
                                    value="{{$faculty->personal_information->contact_no}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for="telephone_number">Telephone Number</x-admin-show-label>
                <x-admin-show-input name="telephone_number" id="telephone_number"
                                    value="{{$faculty->personal_information->telephone_no == null ? 'None' : $faculty->personal_information->telephone_no}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for=contact_person_name>Contact Person Name</x-admin-show-label>
                <x-admin-show-input name=contact_person_name id=contact_person_name
                                    value="{{$faculty->personal_information->contact_person->name}}"/>
            </div>
            <div class="mt-4">
                <x-admin-show-label for=contact_person_number>Contact Person Number</x-admin-show-label>
                <x-admin-show-input name=contact_person_number id=contact_person_number
                                    value="{{$faculty->personal_information->contact_person->contact_no}}"/>
            </div>
        </div>

        <x-divider />

        <div class="grid grid-cols-none lg:grid-cols-2 gap-4">
            <div>
                <div class="mt-4">
                    <div>
                        <h6 class="font-semibold text-blue-950">Residential Address</h6>
                    </div>
                    <div>
                        <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                            <div>

                                <x-admin-show-label for="residential_house_num">
                                    House/Block/Lot No.
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="residential_house_num"
                                    id="residential_house_num"
                                    value="{{$faculty->personal_information->residential_address->house_block_no}}"/>
                            </div>

                            <div>

                                <x-admin-show-label for="residential_street">
                                    Street
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="residential_street"
                                    id="residential_street"
                                    value="{{$faculty->personal_information->residential_address->street}}"/>

                            </div>
                        </div>
                        <div>

                            <x-admin-show-label for="residential_subdivision">
                                Subdivision/Village
                            </x-admin-show-label>
                            <x-admin-show-input
                                name="residential_subdivision"
                                id="residential_subdivision"
                                value="{{$faculty->personal_information->residential_address->subdivision_village}}"/>


                        </div>
                        <div class="mt-2 grid gap-4 grid-cols-2">
                            <div>

                                <x-admin-show-label for="residential_barangay">
                                    Barangay
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="residential_barangay"
                                    id="residential_barangay"
                                    value="{{$faculty->personal_information->residential_address->barangay}}"/>

                            </div>
                            <div>

                                <x-admin-show-label for="residential_city">
                                    City/Municipality
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="residential_city"
                                    id="residential_city"
                                    value="{{$faculty->personal_information->residential_address->city_municipality}}"/>

                            </div>
                        </div>
                        <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                            <div>

                                <x-admin-show-label for="residential_province">
                                    Province
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="residential_province"
                                    id="residential_province"
                                    value="{{$faculty->personal_information->residential_address->province}}"/>

                            </div>
                            <div>

                                <x-admin-show-label for="residential_zip_code">
                                    Zip Code
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="residential_zip_code"
                                    id="residential_zip_code"
                                    value="{{$faculty->personal_information->residential_address->zip_code}}"/>

                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="font-semibold text-blue-950">Permanent Address</h6>

                    </div>
                    <div>
                        <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                            <div>

                                <x-admin-show-label for="permanent_house_num">
                                    House/Block/Lot No.
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="permanent_house_num"
                                    id="permanent_house_num"
                                    value="{{$faculty->personal_information->permanent_address->house_block_no}}"/>
                            </div>

                            <div>

                                <x-admin-show-label for="permanent_street">
                                    Street
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="permanent_street"
                                    id="permanent_street"
                                    value="{{$faculty->personal_information->permanent_address->street}}"/>

                            </div>
                        </div>
                        <div>

                            <x-admin-show-label for="permanent_subdivision">
                                Subdivision/Village
                            </x-admin-show-label>
                            <x-admin-show-input
                                name="permanent_subdivision"
                                id="permanent_subdivision"
                                value="{{$faculty->personal_information->permanent_address->subdivision_village}}"/>


                        </div>
                        <div class="mt-2 grid gap-4 grid-cols-2">
                            <div>

                                <x-admin-show-label for="permanent_barangay">
                                    Barangay
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="permanent_barangay"
                                    id="permanent_barangay"
                                    value="{{$faculty->personal_information->permanent_address->barangay}}"/>

                            </div>
                            <div>

                                <x-admin-show-label for="permanent_city">
                                    City/Municipality
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="permanent_city"
                                    id="permanent_city"
                                    value="{{$faculty->personal_information->permanent_address->city_municipality}}"/>

                            </div>
                        </div>
                        <div class="mt-2 grid gap-4 mb-4 grid-cols-2">
                            <div>

                                <x-admin-show-label for="permanent_province">
                                    Province
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="permanent_province"
                                    id="permanent_province"
                                    value="{{$faculty->personal_information->permanent_address->province}}"/>

                            </div>
                            <div>

                                <x-admin-show-label for="permanent_zip_code">
                                    Zip Code
                                </x-admin-show-label>
                                <x-admin-show-input
                                    name="permanent_zip_code"
                                    id="permanent_zip_code"
                                    value="{{$faculty->personal_information->permanent_address->zip_code}}"/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="mt-4">
                    <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 ">Photo</label>
                    <img class="rounded-full w-40 h-40" src="emp-photo.jpg" alt="image description">
                </div>
                <div class="mt-4">
                    <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 ">Comment</label>
                    <textarea disabled type="text" id="comment"
                              class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500     "></textarea>
                </div>
            </div>
        </div>


    </div>

</div>
