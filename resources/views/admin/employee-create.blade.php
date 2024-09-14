<x-admin-layout :admin="$admin">


<x-slot:heading>Employee Creation</x-slot:heading>

    <!-- Main Content -->
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

            <!-- Personal Details Form -->
            <div id="personalDetails">

                <x-admin-employee-nav-steppers :active_number="1" />

                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Personal Details
                    </h1>

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

                    <div class="flex justify-end">
                        <button id="nextToAccountLogin"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Next Step: Account Login
                        </button>
                    </div>
                </div>
            </div>
            <!-- End of Personal Details Form -->


            <!-- Account Login Form -->
            <div id="accountLogin" class="hidden">

            <x-admin-employee-nav-steppers :active_number="2" />


                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Account Login
                    </h1>

                    <x-employee-create-forms.acc-login />


                    <div class="flex items center justify-between">
                        <button id="prevToPersonalDetails" type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Prev Step: Personal Details
                        </button>
                        <button id="nextToCompanyDetails"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Next Step: Company Details
                        </button>
                    </div>
                </div>
            </div>
            <!-- End of Account Login Form -->


            <!-- START OF COMPANY DETAILS FORM -->
            <div id="companyDetails" class="hidden">

                <x-admin-employee-nav-steppers :active_number="3" />



                <!-- Inputs -->
                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <x-employee-create-forms.company-deets
                        :generated_id="$generated_id"
                        :departments="$departments"
                        :designations="$designations"
                        :shifts="$shifts"
                    />

                    <div class="flex items center justify-between">
                        <button id="prevToAccountLogin" type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Prev Step: Account Login
                        </button>
                        <button id="nextToDocuments"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Next Step: Documents
                        </button>
                    </div>

                </div>
            </div>
            <!-- END OF COMPANY DETAILS FORM -->


            <!-- Documents Form -->
            <div id="documentsForm" class="hidden">

                <x-admin-employee-nav-steppers :active_number="4" />


                <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

                    <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                        Documents
                    </h1>

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="resume_file"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Resume File
                            </label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                name="resume_file"
                                id="file_input"
                                disabled="disabled"
                                type="file">
                        </div>
                        <div>
                            <label for="offer_letter"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Offer Letter</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="offer_letter"
                                   id="file_input"
                                   disabled="disabled"
                                   type="file">
                        </div>
                        <div>
                            <label for="joining_letter"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Joining Letter
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="joining_letter"
                                   id="file_input"
                                   disabled="disabled"
                                   type="file">
                        </div>
                        <div>
                            <label for="contract_and_agreement_file"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Contract & Agreement
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="contract_and_agreement_file"
                                   id="file_input"
                                   disabled="disabled"
                                   type="file">
                        </div>
                        <div>
                            <label for="other_documents" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Other Documents
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                                   name="other_documents"
                                   id="file_input"
                                   disabled="disabled"
                                   type="file">
                        </div>
                        <div>
                            <label for="dropbox-url"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Dropbox URL
                            </label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   name="dropbox_url"
                                   id="emp_id"
                                   type="text"
                                   placeholder="Dropbox URL"
                                    disabled>
                        </div>
                        <div>
                            <label for="gdrive-url"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Google Drive URL
                            </label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   id="emp_id"
                                   name="gdrive-url"
                                   type="text"
                                   placeholder="Google Drive URL"
                                   disabled>
                        </div>
                    </div>

                    <div class="flex items center justify-between">

                        <button id="prevToCompanyDetails" type="button"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Prev Step: Company Details
                        </button>

                        <button type="button"
                                data-modal-target="confirm-create"
                                data-modal-toggle="confirm-create"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Save
                        </button>

                    </div>
                </div>
            </div>
            <!-- End of Documents Form -->

{{--            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">--}}
{{--                Save--}}
{{--            </button>--}}

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
</x-admin-layout>
