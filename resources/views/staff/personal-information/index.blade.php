<x-staff.layout :with_nav='false'>
    <section id="empDisplay" class="bg-white shadow-md rounded-lg p-6 py-8">
        <section class=" p-6">
            <h2 class="text-lg font-semibold  "> Employee Name:     <span class="font-medium ml-3">{{ $auth->personal_information->generateFullName() }}</span> </h2>
            <h2 class="text-lg font-semibold"> Employee ID: <span class="font-medium ml-3">{{ $auth->faculty_code }}</span></h2>
        </section>

        <section class="p-6 pt-0">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="w-full block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Personal Data Sheet Form
            </button>
        </section>

    </section>

    {{-- Main modal --}}
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            {{-- Modal content --}}
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                {{-- Modal body --}}
                <div class="p-4 md:p-5">
                    <div class="justify-center flex text-center pt-10">
                        <h2 class="text-xl">CS Form No. 212<br>
                            Revised 2017<br>
                            PERSONAL DATA SHEET</h2>
                    </div>

                    <div class="w-full mt-5 p-4">
                        <p> <span class="text-red-700 text-lg font-semibold">WARNING:</span> Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.</p>
                        <p class="mt-5">  READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.</p>
                        <p class="mt-5"> Print legibly. Tick appropriate boxes and use separate sheet if necessary. Indicate N/A if not applicable.  DO NOT ABBREVIATE.</p>
                    </div>
                    <div class="flex items-center justify-between p-3">

                        <button type="button" data-modal-toggle="crud-modal"  class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Cancel
                        </button>

                        <a href="PDS_Form.html" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-staff.layout>
