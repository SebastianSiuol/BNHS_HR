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

{{--            <div class="flex mb-5">--}}
{{--                <p class="text-sm mt-2 mr-3">Show</p>--}}
{{--                <select id="shift" class="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5" required="">--}}
{{--                    <option value="">1</option>--}}
{{--                    <option value="">2</option>--}}
{{--                    <option value="">3</option>--}}
{{--                    <option value="">4</option>--}}
{{--                    <option value="">5</option>--}}
{{--                </select>--}}
{{--                <p class="text-sm mt-2 ml-3">entries</p>--}}
{{--            </div>--}}


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
                                <button data-modal-target="edit-position-modal"
                                        data-modal-toggle="edit-position-modal"
                                        data-position-id="{{ $position->id }}"
                                        data-position-title="{{ $position->title }}"
                                        data-position-level="{{ $position->level }}"
                                        type="button">
                                    <x-icons.edit />
                                </button>
                                <button data-modal-target="delete-position-modal"
                                        data-modal-toggle="delete-position-modal"
                                        data-position-id="{{ $position->id }}"
                                        type="button">
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
            <x-admin.configuration.position.create />

            {{-- Edit Department Details modal --}}
            <x-admin.configuration.position.edit />

            {{-- Delete Popup --}}
            <x-admin.configuration.position.destroy />

            {{-- Pagination --}}
                {{ $school_positions->links() }}
            {{-- Pagination --}}
        </x-admin.nooutline-content-card>

        {{-- Input Error --}}
        @if($errors->any())
            <ul class="my-5">
                @foreach($errors->all() as $error) @endforeach
                <li class="text-red-500 italic font-bold">{{ $error }}</li>
            </ul>
        @endif

        {{-- Feedback Card --}}
        @if( Session::has('success'))

            <x-feedback-card type="success">
                {{ Session::get('success') }}
            </x-feedback-card>

        @elseif( Session::has('error') )

            <x-feedback-card type="error">
                {{ Session::get('error') }}
            </x-feedback-card>

        @endif


    </x-admin.main_container>

    <script src="{{ asset('js/admin/configurations/position/index.js') }}"></script>
</x-admin.layout>
