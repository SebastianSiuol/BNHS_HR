import { usePage, router } from "@inertiajs/react";
import { useState } from "react";
import dayjs from "dayjs";

import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

import utc from "dayjs/plugin/utc";
import timezone from "dayjs/plugin/timezone";

// Extend dayjs with the plugins
dayjs.extend(utc);
dayjs.extend(timezone);

const AUTH_API_KEY = import.meta.env.VITE_AUTH_API_KEY;


export default function Create() {
    return (
        <>
            <PageHeaders>Attendance</PageHeaders>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const { shift, auth } = usePage().props;

    const postUrl = "/api/attendance/action";

    async function onTimeIn() {
        const currentTime = dayjs().format("YYYY-MM-DDTHH:mm:ss.SSS");
        try {
            const response = fetch(postUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "x-auth-api-key": AUTH_API_KEY,
                },
                body: JSON.stringify(postFormat({ id:auth.id, shiftTime:shift.from, postTime:currentTime, action: 'check_in'})),
            });

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            const json = await response.json();
            console.log(json);
        } catch (e) {
            console.log(e);
        }
    }



    function onTimeOut() {
    //     fetch(postAttendanceUrl, {
    //         method: "POST",
    //         headers: {
    //             "x-auth-api-key": AUTH_API_KEY,
    //             "Content-Type": "application/json",
    //         },
    //         body: JSON.stringify(
    //             postFormat({ id: auth.id, shiftTime: shift.from, postTime: getDateToday(), action: "check_in"})
    //         ),
    //     })
    //         .then((response) => {
    //             if (!response.ok) {
    //                 throw new Error(response.error);
    //             }
    //             return response.json();
    //         })
    //         .then((data) => {
    //             console.log("Success:", data);
    //         })
    //         .catch((error) => {
    //             console.error(error);
    //         });
    }

    function formatTimeTo12H(hour) {
        const timeTo12H = dayjs("1/1/1 " + hour).format("hh:mm A");

        return timeTo12H;
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
                                    {`${formatTimeTo12H(
                                        shift.from
                                    )} - ${formatTimeTo12H(shift.to)}`}
                                </td>
                                <td
                                    id="timeIn"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    --
                                </td>
                                <td
                                    id="timeOut"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    --
                                </td>
                                <td
                                    id="status"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "
                                >
                                    --
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
