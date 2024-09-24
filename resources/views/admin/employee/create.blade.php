<x-admin-layout :admin="$admin">


<x-slot:heading>Employee Creation</x-slot:heading>

    {{-- Main Content --}}
    <main class="block h-full p-4 sm:ml-80">


        <div class="flex items-center pb-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                 stroke="currentColor" class="w-9 h-9 text-blue-900">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
            </svg>
            <h1 class="text-3xl text-blue-900 font-bold ml-2">Add Employee</h1>
        </div>

        <form method="POST" action="/admin/employees">
            @csrf

            {{-- Start of Personal Details Form --}}
            <div id="personalDetails" class="hidden">

                <x-admin-employee-nav-steppers :active_number="1" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <x-forms.form-heading>Personal Details</x-forms.form-heading>

                    @if($errors->any())
                        <ul class="my-5">
                            @foreach($errors->all() as $error) @endforeach
                            <li class="text-red-500 italic font-bold">{{ $error }}</li>
                        </ul>
                    @endif

                    <x-employee-create-forms.psn-deets
                        :max_date='$max_date'
                        :civil_statuses='$civil_statuses'
                        :name_exts='$name_exts' />

                    {{-- Buttons --}}
                    <div class="flex justify-end">
                        <x-forms.nav-button id="nextToAccountLogin">
                            Next Step: Account Login
                        </x-forms.nav-button>
                    </div>

                </div>
            </div>
            {{-- End of Personal Details Form --}}

            {{-- Start of Account Login Form --}}
            <div id="accountLogin" class="hidden">

            <x-admin-employee-nav-steppers :active_number="2" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <x-forms.form-heading>Account Login</x-forms.form-heading>

                    <x-employee-create-forms.acc-login />

                    {{-- Buttons --}}
                    <div class="flex items center justify-between">
                        <x-forms.nav-button id="prevToPersonalDetails" nav_type="previous">
                            Prev Step: Personal Details
                        </x-forms.nav-button>
                        <x-forms.nav-button id="nextToCompanyDetails">
                            Next Step: Company Details
                        </x-forms.nav-button>
                    </div>

                </div>
            </div>
            {{-- End of Account Login Form --}}


            {{-- Start of Company Details Form --}}
            <div id="companyDetails" class="block">

                <x-admin-employee-nav-steppers :active_number="3" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <x-forms.form-heading>Company Details</x-forms.form-heading>
                    <x-employee-create-forms.company-deets
                        :generated_id="$generated_id"
                        :departments="$departments"
                        :designations="$designations"
                        :shifts="$shifts"
                        :roles="$roles"/>

                    {{-- Buttons --}}
                    <div class="flex items center justify-between">
                        <x-forms.nav-button id="prevToAccountLogin" nav_type="previous">
                            Prev Step: Account Login
                        </x-forms.nav-button>
                        <x-forms.nav-button id="nextToDocuments">
                            Next Step: Documents
                        </x-forms.nav-button>
                    </div>

                </div>
            </div>
            {{-- End of Company Details Form--}}


            {{-- Start of Documents Form --}}
            <div id="documentsForm" class="hidden">

                <x-admin-employee-nav-steppers :active_number="4" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <x-forms.form-heading>Documents</x-forms.form-heading>
                    <x-employee-create-forms.doc-deets />

                    {{-- Buttons --}}
                    <div class="flex items center justify-between">
                        <x-forms.nav-button id="prevToCompanyDetails" nav_type="previous">
                            Prev Step: Company Details
                        </x-forms.nav-button>
                        <button type="button"
                                data-modal-target="confirm-create"
                                data-modal-toggle="confirm-create"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Save
                        </button>
                    </div>

                </div>
            </div>
            {{-- End of Documents Form --}}

            {{--<button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Save
            </button>--}}

            <div id="confirm-create" tabindex="-1"
                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="confirm-create">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                Confirm employee creation?
                            </h3>
                            <button data-modal-hide="confirm-create"
                                    type="submit"
                                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                            <button data-modal-hide="confirm-create"
                                    type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                No, cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </main>

    <script src={{asset('js/admin.js')}}></script>
    <script src={{asset('js/validate-create-forms.js')}}></script>
    <script src={{asset('js/employee/create-designation.js')}}></script>
</x-admin-layout>
