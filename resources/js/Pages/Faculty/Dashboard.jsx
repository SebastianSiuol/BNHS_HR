import { useState, useEffect } from 'react';
import { usePage } from '@inertiajs/react';
import { Description, DialogTitle } from "@headlessui/react";
import dayjs from 'dayjs';

import { HiOutlineClipboardList, HiOutlineSpeakerphone } from "react-icons/hi";
import Modal from "@/Components/Modal.jsx";


export default function Dashboard() {
    return (
        <>
            <HandlePage />
        </>
    );
}

function HandlePage() {
    const { full_name: fullName, announcements } = usePage().props;

    const [isAnnouncementView, setIsAnnouncementView] =
    useState(false);

    const [selectedAnnouncement, setSelectedAnnouncement] = useState(null);

    function handleAnnouncementView(id){
        const selectAnnc = announcements.find((ann)=>ann.id === id);
        setSelectedAnnouncement(selectAnnc);
        setIsAnnouncementView((e)=>!e);
    }
    return (
        <>
            <section className="bg-white shadow-md rounded-lg mr-5 p-6 min-w-96">
                <div className="flex">
                    <h2 className="text-2xl font-semibold pt-5 pl-3 mb-5 mr-3">
                        Hi there, {fullName}!
                    </h2>
                    <img
                        src={"/imgs/wave2.png"}
                        className="h-12 mt-3 animate-wave origin-[70%_70%]"
                        alt="Waving Hand"
                    />
                </div>

                <section className=" p-6">
                    <h2 className="text-lg font-medium">Attendance Status</h2>
                    <p className="mt-4 text-green-600">Present</p>
                </section>

                <section className=" p-6">
                    {/* <h2 className="text-lg font-medium">Recent Requests</h2>
                    <ul className="mt-4 space-y-2">
                        <li className="text-gray-600">
                            Leave Request -{" "}
                            <span className="text-yellow-400">Pending</span>
                        </li>
                        <li className="text-gray-600">
                            Attendance Correction -{" "}
                            <span className="text-green-400">Approved</span>
                        </li>
                        <li className="text-gray-600">
                            Others -{" "}
                            <span className="text-red-600">Rejected</span>
                        </li>
                    </ul> */}
                </section>
            </section>

            <div className="w-full">
                <div className="sm:grid grid-cols-2 gap-6 max-w-7xl mb-5">
                    <DailySchedule />

                    {/* <section className="bg-white shadow-md rounded-lg p-6 py-8">
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
            </section> */}
                </div>

                <section className="bg-white shadow-md rounded-lg p-6 py-8">
                    <div className="flex pt-1 pl-1 mb-6">
                    <HiOutlineSpeakerphone className={'w-10 h-10 text-blue-700 mr-2"'}/>
                        <h2 className="text-xl font-semibold mt-2">
                            Announcements and Updates
                        </h2>
                    </div>

                    <div className="p-5 bg-gray-200 border-t-2 border-t-gray-300">
                        {/* Announcements! */}
                        <ul className="mt-4 space-y-2">
                        {announcements.map((announcement) => (
                                <li key={announcement.id}>
                                    <button onClick={()=>{
                                        handleAnnouncementView(announcement.id);

                                    }}
                                        className="block text-left w-full h-full bg-white border border-gray-200 rounded-lg shadow p-4 transform transition duration-500 hover:scale-105">
                                        <strong className="font-semibold text-gray-900">
                                            {announcement.title}
                                        </strong>

                                        <p className="mt-1 text-xs font-medium text-gray-800">
                                            {announcement.description}
                                        </p>
                                    </button>
                                </li>
                            ))}
                        </ul>
                    </div>
                </section>
            </div>
            <ViewAnnouncement
                modal={isAnnouncementView}
                toggleModal={()=> setIsAnnouncementView((e)=>!e)}
                data={selectedAnnouncement}
            />
        </>
    );
}

function DailySchedule (){
    const { faculty_code: facultyCode } = usePage().props;
    const [scheduleData, setScheduleData] = useState([]);
    const [isLoading, setISLoading] = useState(false);
    const [fetchError, setFetchError] = useState(null);

    const yearToday = dayjs().format('YYYY');
    const yearNextYear = dayjs().add(1, 'year').format('YYYY');
    const yearLoad = (`${yearToday}-${yearNextYear}`)

    const sisUrl = (`https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/faculty/${facultyCode}/subject-loads/schoolYear/${yearLoad}`)

    useEffect(function () {
        async function getSubjectLoads() {
            setISLoading(true);

            try {
                const response = await fetch(sisUrl, {
                    method: "GET",
                });

                const data = await response.json();

                if (!response.ok) {
                    setScheduleData([]);
                    setFetchError("Failed fetching schedules. Please reload again!");
                } else {
                    const schedules = parseSchedules(data?.facultySubjects?.subjects);
                    setScheduleData(schedules);
                    setFetchError(null);
                }
            } catch (err) {
                console.error(err);
                setFetchError("An error occurred while fetching schedules.");
            } finally {
                setISLoading(false);
            }
        }
        getSubjectLoads();
    }, []);

    function parseSchedules(subjects) {
        // Flatten subject schedules into a single array
        return subjects.flatMap((subject) =>
            subject.Subject_Schedules.map((schedule) => ({
                time: `${schedule.startTime} - ${schedule.endTime}`,
                activity: `${subject.subjectName} (${subject.abbreviation}) - Grade ${subject.gradeLevel} ${subject.sectionName} (${schedule.dayOfWeek})`,
            }))
        );
    };

    return (
        <section className="bg-white shadow-md rounded-lg p-6 py-8">
            <div className="flex pt-1 pl-1">
                <HiOutlineClipboardList className="w-10 h-10 text-blue-700 mr-2" />
                <h2 className="text-xl font-semibold mt-1">Daily Schedule</h2>
            </div>
            <div className="mt-4 ml-4">
                {isLoading ? (
                    <div className="text-center text-gray-500">Loading schedule...</div>
                ) : fetchError ? (
                    <div className="text-center text-red-500">{fetchError}</div>
                ) : scheduleData.length === 0 ? (
                    <div className="text-center text-gray-500">No schedules available.</div>
                ) : (
                    <table className="w-full text-gray-600">
                        <thead>
                            <tr>
                                <th className="py-2">Time</th>
                                <th className="py-2">Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            {scheduleData.map((item, index) => (
                                <tr key={index}>
                                    <td className="py-2">{item.time}</td>
                                    <td className="py-2">{item.activity}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                )}
            </div>
        </section>
    );

}

function ViewAnnouncement({ modal, toggleModal, data }) {

    return (
        <Modal state={modal} onToggle={toggleModal}>
            <DialogTitle
                as={"div"}
                className="flex p-6 font-bold text-xl justify-between items-center w-[40vw]"
            >
                <h3>Announcement</h3>
                <button onClick={toggleModal} className={"text-red-500"}>
                    &times;
                </button>
            </DialogTitle>
            <Description as={"div"} className="p-6 space-y-5 w-[40vw]">
                <div>
                    <h3 className={'font-bold text-lg'}>Title:</h3>
                    <p>{data?.title}</p>
                </div>

                <div>
                    <h3 className={'font-bold text-lg'}>Description:</h3>
                    <p>{data?.description}</p>
                </div>

                <div>

                <h3 className={'font-bold text-lg'}>File:</h3>

                {data?.fileUrl ? (
                    <iframe
                    src={data?.fileUrl}
                    width={'100%'}
                    height={"600px"} />
                ) : (<div> No File Attached</div>)}
                </div>

            </Description>
        </Modal>
    );
}