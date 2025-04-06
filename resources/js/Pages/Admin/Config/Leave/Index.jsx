/*
 * Dependencies and Libraries
 */
import { useState, useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { useForm as useInertiaForm } from "@inertiajs/react";
import { usePage, router, Head } from "@inertiajs/react";
import DatePicker from "react-datepicker";
import dayjs from "dayjs";
import { Description, DialogTitle } from "@headlessui/react";

import { FaSearch } from "react-icons/fa";

import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

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

import { capitalizeFirstLetter } from "@/Utils/stringUtils.js";



export default function Index() {
    return (
        <>
            <Head title={'Leave Type Configuration'} />
            <PageHeaders>Leave Type</PageHeaders>
            <ContentContainer type="noOutline">
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { leaveTypes } = usePage().props;
    const [openAddModal, setOpenAddModal] = useState(false);
    const [openEditModal, setOpenEditModal] = useState(false);
    const [selectedLeaveType, setSelectedLeaveType] = useState(null);

    console.log(leaveTypes.data);

    const handleAddModal = () => {
        setOpenAddModal((e) => !e);
    };

    const handleEditModal = (public_id) => {
        setSelectedLeaveType(leaveTypes?.data.find((lType) => lType.public_id === public_id));
        setOpenEditModal((e) => !e);
    };

    const handleDeleteModal = (public_id) => {
        withReactContent(Swal).fire({
                title: 'Are you sure?',
                icon: 'warning',
                html: 'Are you sure you want to delete this <strong>leave type?</strong>',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showDenyButton: true,
                confirmButtonText: 'Confirm',
                denyButtonText: 'Cancel',
                customClass: {
                    popup: 'border rounded-3xl',
                    confirmButton: 'bg-blue-700',
                    denyButton: 'bg-gray-200 text-gray-800',
                    }
            }).then((result)=>{
                if (result.isConfirmed){
                    router.delete(route('admin.config.leave.destroy', public_id));
                }
                if(result.isDenied){
                    withReactContent(Swal).fire({
                        title: 'Deletion cancelled',
                        icon: 'success',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        confirmButtonText: 'Confirm',
                        customClass: {
                            popup: 'border rounded-3xl',
                            confirmButton: 'bg-blue-700',
                            }
                    });
                }
            });
        }

    return (
        <>
            <AddModal
                state={openAddModal}
                onToggle={handleAddModal}
            />
            <EditModal
                state={openEditModal}
                onToggle={handleEditModal}
                selectedLeaveType={selectedLeaveType}
            />

            <div className="pb-4 flex items-center justify-end">
                {/* <SearchHeader /> */}
                <AddButton onAddClick={handleAddModal} />
            </div>
            <LeaveTypesTable leaveTypes={leaveTypes.data} onEditClick={handleEditModal} onDeleteClick={handleDeleteModal}/>
            <Pagination data={leaveTypes} />
        </>
    );
}

function AddButton({ onAddClick }) {
    return (
        <div className="mt-2 sm:flex">
            <div className="flex items-center justify-end">
                <button
                    onClick={onAddClick}
                    className="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button">
                    Add Leave Type
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

function LeaveTypesTable({ leaveTypes, onEditClick, onDeleteClick }) {
    // Headers
    const headers = ["Name", "Days", "For", "Action"];

    function parseTime(date){
        return dayjs(date).format('hh:mm A');
    }

    // Columns
    const columns = [
        (leaveType) => capitalizeFirstLetter(leaveType.name),
        (leaveType) => leaveType.days ? leaveType.days : 'Service Credits',
        (leaveType) => capitalizeFirstLetter(leaveType.for),
        (leaveType) => (
            <div className="flex items-center gap-x-4 justify-center">
                <button
                    onClick={() => {
                        onEditClick(leaveType.public_id);
                    }}>
                    <CustomIcon type="edit" />
                </button>

                <button
                    onClick={() => {
                        onDeleteClick(leaveType.public_id);
                    }}>
                    <CustomIcon type="delete" />
                </button>
            </div>
        ),
    ];

    return (
        <Table
            data={leaveTypes}
            headers={headers}
            renderRow={(leaveType) => (
                <TableRow
                    key={leaveType.public_id}
                    data={leaveType}
                    columns={columns}
                />
            )}
        />
    );
}

function AddModal({ state, onToggle }) {
    let isServiceCredits = false;

    const {
        register,
        handleSubmit,
        watch,
        reset,
        formState: { errors },
    } = useForm();


    isServiceCredits = watch("is_service_credits", false);

    function handleLeaveTypeStore(data, e) {
        e.preventDefault();
        console.log(data);
        router.post(route("admin.config.leave.store"), data, {
            onSuccess: () => {
                reset();
                onToggle();
            },
        });
    }

    return (
        <Modal
            state={state}
            onToggle={onToggle}>
            <div className={"flex flex-col space-y-8 p-4"}>
                <DialogTitle className="flex font-bold text-blue-900 justify-between items-center">
                    <span>Add New Leave Type</span>
                    <button
                        onClick={onToggle}
                        className={"text-red-500 hover:text-red-900 hover:scale-125 transition-all duration-200"}>
                        &times;
                    </button>
                </DialogTitle>
                <Description as={"div"}>
                    <div className={"space-y-6"}>
                        <form>
                            <LabelInput
                                id={"name"}
                                label={"Leave Type Name"}
                                register={register}
                                error={errors}
                            />
                            <label className={"text-sm space-x-3 space-y-2 text-black font-normal align-middle"}>
                            <input
                                {...register("is_service_credits")}
                                type="checkbox"
                            />
                                <span>Service Credits</span>
                            </label>
                            {!isServiceCredits && (
                                <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                Days
                                <input
                                    {...register("days")}
                                    defaultValue={1}
                                    type="number"
                                    className={
                                        "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    }
                                    min={1}
                                    max={1460}

                                />
                            </label>
                            )}
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                For
                                <select
                                    {...register("for")}
                                    className={
                                        "my-2 after:bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    }>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="both">Both</option>
                                </select>
                            </label>

                        </form>

                        <div>
                            <Buttons
                                type={"submit"}
                                onClick={handleSubmit(handleLeaveTypeStore)}>
                                Submit
                            </Buttons>
                        </div>
                    </div>
                </Description>
            </div>
        </Modal>
    );
}

function EditModal({ state, onToggle, selectedLeaveType }) {

    const {
        register,
        handleSubmit,
        watch,
        reset,
        setValue,
        formState: { errors },
    } = useForm();

    let isServiceCredits = false;
    isServiceCredits = watch("is_service_credits", false);

    useEffect(() => {
        // console.log(Intl.supportedValuesOf('timeZone'));
        setValue('name', selectedLeaveType?.name);
        setValue('is_service_credits', selectedLeaveType?.days ? false : true);
        setValue('days', selectedLeaveType?.days ? selectedLeaveType?.days : 1);
        setValue('for', selectedLeaveType?.for);

    }, [selectedLeaveType]);

    function handleLeaveTypeUpdate(data, e) {
        e.preventDefault();
        router.patch(route("admin.config.leave.update", selectedLeaveType?.public_id), data, {
            onSuccess: () => {
                reset();
                onToggle();
            },
        });
    }

    return (
        <Modal
            state={state}
            onToggle={onToggle}>
            <div className={"flex flex-col space-y-8 p-4"}>
                <DialogTitle className="flex font-bold text-blue-900 justify-between items-center">
                    <span>Edit New Leave Type</span>
                    <button
                        onClick={onToggle}
                        className={"text-red-500 hover:text-red-900 hover:scale-125 transition-all duration-200"}>
                        &times;
                    </button>
                </DialogTitle>
                <Description as={"div"}>
                    <div className={"space-y-6"}>
                        <form>
                            <LabelInput
                                id={"name"}
                                label={"Leave Type Name"}
                                register={register}
                                error={errors}
                            />
                            <label className={"text-sm space-x-3 space-y-2 text-black font-normal align-middle"}>
                            <input
                                {...register("is_service_credits")}
                                type="checkbox"
                            />
                                <span>Service Credits</span>
                            </label>
                            {!isServiceCredits && (
                                <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                Days
                                <input
                                    {...register("days")}
                                    defaultValue={1}
                                    type="number"
                                    className={
                                        "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    }
                                    min={1}
                                    max={1460}

                                />
                            </label>
                            )}
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                For
                                <select
                                    {...register("for")}
                                    className={
                                        "my-2 after:bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    }>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="both">Both</option>
                                </select>
                            </label>

                        </form>

                        <div>
                            <Buttons
                                type={"submit"}
                                onClick={handleSubmit(handleLeaveTypeUpdate)}>
                                Submit
                            </Buttons>
                        </div>
                    </div>
                </Description>
            </div>
        </Modal>
    );
}

function CustomTimePicker({ value, error, name }) {
    const timePickerClass =
        "grow w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:border-blue-600";

    return (
        <>
            <DatePicker
                selected={value.value}
                onChange={(time) => value.onChange(time)}
                showTimeSelect
                showTimeSelectOnly
                timeIntervals={15}
                timeCaption="Time"
                dateFormat="h:mm aa"
                className={timePickerClass}
            />
        </>
    );
}
