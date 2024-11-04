<x-admin.layout>

    <x-slot:heading>Positions</x-slot:heading>


    <x-admin.main_container>
        <x-admin.page-header>
            Position
        </x-admin.page-header>

        <x-admin.nooutline-content-card>

            <div class="pb-4 flex items-center justify-between dark:bg-gray-900">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
                <div class="mt-2 sm:flex">
                    <div class="flex items-center justify-end">
                        <button data-modal-target="add-position-modal" data-modal-toggle="add-position-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Add Position
                        </button>
                    </div>
                </div>
            </div>

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


            {{-- TABLE --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <x-table.head>
                    <tr>
                        <x-table.header>
                            Position Title
                        </x-table.header>
                        <x-table.header>
                            Position Level
                        </x-table.header>
                        <x-table.header>
                            Total Employees
                        </x-table.header>
                        <x-table.header>
                            Action
                        </x-table.header>
                    </tr>
                    </x-table.head>
                    <tbody>
                    @foreach($school_positions as $position)
                    <x-table.data-row>
                        <x-table.data>
                            {{ $position->title }}
                        </x-table.data>
                        <x-table.data>
                            {{ $position->positionLevel() }}
                        </x-table.data>
                        <x-table.data>
                            {{ $position->faculties->count() }}
                        </x-table.data>
                        <x-table.data>
                            <div class="flex items-center justify-center">
                                <button data-modal-target="edit-modal" data-modal-toggle="edit-modal" type="button">
                                    <x-icons.edit />
                                </button>
                                <button type="button">
                                    <x-icons.delete />
                                </button>
                            </div>
                        </x-table.data>
                    </x-table.data-row>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {{-- Add Position modal --}}
            <x-admin.configuration.position.add-modal />

            {{-- Edit Department Details modal --}}
{{--            <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">--}}
{{--                <div class="relative p-4 w-full max-w-md max-h-full">--}}
{{--                    {{-- Modal content --}}
{{--                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">--}}
{{--                        {{-- Modal header --}}
{{--                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">--}}
{{--                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">--}}
{{--                                Edit Position Details--}}
{{--                            </h3>--}}
{{--                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal">--}}
{{--                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">--}}
{{--                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>--}}
{{--                                </svg>--}}
{{--                                <span class="sr-only">Close modal</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        {{-- Modal body --}}
{{--                        <form class="p-4 md:p-5">--}}
{{--                            <div class="grid gap-4 mb-4 grid-cols-2">--}}
{{--                                <div class="col-span-2">--}}
{{--                                    <label for="ID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID</label>--}}
{{--                                    <input type="text" disabled name="ID" id="ID" class="bg-blue-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Auto Generated">--}}
{{--                                </div>--}}
{{--                                <div class="col-span-2">--}}
{{--                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position Title</label>--}}
{{--                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Position Title" required="">--}}
{{--                                </div>--}}
{{--                                <div class="col-span-2">--}}
{{--                                    <label for="joining-letter" class="block mr-8 mb-2 text-sm font-medium text-gray-900 ">Position Level</label>--}}
{{--                                    <select id="extension" class="select-validate bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     ">--}}
{{--                                        <option selected disabled value="">Position Level</option>--}}
{{--                                        <option value="male">Entry Level</option>--}}
{{--                                        <option value="female">Mid Level</option>--}}
{{--                                        <option value="female">Senior Level</option>--}}
{{--                                        <option value="female">Leadership</option>--}}
{{--                                        <option value="female">Support Staff</option>--}}
{{--                                        <option value="female">IT Staff</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}

{{--                                <div class="col-span-2">--}}
{{--                                    <label for="totalEmp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Employees</label>--}}
{{--                                    <input type="number" pattern="\d+" name="totalEmp" id="totalEmp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Total Employees" required="">--}}
{{--                                </div>--}}

{{--                            </div>--}}


{{--                            <div class="flex items-center justify-end">--}}
{{--                                <button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">--}}
{{--                                    Save--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            {{-- Pagination --}}
                {{ $school_positions->links() }}
            {{-- Pagination --}}
        </x-admin.nooutline-content-card>


        @if($errors->any())
            <ul class="my-5">
                @foreach($errors->all() as $error) @endforeach
                <li class="text-red-500 italic font-bold">{{ $error }}</li>
            </ul>
        @endif

        @if( Session::has('success'))
            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="session-alert relative bg-green-500 float-right text-white rounded-lg p-2 m-2"
            >
                {{ Session::get('success') }}
            </div>
        @elseif( Session::has('error') )

            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="session-alert relative bg-red-500 float-right text-white rounded-lg p-2 m-2"
            >
                {{ Session::get('error') }}
            </div>
        @endif


    </x-admin.main_container>
</x-admin.layout>
