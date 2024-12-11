import { useState } from "react";
import { usePage, router } from "@inertiajs/react";
import { useForm, Controller } from "react-hook-form";

import { FaCalendar } from "react-icons/fa6";
import { IoArchive } from "react-icons/io5";
import { IoSearchSharp } from "react-icons/io5";

import { setSubmissionDateSchema } from '@/Schemas/RPMSSchema';

import CustomDatePicker from "@/Components/CustomDatePicker";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { ContentContainer } from "@/Components/ContentContainer";
import { ContentHeader } from "@/Components/ContentHeader";
import { Description, DialogTitle } from "@headlessui/react";
import Modal from "@/Components/Modal.jsx";
import { Table } from "@/Components/Table";
import { TableRow } from "@/Components/Table";
import Pagination from "@/Components/Pagination";
import CustomIcon from "@/Components/CustomIcon";
import { zodResolver } from "@hookform/resolvers/zod";

export default function Index() {
    const { faculties } = usePage().props;

    return (
        <>
            <PageHeaders>RPMS Management</PageHeaders>
            <ContentContainer>
                <ContentHeader>Performance Management</ContentHeader>
                <HandlePage />
                <Pagination data={faculties} />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const [dateModal, setDateModal] = useState(false);

    const toggleDateModal = () => {
        setDateModal((el) => !el);
    };

    return (
        <>
            <Header onToggle={toggleDateModal} />
            <FacultyTable />
            <SetDateModal state={dateModal} onToggle={toggleDateModal} />
        </>
    );
}

function Header({ onToggle }) {
    const { mid_year_date: midYearDate, end_year_date: endYearDate } =
        usePage().props.rpms_config;

    return (
        <>
            <div className="pb-4 flex items-center justify-between dark:bg-gray-900">
                <label htmlFor="table-search" className="sr-only">
                    Search
                </label>
                <div className="relative flex mt-1">
                    <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <IoSearchSharp
                            className={
                                "w-4 h-4 text-gray-500 dark:text-gray-400"
                            }
                        />
                    </div>
                    <input
                        type="text"
                        id="table-search"
                        className="block mr-2 h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for items"
                    />

                    <div className="flex">
                        <select
                            id="shift"
                            defaultValue="0"
                            className="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5"
                            required=""
                        >
                            <option disabled value="0">
                                Year
                            </option>
                            <option value="1">2024</option>
                        </select>
                    </div>
                </div>

                <div className="flex border-gray-300 mt-1 px-4 border bg-gray-50 rounded-lg items-center justify-center">
                    <div className="mr-4  block items-center justify-center">
                        <h1 className="text-sm">Submission Date:</h1>
                    </div>
                    <div className="block">
                        <h1 className="text-sm">
                            Mid Year <span className="mr-3"></span> |{" "}
                            <span className="mr-3"></span> Year End
                        </h1>
                        <div className="flex">
                            <p className="text-sm mr-2">{midYearDate}</p>
                            <p className="text-sm">{endYearDate}</p>
                        </div>
                    </div>
                </div>

                <div className="flex">
                    <div className="mt-2">
                        <button onClick={onToggle} className="hover:scale-110">
                            <FaCalendar
                                className={
                                    "w-6 h-6 text-blue-800 dark:text-white"
                                }
                            />
                        </button>
                    </div>

                    <div className="justify-end flex ml-5 mt-px ">
                        <button className="hover:scale-110">
                            <IoArchive
                                className={
                                    "w-9 h-9 text-blue-800 dark:text-white"
                                }
                            />
                        </button>
                    </div>
                </div>
            </div>
        </>
    );
}

function FacultyTable() {
    const { data } = usePage().props.faculties;

    // Headers
    const headers = [
        "Teaacher Name",
        "Department",
        "Date Submitted",
        "Status",
        "View Details",
    ];

    // Columns Data
    const columns = [
        (faculty) =>
            `${faculty.personal_information.first_name} ${faculty.personal_information.last_name}`,
        (faculty) => faculty.designation.department.name,
        () => "2024-10-10",
        () => "Pending",
        (faculty) => (
            <button onClick={() => {}}>
                <CustomIcon type="view" />
            </button>
        ),
    ];

    return (
        <Table
            data={data}
            headers={headers}
            renderRow={(faculty) => (
                <TableRow key={faculty.id} data={faculty} columns={columns} />
            )}
        />
    );
}

function SetDateModal({ state, onToggle }) {
    const { year } = usePage().props.rpms_config;

    const {
        handleSubmit,
        control,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(setSubmissionDateSchema),
    });
5
    function handleSetSubmit(data, e) {
        e.preventDefault();
        router.post(route("admin.rpms.config.store"), data);
    }

    return (
        <>
            <Modal state={state} onToggle={onToggle}>
                <DialogTitle className="flex font-bold text-2xl text-blue-900 justify-between items-center p-7" as={'div'}>
                    <span>Set Submission Date</span>
                    <button
                        onClick={onToggle}
                        className={
                            "text-red-500 hover:text-red-900 hover:scale-125 transition-all duration-200"
                        }
                    >
                        &times;
                    </button>
                </DialogTitle>
                <Description as={'div'}>
                    <span>
                        <form
                            id={"set_submission_date"}
                            onSubmit={handleSubmit(handleSetSubmit)}
                            className={"sm:flex p-5 space-x-5"}
                        >
                            <div className="relative shadow-md sm:rounded-lg">
                                <div className="items-center justify-center flex mb-5">
                                    <h1 className="text-lg">Mid Year</h1>
                                </div>

                                <Controller
                                    control={control}
                                    name={"mid_year_date"}
                                    render={({ field }) => (
                                        <CustomDatePicker
                                            value={field}
                                            error={errors}
                                            name={"mid_year_date"}
                                            minimumDate={`${year}-01-01`}
                                            maximumDate={`${year}-12-31`}
                                        />
                                    )}
                                />
                            </div>

                            <div className="relative shadow-md sm:rounded-lg">
                                <div className="items-center justify-center flex mb-5">
                                    <h1 className="text-lg">End Year</h1>
                                </div>

                                <Controller
                                    control={control}
                                    name={"end_year_date"}
                                    render={({ field }) => (
                                        <CustomDatePicker
                                            value={field}
                                            error={errors}
                                            name={"end_year_date"}
                                            minimumDate={`${year}-01-01`}
                                            maximumDate={`${year}-12-31`}
                                        />
                                    )}
                                />
                            </div>
                        </form>
                    </span>
                    <div className={"flex justify-end p-5"}>
                        <button
                            form={"set_submission_date"}
                            type={"submit"}
                            className={
                                "text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            }
                        >
                            Submit date
                        </button>
                    </div>
                </Description>
            </Modal>
        </>
    );
}
