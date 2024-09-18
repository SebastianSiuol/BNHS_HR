<x-staff.layout :with_nav="false">

    <x-staff.content-panel>
        <h3 class="text-blue-800 text-3xl font-bold">Apply for a Leave</h3>
        <x-divider/>

        <div class="px-20 space-y-12">
            <div class="flex space-x-4">
                <div class="flex py-2 px-6 bg-[#233876] items-center rounded-md">
                    <h6 class="text-white font-bold">Service Credit:</h6>
                </div>
                <p class="py-2 px-2 text-lg font-bold">8</p>
            </div>
        </div>

        <form method="POST" action="{{ route('staff_leave_store') }}">
            @csrf

            <div class=" flex flex-col gap-y-6 max-w-[75vh] pl-20 py-10 mr-auto">
                <div class="grid grid-cols-2 items-center gap-x-3">
                    <x-staff.forms.label label="Leave Type*" for="leave_type"/>
                    <x-staff.forms.select name="leave_type">
                        <option {{ empty(old('leave_type'))  ? 'selected=selected': '' }}  disabled value='0'>Select Leave</option>
                    @foreach($leave_types as $leave_type)
                        <option
                            value="{{ $leave_type->id }}" {{old ('leave_type') == $leave_type->id ? 'selected=selected' : ''}}>{{$leave_type->name}}</option>
                    @endforeach
                    </x-staff.forms.select>
                </div>

                <div class="grid grid-cols-2 items-center gap-x-3">
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

                <div class="grid grid-cols-2 items-center gap-x-3">
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

                <div class="grid grid-cols-2 items-center gap-x-3">
                    <x-staff.forms.label label="Reason*" for="leave_reason"/>
                    <textarea name="leave_reason" value="{{ old('leave_reason') }}"></textarea>
                </div>

                <button type="submit" class="bg-blue-700 p-2 text-white rounded-lg hover:bg-blue-900">
                    Submit
                </button>

                @if($errors->any())
                    <ul class="my-5">
                        @foreach($errors->all() as $error) @endforeach
                        <li class="text-red-500 italic font-bold">{{ $error }}</li>
                    </ul>
                @endif

            </div>

        </form>

    </x-staff.content-panel>
</x-staff.layout>
