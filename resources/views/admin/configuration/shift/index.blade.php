<x-admin.layout>

    <x-slot:heading>Shifts</x-slot:heading>

    <x-admin.main_container>

        <x-admin.page_header>
            Shifts
        </x-admin.page_header>

        <div class="ml-2 bg-white border w-full border-gray-200 rounded-md shadow p-4">

            {{-- START OF SHIFT SEARCH --}}
            <div class="pb-4 flex items-center justify-between dark:bg-gray-900">

                <form method="GET" action="{{ route('admin.config.shift.search') }}">
                    <label for="query" class="sr-only">Search</label>

                    <div class="relative mt-1">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <x-icons.search/>
                        </div>
                        <input type="text"
                               name="query"
                               id="query"
                               class="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Search for items">
                    </div>
                </form>
                {{-- END OF SHIFT SEARCH --}}


                <div class="mt-2 sm:flex">
                    <div class="flex items-center justify-end">
                        <button data-modal-target="add-shift-modal" data-modal-toggle="add-shift-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Add Shift
                        </button>
                    </div>
                </div>

            </div>


            {{-- TABLE --}}
            @if(!$shifts->isEmpty())

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-sm text-white bg-blue-900">
                    <tr>
                        <th class="px-6 py-3">
                            Shift Name
                        </th>
                        <th class="px-6 py-3">
                            From Time
                        </th>
                        <th class="px-6 py-3">
                            To Time
                        </th>
                        <th class="px-6 py-3">
                            Weekdays
                        </th>
                        <th class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>



                        @foreach($shifts as $shift)

                            <x-table.row>
                                <x-table.data>
                                    {{ ucfirst($shift->name) }}
                                </x-table.data>
                                <x-table.data>
                                    {{ date('h:i a', strtotime($shift->from)) }}
                                </x-table.data>
                                <x-table.data>
                                    {{ date('h:i a', strtotime($shift->to)) }}
                                </x-table.data>
                                <x-table.data>
                                    {{ ($shift->days) ?? "No Days Set" }}
                                </x-table.data>
                                <x-table.data class="flex">
                                    <div class="flex items-center justify-center">
                                        <button data-modal-target="edit-shift-modal"
                                                data-modal-toggle="edit-shift-modal"
                                                data-shift-id="{{$shift->id}}"
                                                data-shift-name="{{$shift->name}}"
                                                data-from-time="{{ $shift->from}}"
                                                data-to-time="{{$shift->to}}"
                                                type="button">
                                            <x-icons.edit/>
                                        </button>
                                        <button data-modal-target="delete-shift-{{$shift->id}}-modal"
                                                data-modal-toggle="delete-shift-{{$shift->id}}-modal"
                                                type="button">
                                            <x-icons.delete/>
                                        </button>
                                    </div>
                                </x-table.data>
                            </x-table.row>

                        @endforeach



                    </tbody>
                </table>
            </div>
            @elseif($shifts->isEmpty())
                <p class="text-center font-bold text-2xl text-blue-900">
                    No Shifts Found!
                </p>
            @endif


           {{-- Add Shift modal --}}
            <x-admin.configuration.shift.create />

            {{-- Edit Shift Details modal --}}
            <x-admin.configuration.shift.edit />

            @foreach($shifts as $shift)
                <x-admin.configuration.shift.destroy :shift="$shift"/>
            @endforeach

            {{-- Start of Pagination --}}
            {{ $shifts->links() }}
            {{-- End of Pagination --}}

            {{-- Input Error --}}
            @if($errors->any())
                <ul class="my-5">
                    @foreach($errors->all() as $error)
                        <li class="text-red-500 italic font-bold">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- Feedback Card --}}
            @if( Session::has('success'))

                <x-feedback_card type="success">
                    {{ Session::get('success') }}
                </x-feedback_card>

            @elseif( Session::has('error') )

                <x-feedback_card type="error">
                    {{ Session::get('error') }}
                </x-feedback_card>

            @endif

        </div>
    </x-admin.main_container>


    <script src="{{ asset('js/admin/configurations/shift/index.js') }}"></script>
</x-admin.layout>
