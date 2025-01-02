<div id="add-shift-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add New Shift
                </h3>
            <x-modals.close-button target_modal="add-shift-modal"/>
            </div>

            <!-- Modal body -->
            <form method="POST" action="{{ route('admin.config.shift.store') }}" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <x-forms.label for="name" label_name="Shift Name"/>
                        <x-forms.input name="name" placeholder="Shift Name"/>
                    </div>
                    <div class="col-span-2">

                        <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Start Time:
                        </label>
                        <div class="flex">
                            <input type="time"
                                   id="start_time"
                                   name="start_time"
                                   min="05:00"
                                   max="21:00"
                                   value="05:00"
                                   required
                                   class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5"
                            >
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-s-0 border-gray-300 rounded-e-md">
                                <x-icons.clock/>
                            </span>
                        </div>


                    </div>
                    <div class="col-span-2">
                        <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            End Time:
                        </label>
                        <div class="flex">
                            <input type="time"
                                   id="end_time"
                                   name="end_time"
                                   min="05:00"
                                   max="21:00"
                                   value="21:00"
                                   required
                                   class="rounded-none rounded-s-lg bg-gray-50 border text-gray-900 leading-none focus:ring-blue-500 focus:border-blue-500 block flex-1 w-full text-sm border-gray-300 p-2.5"
                            >
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-s-0 border-gray-300 rounded-e-md">
                                <x-icons.clock />
                            </span>
                        </div>
                    </div>
                    {{--<div class="col-span-2">
                        <label for="endTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Days</label>
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div class="flex items-center me-4">
                                <input id="inline-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Monday</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="inline-2-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-2-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tuesday</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="inline-checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Wednesday</label>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div class="flex items-center me-4">
                                <input id="inline-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Thursday</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="inline-2-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-2-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Friday</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="inline-checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Saturday</label>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div class="flex items-center me-4">
                                <input id="inline-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sunday</label>
                            </div>
                        </div>
                    </div>--}}

                    <div class="col-span-2">
                        <x-forms.label for="shift_description" label_name="Shift Description"/>
                        <textarea id="shift_description"
                                  name="shift_description"
                                  rows="4"block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                  class="" placeholder="Description..." required></textarea>
                    </div>



                <div class="flex items-center justify-end">
                    <button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Save
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{--

<div class="flex mb-5">
    <p class="text-sm mt-2 mr-3">Show</p>
    <select id="shift" class="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5" required="">
        <option value="">1</option>
        <option value="">2</option>
        <option value="">3</option>
        <option value="">4</option>
        <option value="">5</option>
    </select>
    <p class="text-sm mt-2 ml-3">entries</p>
</div>
--}}


