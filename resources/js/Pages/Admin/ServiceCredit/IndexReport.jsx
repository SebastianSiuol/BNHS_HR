import { IoSearchSharp } from "react-icons/io5";

import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

export default function IndexReport() {
    return (
        <>
            <PageHeaders>Service Credits Records</PageHeaders>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    return (
        <>
            <div className="ml-2 bg-white border w-full border-gray-200 rounded-md shadow p-4">
                <div className="pb-4 flex items-center justify-between dark:bg-gray-900">
                    <label for="table-search" className="sr-only">
                        Search
                    </label>
                    <div className="relative flex mt-1">
                        <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <IoSearchSharp
                                className={
                                    "w-4 h-4 text-gray-500 dark:text-gray-400"
                                } />
                        </div>
                        <input
                            type="text"
                            id="table-search"
                            className="mr-3 block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for items"
                        />

                        <div className="mr-3">
                            <select
                                id="month"
                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5"
                                required=""
                            >
                                <option disable value="0">
                                    Month
                                </option>
                                <option value="january">January</option>
                                <option value="february">February</option>
                                <option value="march">March</option>
                                <option value="april">April</option>
                                <option value="may">May</option>
                                <option value="june">June</option>
                                <option value="july">July</option>
                                <option value="august">August</option>
                                <option value="september">September</option>
                                <option value="october">October</option>
                                <option value="november">November</option>
                                <option value="december">December</option>
                            </select>
                        </div>

                        <div className="flex">
                            <select
                                id="shift"
                                className="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5"
                                required=""
                            >
                                <option disabled selected value="">
                                    Year
                                </option>
                                <option value="">2024</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        id="default-table"
                        className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead className="text-sm text-center text-white bg-blue-900  dark:text-gray-400">
                            <tr>
                                <th scope="col" className="px-6 py-3">
                                    Employee Name
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Employee ID
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Total Service
                                    <br />
                                    Credits Earned
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Total Service
                                    <br />
                                    Credits Used
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Available Service Credits
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr className="text-center odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ryan Basilides
                                </td>
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    0000001
                                </td>
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    9
                                </td>
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    5
                                </td>
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    4
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </>
    );
}
