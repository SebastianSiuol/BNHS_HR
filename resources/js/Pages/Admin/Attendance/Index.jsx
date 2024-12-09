import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

export default function Index() {
    return (
        <>
            <PageHeaders>Daily Attendance</PageHeaders>
                <HandlePage />
        </>
    );
}

function HandlePage() {
    return (
        <>
          {/* TODO: Separate this into a Header Component */}
            <form id="myForm">
                <div className="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <h1 className="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">Daily Attendance</h1>
                    <div className="grid gap-4 mb-4 sm:grid-cols-4">
                        <div>
                            <label for="department" className="block mb-2 text-sm font-medium text-gray-900 ">
                                Department
                            </label>
                            <select id="department" name="department" className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                                <option selected value={"0"}>
                                    All Departments
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="shift" className="block mb-2 text-sm font-medium text-gray-900 ">
                                Shift{" "}
                            </label>
                            <select id="shift" name="shift" className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                                <option selected value={"0"}>
                                    All Shifts
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="attendance_date" className="block mb-2 text-sm font-medium text-gray-900 ">
                                Date
                            </label>
                            <div className="relative w-full">
                                <div className="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg className="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input
                                    id="attendance_date"
                                    name="attendance_date"
                                    datepicker
                                    datepicker-buttons
                                    datepicker-autoselect-today
                                    placeholder="Select date"
                                    type="text"
                                    className="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5"
                                />
                            </div>
                        </div>

                        <div className="mt-7">
                            <button id="getEmployee" onClick={(e) => {
                                    e.preventDefault;
                                }}
                                className="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            >
                                Get Employee
                            </button>
                        </div>
                    </div>
                </div>
            </form>

          {/* TODO: Separate this into a Tables Component */}
            <div id="attendanceTable" class="bg-white border w-full border-gray-200 rounded-md shadow p-4">
                    <div class="pb-4 flex items-center justify-between">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="table-search" class="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items"/>
                        </div>

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-sm text-white bg-blue-900">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Employee ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Employee Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Attendance By
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Shift
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    In Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Out Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr class="odd:bg-blue-100 even:bg-white border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                      BHNHS-20xx-xxxx
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                      John Doe
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        Admin
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                      Morning
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        9:00
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        18:00
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        Present
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
        </>
    );
}
