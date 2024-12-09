import { ContentContainer } from "@/Components/ContentContainer";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

export default function IndexReport() {
    return (
        <>
            <PageHeaders>Atendance Report</PageHeaders>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    return (
        <>
            <Header />
            <Table />
        </>
    );
}

function Header() {
    return (
        <>
            <div id="dailyAttendance-filter" class="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                <h1 class="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">Attendance Report</h1>
                <div class="grid gap-4 mb-4 sm:grid-cols-5">
                    <div>
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Department
                        </label>
                        <select id="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option selected>All Departments</option>
                            <option value="">Department 1</option>
                            <option value="">Department 2</option>
                        </select>
                    </div>
                    <div>
                        <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Shift{" "}
                        </label>
                        <select id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option selected>All Shifts</option>
                            <option value="">Shift 1</option>
                            <option value="">Shift 2</option>
                        </select>
                    </div>
                    <div>
                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Year{" "}
                        </label>
                        <select id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option value="">2024</option>
                        </select>
                    </div>
                    <div>
                        <label for="month" class="block mb-2 text-sm font-medium text-gray-900 ">
                            Month{" "}
                        </label>
                        <select id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option value="">January</option>
                            <option value="">February</option>
                            <option value="">March</option>
                            <option value="">April</option>
                            <option value="">May</option>
                            <option value="">June</option>
                            <option value="">July</option>
                            <option value="">August</option>
                            <option value="">September</option>
                            <option value="">October</option>
                            <option value="">November</option>
                            <option value="">December</option>
                        </select>
                    </div>

                    <div class="mt-7">
                        <button id="showReport" type="button" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                            Show Report
                        </button>
                    </div>
                </div>
            </div>
        </>
    );
}

function Table() {
    return (
        <>
            <ContentContainer type={'noOutline'}>
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
                                    01
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    02
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    03
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    04
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    05
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    06
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    07
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    08
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    09
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    10
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    11
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    12
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    13
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    14
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    15
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    16
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    17
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    18
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    19
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    20
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    22
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    23
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    24
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    25
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    26
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    27
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    28
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    29
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    30
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    31
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd:bg-blue-100 odd:">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">BHNHS-20xx-xxxx</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">John Doe</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </ContentContainer>
        </>
    );
}
