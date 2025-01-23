import { usePage } from "@inertiajs/react";
import dayjs from "dayjs";

import { ContentContainer } from "@/Components/ContentContainer";
import { capitalizeFirstLetter } from "@/Utils/stringUtils";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { Table, TableRow } from "@/Components/Table";
import Pagination from "@/Components/Pagination";

export default function Index() {
    return (
        <>
            <PageHeaders>Daily Attendance</PageHeaders>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const { faculties, role: userRoles } = usePage().props;


    return (
        <>
            {userRoles.includes('hr_admin') && (<HeaderForm />)}
            <ContentContainer type="noOutline">
                <FacultyTable data={faculties.data} />
                <Pagination data={faculties} />
            </ContentContainer>
        </>
    );
}

function FacultyTable({ data }) {
    function formatDateToTime(date) {
        const dateToTime = dayjs(date).format("hh:mm A");

        return dateToTime;
    }

    // Headers
    const headers = ["Faculty Code", "Faculty Name", "Shift", "Time In", "Time Out", "Status"];

    // Columns Data
    const columns = [
        (faculty) => faculty.faculty_code,
        (faculty) => `${faculty.personal_information.first_name} ${faculty.personal_information.last_name}`,
        (faculty) => capitalizeFirstLetter(faculty.shift.name),
        (faculty) => (faculty.current_attendance?.check_in ? formatDateToTime(faculty.current_attendance.check_in) : "--"),
        (faculty) => (faculty.current_attendance?.check_out ? formatDateToTime(faculty.current_attendance.check_out) : "--"),
        (faculty) => (faculty.current_attendance ? capitalizeFirstLetter(faculty.current_attendance?.status) : "--"),
    ];

    return <Table data={data} headers={headers} renderRow={(faculty) => <TableRow key={faculty.id} data={faculty} columns={columns} />} />;
}

function HeaderForm() {
    const { departments, shifts } = usePage().props;

    return (
        <>
            <form>
                <div className="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <h1 className="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">Daily Attendance</h1>
                    <div className="grid gap-4 mb-4 sm:grid-cols-4">
                        <div>
                            <label htmlFor="department" className="block mb-2 text-sm font-medium text-gray-900 ">
                                Department
                            </label>
                            <select id="department" name="department" defaultValue={0} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                                <option value={"0"}>All Departments</option>
                                {departments.map((department) => (
                                    <option key={department.id} value={department.id}>
                                        {" "}
                                        {department.name}
                                    </option>
                                ))}
                            </select>
                        </div>
                        <div>
                            <label htmlFor="shift" className="block mb-2 text-sm font-medium text-gray-900 ">
                                Shift{" "}
                            </label>
                            <select id="shift" name="shift" defaultValue={0} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                                <option value={"0"}>All Shifts</option>
                                {shifts.map((shift) => (
                                    <option key={shift.id} value={shift.id}>
                                        {" "}
                                        {capitalizeFirstLetter(shift.name)}
                                    </option>
                                ))}
                            </select>
                        </div>
                        <div>
                            <label htmlFor="attendance_date" className="block mb-2 text-sm font-medium text-gray-900 ">
                                Date
                            </label>
                            <div className="relative w-full">
                                <div className="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg className="w-4 h-4 text-blue-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="attendance_date" name="attendance_date" placeholder="Select date" type="text" className="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5" />
                            </div>
                        </div>

                        <div className="mt-7">
                            <button
                                onClick={(e) => {
                                    e.preventDefault();
                                }}
                                className="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            >
                                Get Employee
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </>
    );
}
