import { usePage } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const { full_name: fullName } = usePage().props;


    return <>
    <section className="bg-white shadow-md rounded-lg mr-5 p-6 min-w-96">
        <div className="flex">
            <h2 className="text-2xl font-semibold pt-5 pl-3 mb-5 mr-3">Hi there, {fullName}!</h2>
            <img src={'/imgs/wave2.png'} className="h-12 mt-3 animate-wave origin-[70%_70%]" alt="Waving Hand" />
        </div>

        <section className=" p-6">
            <h2 className="text-lg font-medium">Attendance Status</h2>
            <p className="mt-4 text-green-600">Present</p>
        </section>

        <section className=" p-6">
            <h2 className="text-lg font-medium">Recent Requests</h2>
            <ul className="mt-4 space-y-2">
                <li className="text-gray-600">Leave Request - <span className="text-yellow-400">Pending</span></li>
                <li className="text-gray-600">Attendance Correction - <span className="text-green-400">Approved</span></li>
                <li className="text-gray-600">Others - <span className="text-red-600">Rejected</span></li>
            </ul>
        </section>

    </section>

    <div className="w-full">
        <div className="sm:grid grid-cols-2 gap-6 max-w-7xl mb-5">
            <section className="bg-white shadow-md rounded-lg p-6 py-8">
                <div className="flex pt-1 pl-1">
                    <svg className=" w-9 h-8 text-blue-700 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
                    </svg>
                    <h2 className="text-xl font-semibold mt-1">Daily Schedule</h2>
                </div>
                <div className="mt-4 ml-4">
                    <table className="w-full text-gray-600">
                        <thead>
                        <tr>
                            <th className="py-2">Time</th>
                            <th className="py-2">Activity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td className="py-2">9:00 AM - 10:00 AM</td>
                            <td className="py-2">Team Meeting</td>
                        </tr>
                        <tr>
                            <td className="py-2">10:30 AM - 12:00 PM</td>
                            <td className="py-2">Project Development</td>
                        </tr>                                    <tr>
                            <td className="py-2">10:30 AM - 12:00 PM</td>
                            <td className="py-2">Project Development</td>
                        </tr>
                        <tr>
                            <td className="py-2">10:30 AM - 12:00 PM</td>
                            <td className="py-2">Project Development</td>
                        </tr>
                        <tr>
                            <td className="py-2">10:30 AM - 12:00 PM</td>
                            <td className="py-2">Project Development</td>
                        </tr>
                        <tr>
                            <td className="py-2">10:30 AM - 12:00 PM</td>
                            <td className="py-2">Project Development</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section className="bg-white shadow-md rounded-lg p-6 py-8">
                <div className="flex pt-1 pl-1 mb-6">
                    <svg className="w-9 h-8 text-blue-700 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                    </svg>
                    <h2 className="text-xl font-semibold mt-1">Upcoming Holidays</h2>
                </div>
                <ul className="space-y-2 mt-4 ml-4">
                    <li className="text-gray-600">Independence Day - July 4</li>
                    <li className="text-gray-600">Labor Day - September 5</li>
                    <li className="text-gray-600">Thanksgiving - November 24</li>
                </ul>
            </section>
        </div>

        <section className="bg-white shadow-md rounded-lg p-6 py-8">
            <div className="flex pt-1 pl-1 mb-6">
                <svg className="w-10 h-10 text-blue-700 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd"/>
                </svg>

                <h2 className="text-xl font-semibold mt-2">Announcements and Updates</h2>
            </div>

            <div className="p-5 bg-gray-200 border-t-2 border-t-gray-300">



                {/* Announcements! */}
                <ul className="mt-4 space-y-2">
                    <li>
                        <button className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                            <strong className="font-semibold text-gray-900">Announcement A</strong>

                            <p className="mt-1 text-xs font-medium text-gray-800">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti,
                                unde ab ut in!
                            </p>
                        </button>
                    </li>
                    <li>
                        <button className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                            <strong className="font-semibold text-gray-900">Announcement B</strong>

                            <p className="mt-1 text-xs font-medium text-gray-800">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti,
                                unde ab ut in!
                            </p>
                        </button>
                    </li>
                    <li>
                        <button className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                            <strong className="font-semibold text-gray-900">Announcement C</strong>

                            <p className="mt-1 text-xs font-medium text-gray-800">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime consequuntur deleniti,
                                unde ab ut in!
                            </p>
                        </button>
                    </li>
                </ul>
            </div>

        </section>

    </div>
    </>;
}
