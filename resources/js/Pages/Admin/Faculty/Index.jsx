import { useState, useEffect } from "react";
import {
    router,
    Link,
    usePage,
    useForm as useInertiaForm,
} from "@inertiajs/react";
import { Description, DialogTitle} from '@headlessui/react';

// Icons
import { FaSearch } from "react-icons/fa";

// Layouts
import { AuthenticatedAdminLayout } from "@/Layouts/AuthenticatedAdminLayout.jsx";

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


const headers = [
    "Employee ID",
    "Name",
    "Email",
    "Department",
    "Shift",
    "Status",
    "Action",
];

export default function Index() {
    return (
        <>
            <AuthenticatedAdminLayout>
            <PageHeaders>Manage Faculties</PageHeaders>

                <FacultiesIndexProvider>
                    <HandlePage />
                </FacultiesIndexProvider>
            </AuthenticatedAdminLayout>
        </>
    );
}

function HandlePage() {
    const { faculties, flash } = usePage().props;
    const { showModal, toggleShowModal, deleteModal, isLoading, selectedFacultyDetails, cancelFacultyDelete, confirmFacultyDelete} = useFacultiesIndex();
    const [storedFaculties, setStoredFaculties] = useState([]);

    useEffect(() => {
        setStoredFaculties(faculties?.data ?? []);
    }, [faculties]);

    // console.log(flash?.message)

    return (
        <>
                <ContentContainer type={"noOutline"}>
                    <SearchHeader />
                    <Table faculties={storedFaculties} />
                    <Pagination data={faculties} />

                    <Modal state={showModal} onToggle={toggleShowModal}>
                        <DialogTitle className="flex font-bold text-2xl text-blue-900 justify-between items-center p-7">
                            <span>{isLoading ? <p>Loading</p> : `Viewing ${selectedFacultyDetails?.faculty_code}`}</span>
                            <button onClick={toggleShowModal} className={"text-red-500"}>
                                &times;
                            </button>
                        </DialogTitle>
                        <Description>
                            <Show />
                        </Description>
                    </Modal>

                    <Modal state={deleteModal} onToggle={cancelFacultyDelete}>
                        <DialogTitle className="flex font-bold text-2xl text-black justify-between items-center p-4">
                            <span>
                                {isLoading ? (
                                    <p>Loading</p>
                                ) : (
                                    <p>
                                        Confirm <span className={"font-bold text-red-600"}>delete?</span>
                                    </p>
                                )}
                            </span>
                            <button onClick={cancelFacultyDelete} className={"text-red-800"}>
                                &times;
                            </button>
                        </DialogTitle>
                        <Description>
                            <div className={"px-12 pb-8"}>
                                <p className={"text-lg"}>Are you sure you want to delete this faculty member?</p>
                                <p className={"text-lg text-red-600 text-end"}>*This action is irreversible!</p>
                            </div>
                            <div className={"flex justify-between px-12 mb-8"}>
                                <button onClick={confirmFacultyDelete}
                                    className={"text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"}>Confirm delete</button>
                                <button onClick={cancelFacultyDelete}
                                    className={"py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"}>Cancel</button>
                            </div>
                        </Description>
                    </Modal>

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
                    onSubmit={searchQuery}
                >
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
                        className="w-32 ml-4 px-4 py-2.5 text-white text-sm text-center font-medium bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300"
                    >
                        Search
                    </button>
                </form>
            </div>
        </>
    );
}

function Table({ faculties }) {
    return (
        <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table className="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead className="text-sm text-white bg-blue-900 text-center">
                    <tr>
                        {headers.map((header, i) => (
                            <th className={"px-6 py-3"} key={i}>
                                {header}
                            </th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {faculties.length === 0 && (
                        <tr
                            className={
                                "odd:bg-blue-100 even:bg-white border-b text-center"
                            }
                        >
                            <td
                                className={
                                    "px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                }
                                colSpan={7}
                            >
                                No Faculties Found
                            </td>
                        </tr>
                    )}
                    {faculties.map((faculty) => {
                        return <TableRow faculty={faculty} key={faculty.id} />;
                    })}
                </tbody>
            </table>
        </div>
    );
}

function TableRow({ faculty }) {
    const { capitalizeFirstLetter, fetchFacultyMember, toggleShowModal, toggleDeleteModal } = useFacultiesIndex();

    // Data Destructuring and Constructuring
    const {
        id,
        faculty_code,
        email,
        personal_information,
        designation,
        shift,
    } = faculty;
    const { department } = designation;
    const fullName = `${personal_information.first_name} ${personal_information.last_name}`;

    function handleShowFaculty() {
        fetchFacultyMember(id);
        toggleShowModal();
    }

    function handleFacultyDeletion(facultyId){
        toggleDeleteModal({data: facultyId});
    }

    return (
        <tr className={"odd:bg-blue-100 even:bg-white border-b text-center"}>
            <TableItem>{faculty_code}</TableItem>
            <TableItem>{fullName}</TableItem>
            <TableItem>{email}</TableItem>
            <TableItem>{department.name}</TableItem>
            <TableItem>{capitalizeFirstLetter(shift.name)}</TableItem>
            <TableItem>Active</TableItem>
            <TableItem>
                <div className={"flex items-center justify-end"}>
                    <button onClick={handleShowFaculty}>
                        <CustomIcon type={"view"} />
                    </button>
                    <Link href={route('admin.faculty.edit', {'faculty': id})}>
                        <CustomIcon type={"edit"} />
                    </Link>
                    <button onClick={()=>{handleFacultyDeletion(id)}}>
                        <CustomIcon type={"delete"} />
                    </button>
                </div>
            </TableItem>
        </tr>
    );
}

function TableItem({ children }) {
    return (
        <td className={"px-6 py-4 font-medium text-gray-900 whitespace-nowrap"}>
            {children}
        </td>
    );
}
