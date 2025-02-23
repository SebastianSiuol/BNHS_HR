import { useState } from 'react';
import { router, Link, usePage, useForm as useInertiaForm, Head } from "@inertiajs/react";
import { Description, DialogTitle} from '@headlessui/react';
import * as DropdownMenu from "@radix-ui/react-dropdown-menu";

// Icons
import { FaSearch } from "react-icons/fa";

// Context
import { FacultiesIndexProvider } from "@/Context/FacultiesIndexContext";
import { useFacultiesIndex } from "@/Context/FacultiesIndexContext";

// Components
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { Show } from "./Show";
import CustomIcon from "@/Components/CustomIcon";
import Modal from "@/Components/Modal.jsx";
import Pagination from "@/Components/Pagination";

import { Table } from '@/Components/Table';
import { TableRow } from '@/Components/Table';

import { capitalizeFirstLetter } from '@/Utils/stringUtils';

export default function Index() {
    return (
        <>
            <Head title={'Manage Faculties'}/>
            <PageHeaders>Manage Faculties</PageHeaders>

            <FacultiesIndexProvider>
                <HandlePage />
            </FacultiesIndexProvider>
        </>
    );
}

function HandlePage() {
    const { faculties } = usePage().props;


    return (
        <>
            <ContentContainer type={"noOutline"}>
                <SearchHeader />
                <FacultyTable faculties={faculties?.data} />
                <Pagination data={faculties} />

                <ShowFacultyModal />
                <ShowDeleteModal />
            </ContentContainer>
        </>
    );
}

function SearchHeader() {
    const { data, setData } = useInertiaForm({
        query: "",
    });

    function searchQuery(e) {
        e.preventDefault();
        router.get(route("admin.faculty.search"), data);
    }

    return (
        <>
            <div className="pb-4 flex items-center justify-between">
                <form
                    className="relative mt-1 grid grid-cols-1 sm:grid-cols-2"
                    onSubmit={searchQuery}>
                    <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <FaSearch className="w-4 h-4 text-gray-500 " />
                    </div>
                    <input
                        className="block h-10 sm:w-96 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for items"
                        value={data.query}
                        onChange={(e) => setData("query", e.target.value)}
                    />
                    <button
                        type="submit"
                        className="w-32 ml-4 px-4 py-2.5 text-white text-sm text-center font-medium bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                        Search
                    </button>
                </form>
            </div>
        </>
    );
}

function FacultyTable({ faculties }){
    const { handleShowFaculty, handleFacultyDeletion } = useFacultyActions();


    // Headers
    const headers = ["Code", "Name", "Email", "Department", "Shift", "Status", "Actions"];

    // Columns Data
    const columns = [
        (faculty) => faculty.faculty_code,
        (faculty) => `${faculty.personal_information?.first_name ?? ""} ${faculty.personal_information?.last_name ?? ""}`,
        (faculty) => faculty.email,
        (faculty) => (faculty.designation?.department.name ?? "N/A"),
        (faculty) => capitalizeFirstLetter(faculty.shift?.name ?? "N/A"),
        () => "Active",
        (faculty) => (
            <div className="flex items-center justify-end">
                <button onClick={() => handleShowFaculty(faculty.id)}>
                    <CustomIcon type="view" />
                </button>
                {/* <Link href={route("admin.faculty.edit", { faculty: faculty.id })}>
                    <CustomIcon type="edit" />
                </Link> */}
                <EditButtonContext selectedFaculty={faculty?.id}/>
                <button onClick={() => handleFacultyDeletion(faculty.id)}>
                    <CustomIcon type="delete" />
                </button>
            </div>
        ),
    ];

    return <Table data={faculties} headers={headers} renderRow={(faculty) => <TableRow key={faculty.id} data={faculty} columns={columns} />} />;

}

function useFacultyActions() {
    const { fetchFacultyMember, toggleShowModal, toggleDeleteModal } = useFacultiesIndex();

    function handleShowFaculty(id) {
        fetchFacultyMember(id);
        toggleShowModal();
    }

    function handleFacultyDeletion(facultyId) {
        toggleDeleteModal({ data: facultyId });
    }

    return { handleShowFaculty, handleFacultyDeletion}
}

function EditButtonContext({ selectedFaculty }) {
    const [buttonState, setButtonState] = useState(false);

    return (
        <DropdownMenu.Root
            open={buttonState}
            onOpenChange={() => {
                setButtonState((el) => !el);
            }}>
            <DropdownMenu.Trigger>
                <CustomIcon type="edit" />
            </DropdownMenu.Trigger>

            <DropdownMenu.Content
                className="z-50 text-base bg-white divide-y divide-gray-100 rounded shadow"
                align="start">
                <DropdownMenu.Item className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100">
                    <Link
                        className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                        href={route(
                            "admin.faculty.edit.psn-deets",
                            selectedFaculty
                        )}>
                        Person. Info.
                    </Link>
                </DropdownMenu.Item>
                <DropdownMenu.Item>
                    <Link
                        className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                        href={route(
                            "admin.faculty.edit.address",
                            selectedFaculty
                        )}>
                        Addresses
                    </Link>
                </DropdownMenu.Item>
                <DropdownMenu.Item>
                    <Link
                        className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                        href={route(
                            "admin.faculty.edit.comp-deets",
                            selectedFaculty
                        )}>
                        Company Details
                    </Link>
                </DropdownMenu.Item>
                <DropdownMenu.Item>
                    <Link
                        className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                        href={route(
                            "admin.faculty.edit.roles",
                            selectedFaculty
                        )}>
                        Roles
                    </Link>
                </DropdownMenu.Item>
            </DropdownMenu.Content>
        </DropdownMenu.Root>
    );
}



function ShowFacultyModal() {
    const { showModal, toggleShowModal, isLoading, selectedFacultyDetails } =
        useFacultiesIndex();

    return (
        <>
            <Modal
                state={showModal}
                onToggle={toggleShowModal}>
                <DialogTitle
                    className="flex font-bold text-2xl text-blue-900 justify-between items-center p-7"
                    as={"div"}>
                    <span>
                        {isLoading ? (
                            <p>Loading</p>
                        ) : (
                            `Viewing ${selectedFacultyDetails?.faculty_code}`
                        )}
                    </span>
                    <button
                        onClick={toggleShowModal}
                        className={"text-red-500"}>
                        &times;
                    </button>
                </DialogTitle>
                <Description as={"div"}>
                    <Show />
                </Description>
            </Modal>
        </>
    );
}

function ShowDeleteModal() {
    const {
        deleteModal,
        isLoading,
        cancelFacultyDelete,
        confirmFacultyDelete,
    } = useFacultiesIndex();

    return (
        <Modal
            state={deleteModal}
            onToggle={cancelFacultyDelete}>
            <DialogTitle
                className="flex font-bold text-2xl text-black justify-between items-center p-4"
                as={"div"}>
                <span>
                    {isLoading ? (
                        <p>Loading</p>
                    ) : (
                        <p>
                            Confirm{" "}
                            <span className={"font-bold text-red-600"}>
                                delete?
                            </span>
                        </p>
                    )}
                </span>
                <button
                    onClick={cancelFacultyDelete}
                    className={"text-red-800"}>
                    &times;
                </button>
            </DialogTitle>
            <Description as={"div"}>
                <div className={"px-12 pb-8"}>
                    <p className={"text-lg"}>
                        Are you sure you want to delete this faculty member?
                    </p>
                    <p className={"text-lg text-red-600 text-end"}>
                        *This action is irreversible!
                    </p>
                </div>
                <div className={"flex justify-between px-12 mb-8"}>
                    <button
                        onClick={confirmFacultyDelete}
                        className={
                            "text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                        }>
                        Confirm delete
                    </button>
                    <button
                        onClick={cancelFacultyDelete}
                        className={
                            "py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                        }>
                        Cancel
                    </button>
                </div>
            </Description>
        </Modal>
    );
}