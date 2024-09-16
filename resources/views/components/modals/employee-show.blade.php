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
            <div class="lg:flex mt-5 mr-5">

                <!-- Personal details form -->
                <x-employee-show-forms.psn-deets :faculty="$faculty" />

                <div class="block ml-4 space-y-4">
                    <!-- Account Login -->
                    <x-employee-show-forms.acc-login :faculty="$faculty"/>

                    <!-- Company Details -->
                    <x-employee-show-forms.company-deets :faculty="$faculty"/>

{{--                    <!-- Personal Data Sheet File -->--}}
{{--                    <x-employee-show-forms.pds-file />--}}

                </div>


            </div>
        </div>
    </div>
</div>
