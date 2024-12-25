/*
 * Dependencies and Libraries
 */
import { useState, useEffect } from "react";
import { useForm } from "react-hook-form";
import { useForm as useInertiaForm } from "@inertiajs/react";
import { usePage, router } from "@inertiajs/react";
import { Description, DialogTitle } from "@headlessui/react";

import { FaSearch } from "react-icons/fa";

/*
 Components
 */
import Pagination from "@/Components/Pagination";
import CustomIcon from "@/Components/CustomIcon";
import Modal from "@/Components/Modal";
import { LabelInput } from "@/Components/LabelInput";
import { Buttons } from "@/Components/Buttons";
import { ContentContainer } from "@/Components/ContentContainer";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
// Tables
import { Table } from "@/Components/Table";
import { TableRow } from "@/Components/Table";

export default function Index() {
    return (
        <>
            <PageHeaders>Position</PageHeaders>
            <ContentContainer type="noOutline">
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { school_positions: schoolPositions } = usePage().props;
    const [openAddModal, setOpenAddModal] = useState(false);
    const [openEditModal, setOpenEditModal] = useState(false);
    const [openDeleteModal, setOpenDeleteModal] = useState(false);
    const [selectedPosition, setSelectedPosition] = useState(null);

    const handleAddModal = () => {
        setOpenAddModal((e) => !e);
    };

    const handleEditModal = (id) => {
        setSelectedPosition(schoolPositions?.data.find((pos) => pos.id === id));
        setOpenEditModal((e) => !e);
    };

    const handleDeleteModal = (id) => {
        setSelectedPosition(schoolPositions?.data.find((pos) => pos.id === id));
        setOpenDeleteModal((e) => !e);
    };

    return (
        <>
            <AddModal state={openAddModal} onToggle={handleAddModal} />
            {/* <EditModal
                state={openEditModal}
                onToggle={handleEditModal}
                selectedDept={selectedDept}
            />
            <DeleteModal
                state={openDeleteModal}
                onToggle={handleDeleteModal}
                selectedDept={selectedDept} />  */}
            <div className="pb-4 flex items-center justify-between dark:bg-gray-900">
                <SearchHeader />
                <AddPosition onAddClick={handleAddModal} />
            </div>
            <PositionTable
                positions={schoolPositions?.data}
                onEditClick={handleEditModal}
                onDeleteClick={handleDeleteModal}
            />
            <Pagination data={schoolPositions} />
        </>
    );
}

function AddPosition({ onAddClick }) {
    return (
        <div className="mt-2 sm:flex">
            <div className="flex items-center justify-end">
                <button
                    onClick={onAddClick}
                    className="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Add Position
                </button>
            </div>
        </div>
    );
}

function SearchHeader() {
    const { data, setData } = useInertiaForm({
        query: "",
    });

    function searchQuery(e) {
        e.preventDefault();
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

function PositionTable({ positions, onEditClick, onDeleteClick }) {
    // Headers
    const headers = [
        "Position Title",
        "Position Level",
        "Total Faculties",
        "Action",
    ];

    function formatLevel(level) {
        switch (level) {
            case "leadership":
                return "Leadership";
            case "entry":
                return "Entry-Level";
            case "mid":
                return "Mid-Level";
            case "senior":
                return "Senior-Level";
            case "support":
                return "Support Staff";
            case "it":
                return "IT Staff";
            default:
                return "Unknown Position";
        }
    }

    const columns = [
        (position) => position.title,
        (position) => formatLevel(position.level),
        (position) => position.faculties_count,
        (position) => (
            <div className="flex items-center gap-x-4 justify-center">
                <button
                    onClick={() => {
                        onEditClick(position.id);
                    }}>
                    <CustomIcon type="edit" />
                </button>

                <button
                    onClick={() => {
                        onDeleteClick(position.id);
                    }}>
                    <CustomIcon type="delete" />
                </button>
            </div>
        ),
    ];

    return (
        <Table
            data={positions}
            headers={headers}
            renderRow={(position) => (
                <TableRow
                    key={position.id}
                    data={position}
                    columns={columns}
                />
            )}
        />
    );
}


function AddModal({ state, onToggle }) {

    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
    } = useForm();

    function handleDepartmentSubmit(data, e) {
        e.preventDefault();
        router.post(route("admin.config.position.store"), data, {
            onSuccess: () => {
                reset();
                onToggle();
            },
        });
    }

    return (
        <Modal state={state} onToggle={onToggle}>
            <div className={"flex flex-col space-y-8 p-4"}>
                <DialogTitle className="flex font-bold text-blue-900 justify-between items-center" as={"div"}>
                    <span>Add New Position</span>
                    <button
                        onClick={onToggle}
                        className={
                            "text-red-500 hover:text-red-900 hover:scale-125 transition-all duration-200"
                        }
                    >
                        &times;
                    </button>
                </DialogTitle>
                <Description as={"div"}>
                    <div className={"space-y-6"}>
                        <form>
                            <LabelInput
                                id={"position_title"}
                                label={"Position Title"}
                                register={register}
                                error={errors}
                            />
                            <select {...register('position_level')} className={"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"}>
                            <option value="leadership">Leadership</option>
                            <option value="entry">Entry-Level</option>
                            <option value="mid">Mid-Level</option>
                            <option value="senior">Senior-Level</option>
                            <option value="support">Support Staff</option>
                            <option value="it">IT Staff</option>
                        </select>
                        </form>

                        <div>
                            <Buttons
                                type={"submit"}
                                onClick={handleSubmit(handleDepartmentSubmit)}
                            >
                                Submit
                            </Buttons>
                        </div>
                    </div>
                </Description>
            </div>
        </Modal>
    );
}