<x-admin.layout>


    <x-slot:heading>Department Configuration</x-slot:heading>

    <main class="block p-4 sm:ml-80">
        <x-admin.page_header>
            Department
        </x-admin.page_header>

        <div class="ml-2 bg-white border w-full border-gray-200 rounded-md shadow p-4">


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

                {{-- Add Department Button --}}
                <div class="mt-2 sm:flex">
                    <div class="flex items-center justify-end">
                        <button data-modal-target="add-department" data-modal-toggle="add-department" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Add Department
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
                <table id="default-table"
                       class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-sm text-center text-white bg-blue-900  dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Department Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Designation
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Employees
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($departments as $department)
                        <tr class="text-center odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $department->name  }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @foreach($department->designations as $designation)
                                    {{ $designation->name }} <br>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $department->designations->sum(function($designation) {
                                    return $designation->faculties->count();
                                }) }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center justify-center">
                                    <button data-modal-target="edit-department-{{$department->id}}-modal" data-modal-toggle="edit-department-{{$department->id}}-modal" type="button">
                                        <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                  d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                  clip-rule="evenodd"/>
                                            <path fill-rule="evenodd"
                                                  d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    <button data-modal-target="delete-department-{{$department->id}}-modal" data-modal-toggle="delete-department-{{$department->id}}-modal">
                                        <svg class="w-[27px] h-[27px] text-red-800 dark:text-white" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                  d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

            {{-- Add Department modal --}}
            <x-admin.configuration.department.create />

            @foreach($departments as $department)

                <x-admin.configuration.department.edit :department="$department" />

                <x-admin.configuration.department.destroy :department="$department"/>
            @endforeach

            {{-- Pagination --}}
            {{ $departments->links() }}

        </div>

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
    </main>
    <script src="{{ asset('js/admin/configurations/department-index.js') }}"></script>
</x-admin.layout>
