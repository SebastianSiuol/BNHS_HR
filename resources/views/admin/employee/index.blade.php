<x-admin.layout>


<x-slot:heading>Employee List</x-slot:heading>

    {{-- Main Content --}}
    <x-admin.main_container>

        <x-admin.page-header>
            Manage Employees
        </x-admin.page-header>

        <div class="ml-2 bg-white border w-full border-gray-200 rounded-md shadow p-4">

            {{-- HEADER --}}
            <div class="pb-4 flex items-center justify-between">

                {{-- SEARCH --}}
                <form id="employee_search"
                      method='GET'
                      action="{{ route('admin_employees_search') }}"
                      class="relative mt-1 grid grid-cols-1 sm:grid-cols-2">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input  id="search"
                            name="query"
                            type="text"
                           class="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
                    <button type="submit"
                            class="w-32 ml-4 px-4 py-2.5 text-white text-sm text-center font-medium bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                        Search
                    </button>
                </form>
                {{-- END OF SEARCH --}}

                <div class="mt-2 sm:flex">
                    <button type="button" class="text-white flex items-center justify-between bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 focus:outline-none">
                        <svg class="w-5 h-5 mr-1 text-gray-200 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                        </svg>
                        Export</button>
                    <button type="button" class="focus:outline-none flex items-center justify-between text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2">
                        <svg class="w-6 h-6 mr-1 text-gray-200 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        Import</button>
                </div>
            </div>



            {{-- START OF TABLE --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-sm text-white bg-blue-900 text-center">
                    <tr>
                        <th class="px-6 py-3">
                            Employee ID
                        </th>
                        <th class="px-6 py-3">
                            Name
                        </th>
                        <th class="px-6 py-3">
                            Email
                        </th>
                        <th class="px-6 py-3">
                            Department
                        </th>
                        <th class="px-6 py-3">
                            Shift
                        </th>
                        <th class="px-6 py-3">
                            Status
                        </th>
                        <th class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>

                    <tbody>

                    {{-- START OF ROWS --}}
                    @foreach($faculties as $faculty)
                        <x-table.data-row>

                            <x-table.data>
                                {{ $faculty->faculty_code }}
                            </x-table.data>
                            <x-table.data>
                                {{ $faculty->personal_information->generateFullName() }}
                            </x-table.data>
                            <x-table.data>
                                {{ $faculty->email }}
                            </x-table.data>
                            <x-table.data>
                                {{ $faculty->designation->department->name }}
                            </x-table.data>
                            <x-table.data>
                                {{ ucfirst($faculty->shift->name) }}
                            </x-table.data>
                            <x-table.data>
                                {{ ucfirst($faculty->employment_status->name) }}
                            </x-table.data>
                            <x-table.data>
                                <div class="flex items-center justify-end">
                                    <button data-modal-target="view-modal-{{$faculty->id}}"
                                            data-modal-toggle="view-modal-{{$faculty->id}}" type="button">
                                        <x-icons.view />
                                    </button>

                                    <a href="/admin/employees/{{$faculty->id}}/edit">
                                        <x-icons.edit />
                                    </a>

                                    <button data-modal-target="delete-employee-{{$faculty->id}}-modal"
                                            data-modal-toggle="delete-employee-{{$faculty->id}}-modal">
                                        <x-icons.delete />
                                    </button>
                                </div>
                            </x-table.data>
                        </x-table.data-row>
                    @endforeach
                    {{-- END OF ROW --}}

                    </tbody>
                </table>

            </div>
            {{-- END OF TABLE --}}

            {{-- Pagination --}}
            {{ $faculties->links()  }}
            {{-- End of Pagination --}}
        </div>


        @foreach($faculties as $faculty)
            {{-- START OF DELETE MODAL--}}
            <form method="POST" action="/admin/employees/{{ $faculty->id }}/delete">
                @method('DELETE')
                @csrf
                <div id="delete-employee-{{$faculty->id}}-modal" tabindex="-1"
                     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow ">
                            <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center  "
                                    data-modal-hide="delete-employee-{{$faculty->id}}-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 ">Are you sure you
                                    want to delete this employee? This Action is Irreversible!</h3>
                                <button data-modal-hide="delete-employee-{{$faculty->id}}-modal"
                                        type="submit"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yes, I'm sure
                                </button>
                                <button data-modal-hide="delete-employee-{{$faculty->id}}-modal"
                                        type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100      ">
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
        {{-- END OF DELETE MODAL--}}


        {{-- View Modal --}}
        @foreach($faculties as $faculty)
            <x-modals.employee-show :faculty="$faculty"/>
        @endforeach

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



{{--    <script src={{asset('js/admin.js')}}></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>--}}

</x-admin.layout>

