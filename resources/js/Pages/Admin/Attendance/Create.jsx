import { useState } from "react";
import { usePage, router } from "@inertiajs/react";
import dayjs from "dayjs";
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'

import { MdOutlineNoEncryptionGmailerrorred } from "react-icons/md";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

import { capitalizeFirstLetter } from "@/Utils/stringUtils";


export default function Create() {
    return (
        <>
            <PageHeaders>Attendance</PageHeaders>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const { shift, auth, attendance } = usePage().props;

    const currentTime = dayjs().format("YYYY-MM-DDTHH:mm:ss.SSS");


    async function onTimeIn() {
        try {
                router.post(route("admin.attendances.check-in"), {
                id: auth.id,
                shiftTime: shift.from,
                postTime: currentTime,
                action: "check_in",
            });
        } catch (e) {
            console.log(e);
            errorSwal("Something went wrong! Please try again later.");
        }
    }

    function onTimeOut() {
        try {
            router.post(route("admin.attendances.check-out"), {
                id: auth.id,
                shiftTime: shift.to,
                postTime: currentTime,
                action: "check_out",
            });
        } catch (e) {
            console.log(e);
            errorSwal("Something went wrong! Please try again later.");
        }
    }


    function formatHourTo12H(hour) {
        const timeTo12H = dayjs("1/1/1 " + hour).format("hh:mm A");

        return timeTo12H;
    }

    function formatDateToTime(date){
        const dateToTime = dayjs(date).format("hh:mm A")

        return dateToTime;
    }

    return (
        <>
            <div
                id="dailyAttendance-filter"
                className="bg-white mb-5 border w-full border-blue-900 rounded-md shadow sm:p-8 p-6"
            >
                <h1 className="text-xl mb-8 font-medium leading-tight tracking-tight border-b-[3px] pb-4 border-blue-900 text-blue-900 md:text-2xl">
                    Daily Attendance
                </h1>

                <div className="flex items-center mb-5 justify-end">
                    {/* <div>
                        <p
                            id="holidayMessage"
                            className="text-red-500 font-medium hidden"
                        >
                            Today is a holiday
                        </p>
                    </div> */}
                    <div className={"flex space-x-2"}>
                        <button
                            className="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 "
                            onClick={onTimeIn}
                        >
                            Time In
                        </button>
                        <button
                            className="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 "
                            onClick={onTimeOut}
                        >
                            Time Out
                        </button>
                    </div>
                </div>
                <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        id="default-table"
                        className="w-full text-sm text-left rtl:text-right text-gray-500 "
                    >
                        <thead className="text-sm text-white bg-blue-900  ">
                            <tr>
                                <th scope="col" className="px-6 py-3">
                                    Shift
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Time In
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Time Out
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody id="attendanceBody">
                            <tr className="odd:bg-blue-100 even:bg-white border-b">
                                <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {`${formatHourTo12H(
                                        shift.from
                                    )} - ${formatHourTo12H(shift.to)}`}
                                </td>
                                <td
                                    id="timeIn"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    {attendance?.check_in ? formatDateToTime(attendance?.check_in) : '--'}
                                </td>
                                <td
                                    id="timeOut"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    {attendance?.check_out ? formatDateToTime(attendance?.check_out) : '--'}

                                </td>
                                <td
                                    id="status"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    {attendance?.status ? capitalizeFirstLetter(attendance?.status) : '--'}

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </>
    );
}

// Late, Present, Absent, Not Timed Out
function postFormat({ id, shiftTime, postTime, action }) {
    return  {
        'user_id': id,
        'shift_time': shiftTime,
        'post_time': postTime,
        'action': action
    };

}

function errorSwal( error ) {
    withReactContent(Swal).fire({
        title: <b>ERROR</b>,
        iconHtml: <MdOutlineNoEncryptionGmailerrorred/>,
        text: error,
        confirmButtonText: 'Confirm',
        customClass: {
            container: '...',
            popup: 'border rounded-3xl',
            header: '...',
            title: 'text-gray-500',
            icon: '...',
            htmlContainer: '...',
            validationMessage: '...',
            actions: '...',
            confirmButton: 'bg-blue-800',
          }
    });
}

function successSwal( message ) {
    withReactContent(Swal).fire({
        title: <b>SUCCESS!</b>,
        icon: 'success',
        text: message,
        confirmButtonText: 'Confirm',
        customClass: {
            container: '...',
            popup: 'border rounded-3xl',
            header: '...',
            title: 'text-green-500',
            icon: 'text-green-900',
            htmlContainer: '...',
            validationMessage: '...',
            actions: '...',
            confirmButton: 'bg-blue-800',
          }
    });
}