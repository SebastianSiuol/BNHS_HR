import { useEffect, useState } from "react";
import {
    usePage,
    Head,
    router,
    useForm as useInertiaForm,
} from "@inertiajs/react";
import { capitalizeFirstLetter, lowerCaseWord } from "@/Utils/stringUtils";
import { ContentContainer } from "@/Components/ContentContainer";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import Pagination from "@/Components/Pagination";

export default function IndexReport() {
    const { faculties, role: userRoles, queryFilters } = usePage().props;
    const [filters, setFilters] = useState({
        department: queryFilters?.department,
        shift: queryFilters?.shift,
        year: queryFilters?.year,
        month: queryFilters?.month,
    });

    function filterReport(e) {
        e.preventDefault();
        router.get(route("admin.attendances.report.filter"), filters);
    }

    return (
        <>
            <Head title="Attendance Report" />
            <PageHeaders>Attendance Report</PageHeaders>
            {userRoles.includes("hr_admin") && (
                <HeaderForm
                    filters={filters}
                    setFilters={setFilters}
                    onFilter={filterReport}
                />
            )}
            <ContentContainer type="noOutline">
                <Table data={faculties.data} />
                <Pagination data={faculties} />
            </ContentContainer>
        </>
    );
}

function HeaderForm({ filters, setFilters, onFilter }) {
    const { departments, shifts } = usePage().props;

    function handleChange(e) {
        const { name, value } = e.target;

        setFilters((prevFilters) => ({
            ...prevFilters,
            [name]: value,
        }));
    }

    return (
        <div
            id="dailyAttendance-filter"
            className="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
            <h1 className="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                Attendance Report
            </h1>
            <div className="grid gap-4 mb-4 sm:grid-cols-5">
                <div>
                    <label
                        htmlFor="department"
                        className="block mb-2 text-sm font-medium text-gray-900">
                        Department
                    </label>
                    <select
                        id="department"
                        name="department"
                        value={filters.department}
                        onChange={handleChange}
                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="default">All Departments</option>
                        {departments.map((department) => (
                            <option
                                key={department.id}
                                value={department.id}>
                                {department.name}
                            </option>
                        ))}
                    </select>
                </div>
                <div>
                    <label
                        htmlFor="shift"
                        className="block mb-2 text-sm font-medium text-gray-900">
                        Shift
                    </label>
                    <select
                        name="shift"
                        value={filters.shift}
                        onChange={handleChange}
                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="default">All Shifts</option>
                        {shifts.map((shift) => (
                            <option
                                key={shift.id}
                                value={shift.id}>
                                {capitalizeFirstLetter(shift.name)}
                            </option>
                        ))}
                    </select>
                </div>
                <div>
                    <label
                        htmlFor="year"
                        className="block mb-2 text-sm font-medium text-gray-900">
                        Year
                    </label>
                    <select
                        id="year"
                        name="year"
                        value={filters.year}
                        onChange={handleChange}
                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        {/* Add more years as needed */}
                    </select>
                </div>
                <div>
                    <label
                        htmlFor="month"
                        className="block mb-2 text-sm font-medium text-gray-900">
                        Month
                    </label>
                    <select
                        id="month"
                        name="month"
                        value={filters.month}
                        onChange={handleChange}
                        className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div className="mt-7">
                    <button
                        type="button"
                        onClick={onFilter}
                        className="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Show Report
                    </button>
                </div>
            </div>
        </div>
    );
}

function Table({ data }) {
    const { noOfDays } = usePage().props;

    const numberOfHeaders = Array.from(
        { length: noOfDays },
        (_, index) => index + 1
    );

    function getStatusForDay(statuses, day) {
        if (!statuses) return null;

        for (const [date, status] of Object.entries(statuses)) {
            const attendanceDay = new Date(date).getDate();
            if (attendanceDay === day) {
                return status;
            }
        }
        return null;
    }

    function getCellStyle(status) {
        switch (lowerCaseWord(status)) {
            case "present":
                return "bg-green-300 text-center text-black text-lg"; // Green cell with check
            case "absent":
                return "bg-red-400 text-center text-black text-lg"; // Red cell with cross
            case "late":
                return "bg-yellow-300 text-center text-black text-lg"; // Yellow cell with check
            default:
                return "text-center"; // Default empty cell
        }
    }

    function getStatusSymbol(status) {
        switch (lowerCaseWord(status)) {
            case "present":
                return "✓";
            case "absent":
                return "✗";
            case "late":
                return "✓";
            default:
                return "";
        }
    }

    return (
        <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table className="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead className="text-sm text-white bg-blue-900">
                    <tr>
                        <th
                            scope="col"
                            className="px-6 py-3">
                            Faculty Code
                        </th>
                        <th
                            scope="col"
                            className="px-6 py-3">
                            Name
                        </th>
                        {numberOfHeaders.map((day) => (
                            <th
                                className="px-6 py-3 text-center"
                                key={day}>
                                {day}
                            </th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {data.map((faculty) => (
                        <tr
                            className="odd:bg-blue-100"
                            key={faculty.faculty_code}>
                            <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {faculty.faculty_code}
                            </td>
                            <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {`${faculty.personal_information.first_name} ${faculty.personal_information.last_name}`}
                            </td>
                            {numberOfHeaders.map((day) => {
                                const status = getStatusForDay(
                                    faculty.status,
                                    day
                                );
                                return (
                                    <td
                                        key={day}
                                        className={`px-6 py-4 ${getCellStyle(
                                            status
                                        )}`}>
                                        {getStatusSymbol(status)}
                                    </td>
                                );
                            })}
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
