@props(['faculty'])

<div id="view-modal-{{$faculty->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-fit max-h-full">
        <!-- Modal content -->
        <div class="relative bg-gray-100 items-center justify-center rounded-lg shadow ">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    View Details
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center  " data-modal-toggle="view-modal-{{$faculty->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="sm:flex mt-5 mr-5">
                <!-- Personal details form -->
                <div id="personalDetails" class="pb-5 pl-5">
                    <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                        <form id="PersonalDetailsForm" action="#">

                            <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-950 text-blue-950 md:text-2xl">
                                Personal Details
                            </h1>
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <div class="mt-4">
                                        <x-admin-show-label for="first_name">First Name</x-admin-show-label>
                                        <x-admin-show-input name="first_name" id="first_name" value="{{$faculty->personal_information->first_name}}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for="middle_name">Middle Name</x-admin-show-label>
                                        <x-admin-show-input name="middle_name" id="middle_name" value="{{$faculty->personal_information->middle_name}}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for="last_name">Last Name</x-admin-show-label>
                                        <x-admin-show-input name="last_name" id="last_name" value="{{$faculty->personal_information->last_name}}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for="name_extension">Extension Name</x-admin-show-label>
                                        <x-admin-show-input name="name_extension" id="name_extension" value="{{ ($faculty->personal_information->name_extension == null) ? 'None' : $faculty->personal_information->name_extension->title  }}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for="date_of_birth">Date of Birth</x-admin-show-label>
                                        <x-admin-show-input name="date_of_birth" id="date_of_birth" value="{{$faculty->personal_information->date_of_birth}}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for="date_of_birth">Place of Birth</x-admin-show-label>
                                        <x-admin-show-input name="date_of_birth" id="date_of_birth" value="{{$faculty->personal_information->place_of_birth}}" />
                                    </div>
                                    <div>
                                        <div class="mt-4">
                                            <x-admin-show-label for="contact_number">Contact Number</x-admin-show-label>
                                            <x-admin-show-input name="contact_number" id="contact_number" value="{{$faculty->personal_information->contact_no}}" />
                                        </div>
                                        <div class="mt-4">
                                            <x-admin-show-label for="telephone_number">Telephone Number</x-admin-show-label>
                                            <x-admin-show-input name="telephone_number" id="telephone_number" value="{{$faculty->personal_information->telephone_no == null ? 'None' : $faculty->personal_information->telephone_no}}" />
                                        </div>
                                        <div class="mt-4">
                                            <x-admin-show-label for="reference_name_01">Reference 01 Name</x-admin-show-label>
                                            <x-admin-show-input name="reference_name_01" id="reference_name_01" value="{{$faculty->personal_information->getFirstRefMember[0]['name']}}" />
                                        </div>
                                        <div class="mt-4">
                                            <x-admin-show-label for="reference_number_01">Reference 01 Number</x-admin-show-label>
                                            <x-admin-show-input name="reference_number_01" id="reference_number_01" value="{{$faculty->personal_information->getFirstRefMember[0]['contact_number']}}" />
                                        </div>
                                        <div class="mt-4">
                                            <x-admin-show-label for="reference_name_02">Reference 02 Name</x-admin-show-label>
                                            <x-admin-show-input name="reference_name_02" id="reference_name_02" value="{{$faculty->personal_information->getSecondRefMember->isEmpty() ? 'None': $faculty->personal_information->getSecondRefMember[0]['name'] }}" />
                                        </div>
                                        <div class="mt-4">
                                            <x-admin-show-label for="reference_number_02">Reference 02 Number</x-admin-show-label>
                                            <x-admin-show-input name="reference_number_02" id="reference_number_02" value="{{$faculty->personal_information->getSecondRefMember->isEmpty() ? 'None': $faculty->personal_information->getSecondRefMember[0]['contact_number'] }}" />
                                        </div>
                                        <div class="mt-4">
                                            <x-admin-show-label for=marital_status>Marital Status</x-admin-show-label>
                                            <x-admin-show-input name=marital_status id=marital_status value="{{$faculty->personal_information->civil_status->civil_status}}" />
                                        </div>
                                        <div class="mt-4">
                                            <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 ">Photo</label>
                                            <img class="rounded-full w-40 h-40" src="emp-photo.jpg" alt="image description">
                                        </div>
                                        <div class="mt-4">
                                            <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 ">Comment</label>
                                            <textarea disabled type="text" id="comment" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500     "></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="mt-4">
                                        <x-admin-show-label for=contact_person_name>Contact Person Name</x-admin-show-label>
                                        <x-admin-show-input name=contact_person_name id=contact_person_name value="{{$faculty->personal_information->contact_person->name}}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for=contact_person_number>Contact Person Number</x-admin-show-label>
                                        <x-admin-show-input name=contact_person_number id=contact_person_number value="{{$faculty->personal_information->contact_person->contact_no}}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for=sex>Sex</x-admin-show-label>
                                        <x-admin-show-input name=sex id=sex value="{{ $faculty->personal_information->sex }}" />
                                    </div>
                                    <div class="mt-4">
                                        <x-admin-show-label for=nationality>Nationality</x-admin-show-label>
                                        <x-admin-show-input name=nationality id=nationality value="Filipino" />
                                    </div>
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
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Other forms -->
{{--                <div class="block sm:ml-5">--}}
{{--                    <!-- Account Login -->--}}
{{--                    <div id="formss" class="mb-5 rounded-lg shadow md:mt-0 xl:p-0  ">--}}
{{--                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">--}}
{{--                            <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight text-gray-900 md:text-2xl ">--}}
{{--                                Account Login--}}
{{--                            </h1>--}}
{{--                            <form class="space-y-4 md:space-y-6">--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=email>Email*</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=email id=email value="{{$faculty->email}}" />--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- Company Details -->--}}
{{--                    <div id="formss" class="w-screen mb-5 rounded-lg shadow  md:mt-0 xl:p-0  ">--}}
{{--                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">--}}
{{--                            <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight text-gray-900 md:text-2xl ">--}}
{{--                                Company Details--}}
{{--                            </h1>--}}
{{--                            <form class="space-y-4 md:space-y-6" action="#">--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=employee_code>Employee ID</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=employee_code id=employee_code value="{{$faculty->faculty_code}}" />--}}
{{--                                </div>--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=department>Department</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=department id=department value="{{$faculty->department->department_name}}" />--}}
{{--                                </div>--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=designation>Designation</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=designation id=designation value="{{$faculty->designation->department_designation}}" />--}}
{{--                                </div>--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=date_of_joining>Date of Joining</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=date_of_joining id=date_of_joining value="{{$faculty->date_of_joining}}" />--}}
{{--                                </div>--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=date_of_leaving>Date of Leaving</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=date_of_leaving id=date_of_leaving value="{{$faculty->date_of_leaving}}" />--}}
{{--                                </div>--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=Manager>Manager/Department Head</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=Manager id=Manager placeholder="No Head" />--}}
{{--                                </div>--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <x-admin-show-label for=shift>Shift</x-admin-show-label>--}}
{{--                                    <x-admin-show-input name=shift id=shift value="{{$faculty->shift->time}}" />--}}
{{--                                </div>--}}
{{--                                <div class="grid grid-cols-2">--}}
{{--                                    <label for="Status" class="block mr-12 mb-2 text-sm font-medium text-gray-900 ">Status</label>--}}
{{--                                    <form class="max-w-sm mx-auto">--}}
{{--                                        <select disabled id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">--}}
{{--                                            <option selected>Active</option>--}}
{{--                                            <option value="">Option 2</option>--}}
{{--                                            <option value="">Option 3</option>--}}
{{--                                        </select>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!-- Personal Data Sheet File -->--}}
{{--                    <div class="flex items-start">--}}

{{--                        <div class="flex flex-col w-fit leading-1.5 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl ">--}}
{{--                            <div class="flex items-start bg-gray-50  rounded-xl p-2">--}}
{{--                                <div class="me-2">--}}
{{--                                            <span class="flex items-center gap-2 text-sm font-medium text-gray-900  pb-2">--}}
{{--                                            <svg fill="none" aria-hidden="true" class="w-5 h-5 flex-shrink-0" viewBox="0 0 20 21">--}}
{{--                                                <g clip-path="url(#clip0_3173_1381)">--}}
{{--                                                    <path fill="#E2E5E7" d="M5.024.5c-.688 0-1.25.563-1.25 1.25v17.5c0 .688.562 1.25 1.25 1.25h12.5c.687 0 1.25-.563 1.25-1.25V5.5l-5-5h-8.75z"/>--}}
{{--                                                    <path fill="#B0B7BD" d="M15.024 5.5h3.75l-5-5v3.75c0 .688.562 1.25 1.25 1.25z"/>--}}
{{--                                                    <path fill="#CAD1D8" d="M18.774 9.25l-3.75-3.75h3.75v3.75z"/>--}}
{{--                                                    <path fill="#F15642" d="M16.274 16.75a.627.627 0 01-.625.625H1.899a.627.627 0 01-.625-.625V10.5c0-.344.281-.625.625-.625h13.75c.344 0 .625.281.625.625v6.25z"/>--}}
{{--                                                    <path fill="#fff" d="M3.998 12.342c0-.165.13-.345.34-.345h1.154c.65 0 1.235.435 1.235 1.269 0 .79-.585 1.23-1.235 1.23h-.834v.66c0 .22-.14.344-.32.344a.337.337 0 01-.34-.344v-2.814zm.66.284v1.245h.834c.335 0 .6-.295.6-.605 0-.35-.265-.64-.6-.64h-.834zM7.706 15.5c-.165 0-.345-.09-.345-.31v-2.838c0-.18.18-.31.345-.31H8.85c2.284 0 2.234 3.458.045 3.458h-1.19zm.315-2.848v2.239h.83c1.349 0 1.409-2.24 0-2.24h-.83zM11.894 13.486h1.274c.18 0 .36.18.36.355 0 .165-.18.3-.36.3h-1.274v1.049c0 .175-.124.31-.3.31-.22 0-.354-.135-.354-.31v-2.839c0-.18.135-.31.355-.31h1.754c.22 0 .35.13.35.31 0 .16-.13.34-.35.34h-1.455v.795z"/>--}}
{{--                                                    <path fill="#CAD1D8" d="M15.649 17.375H3.774V18h11.875a.627.627 0 00.625-.625v-.625a.627.627 0 01-.625.625z"/>--}}
{{--                                                </g>--}}
{{--                                                <defs>--}}
{{--                                                    <clipPath id="clip0_3173_1381">--}}
{{--                                                        <path fill="#fff" d="M0 0h20v20H0z" transform="translate(0 .5)"/>--}}
{{--                                                    </clipPath>--}}
{{--                                                </defs>--}}
{{--                                            </svg>--}}
{{--                                            Personal Data Sheet--}}
{{--                                            </span>--}}

{{--                                </div>--}}
{{--                                <div class="inline-flex self-center items-center">--}}
{{--                                    <button class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none  focus:ring-gray-50   " type="button">--}}
{{--                                        <svg class="w-4 h-4 text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                                            <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>--}}
{{--                                            <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>--}}
{{--                                        </svg>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
