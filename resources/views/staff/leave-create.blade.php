<x-staff.layout :with_nav="false">

    <x-staff.content-panel>
        <h3 class="text-blue-800 text-3xl font-bold">Apply for a Leave</h3>
        <x-divider/>

        <div class="px-20 space-y-12">
            <div class="flex space-x-4">
                <div class="flex py-2 px-6 bg-blue-950 items-center rounded-md">
                    <h6 class="text-white font-bold">Service Credit:</h6>
                </div>
                <p class="py-2 px-2 text-lg font-bold">8</p>
            </div>
        </div>

        <form method="POST" action="#">
            @csrf
            <div class="max-w-[75vh] pl-20 py-10 mr-auto space-y-4">
                <div class="grid grid-cols-2 items-center space-x-3">
                    <x-staff.forms.label label="Leave Type*" for="leave"/>
                    <x-staff.forms.select name="leave">
                        <option>Paternal Leave</option>
                        <option>Maternal Leave</option>
                        <option>Vacation Leave</option>
                    </x-staff.forms.select>
                </div>

                <div class="grid grid-cols-2 items-center space-x-3">
                    <x-staff.forms.label label="From*" for="start_leave_date"/>

                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="start_leave_date"
                               name="start_leave_date"
                               placeholder="Select date"
                               value="{{ old('start_leave_date') }}"
                               datepicker
                               datepicker-autohide
                               datepicker-format="mm-dd-yyyy"
                               datepicker-autoselect-today
                               datepicker-min-date="{{date('m-d-Y', strtotime('now')), }}"
                               class="ps-10 p-2.5 bg-gray-50 w-[24rem] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ">
                    </div>
                </div>

                <div class="grid grid-cols-2 items-center space-x-3">
                    <x-staff.forms.label label="To*" for="end_leave_date"/>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-blue-900 " aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="end_leave_date"
                               name="end_leave_date"
                               placeholder="Select date"
                               value="{{ old('end_leave_date') }}"
                               datepicker
                               datepicker-autohide
                               datepicker-format="mm-dd-yyyy"
                               datepicker-autoselect-today
                               datepicker-min-date="{{date('m-d-Y', strtotime('now')), }}"
                               class="ps-10 p-2.5 bg-gray-50 w-[24rem] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ">
                    </div>

                </div>

                <div class="grid grid-cols-2 items-center space-x-3">
                    <x-staff.forms.label label="Reason*" for="leave_reason"/>
                    <textarea name="leave_reason"></textarea>
                </div>

            </div>

            <button>
                Submit
            </button>
        </form>

    </x-staff.content-panel>
</x-staff.layout>
