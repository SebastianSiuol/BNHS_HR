/*
 * Dependencies and Libraries
 */
import { useState, useEffect, useCallback } from "react";
import { useForm, Controller } from "react-hook-form";
import { useForm as useInertiaForm } from "@inertiajs/react";
import { usePage, router } from "@inertiajs/react";
import DatePicker from "react-datepicker";
import dayjs from "dayjs";
import utc from 'dayjs/plugin/utc';
import timezone from 'dayjs/plugin/timezone';
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

import { capitalizeFirstLetter } from "@/Utils/stringUtils.js";



export default function Index() {
    return (
        <>
            <PageHeaders>Shift</PageHeaders>
            <ContentContainer type="noOutline">
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { shifts } = usePage().props;
    const [openAddModal, setOpenAddModal] = useState(false);
    const [openEditModal, setOpenEditModal] = useState(false);
    const [openDeleteModal, setOpenDeleteModal] = useState(false);
    const [selectedShift, setSelectedShift] = useState(null);

    const handleAddModal = () => {
        setOpenAddModal((e) => !e);
    };

    const handleEditModal = (id) => {
        setSelectedShift(shifts?.data.find((pos) => pos.id === id));
        setOpenEditModal((e) => !e);
    };

    const handleDeleteModal = (id) => {
        setSelectedShift(shifts?.data.find((pos) => pos.id === id));
        setOpenDeleteModal((e) => !e);
    };

    return (
        <>
            <AddModal
                state={openAddModal}
                onToggle={handleAddModal}
            />
            <EditModal
                state={openEditModal}
                onToggle={handleEditModal}
                selectedShift={selectedShift}
            />
            <DeleteModal
                state={openDeleteModal}
                onToggle={handleDeleteModal}
                selectedShift={selectedShift}
                />
            <div className="pb-4 flex items-center justify-between dark:bg-gray-900">
                <SearchHeader />
                <AddButton onAddClick={handleAddModal} />
            </div>
            <ShiftsTable shifts={shifts.data} onEditClick={handleEditModal} onDeleteClick={handleDeleteModal}/>
            <Pagination data={shifts} />
        </>
    );
}

function AddButton({ onAddClick }) {
    return (
        <div className="mt-2 sm:flex">
            <div className="flex items-center justify-end">
                <button
                    onClick={onAddClick}
                    className="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Add Shift
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

function ShiftsTable({ shifts, onEditClick, onDeleteClick }) {
    // Headers
    const headers = ["Shift Name", "From Time", "To Time", "Action"];

    function parseTime(date){
        return dayjs(date).format('hh:mm A');
    }

    // Columns
    const columns = [
        (shift) => capitalizeFirstLetter(shift.name),
        (shift) => parseTime(shift.from),
        // (shift) => shift.from,
        (shift) => parseTime(shift.to),
        // (shift) => shift.to,
        (shift) => (
            <div className="flex items-center gap-x-4 justify-center">
                <button
                    onClick={() => {
                        onEditClick(shift.id);
                    }}>
                    <CustomIcon type="edit" />
                </button>

                <button
                    onClick={() => {
                        onDeleteClick(shift.id);
                    }}>
                    <CustomIcon type="delete" />
                </button>
            </div>
        ),
    ];

    return (
        <Table
            data={shifts}
            headers={headers}
            renderRow={(shift) => (
                <TableRow
                    key={shift.id}
                    data={shift}
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
        control,
        reset,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {

        setValue('start_time', dayjs().toDate());
        setValue('end_time', dayjs().add(5, 'hours').toDate());

    }, [state]);

    function handleShiftStore(data, e) {
        e.preventDefault();
        console.log(data);
        router.post(route("admin.config.shift.store"), data, {
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
                    <span>Add New Shift</span>
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
                                label={"Shift Name"}
                                register={register}
                                error={errors}
                            />
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                Start Time
                                <Controller
                                    control={control}
                                    name={"start_time"}
                                    render={({ field }) => <CustomTimePicker value={field} />}
                                />
                            </label>
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                End Time
                                <Controller
                                    control={control}
                                    name={"end_time"}
                                    render={({ field }) => <CustomTimePicker value={field} />}
                                />
                            </label>
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                Shift Description
                                <textarea
                                    {...register("shift_description")}
                                    className={
                                        "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    }
                                />
                            </label>
                        </form>

                        <div>
                            <Buttons
                                type={"submit"}
                                onClick={handleSubmit(handleShiftStore)}>
                                Submit
                            </Buttons>
                        </div>
                    </div>
                </Description>
            </div>
        </Modal>
    );
}

function EditModal({ state, onToggle, selectedShift }) {

    const {
        register,
        handleSubmit,
        control,
        reset,
        setValue,
        formState: { errors },
    } = useForm();

    useEffect(() => {
        // console.log(Intl.supportedValuesOf('timeZone'));
        setValue('name', capitalizeFirstLetter(selectedShift?.name));
        setValue('start_time', dayjs(selectedShift?.from).toDate());
        setValue('end_time', dayjs(selectedShift?.to).toDate());
        setValue('shift_description', selectedShift?.description);

    }, [selectedShift]);

    function handleShiftUpdate(data, e) {
        e.preventDefault();
        router.patch(route("admin.config.shift.update", selectedShift?.id), data, {
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
                    <span>Edit Shift</span>
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
                                label={"Shift Name"}
                                register={register}
                                error={errors}
                            />
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                Start Time
                                <Controller
                                    control={control}
                                    name={"start_time"}
                                    render={({ field }) => <CustomTimePicker value={field} />}
                                />
                            </label>
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                End Time
                                <Controller
                                    control={control}
                                    name={"end_time"}
                                    render={({ field }) => <CustomTimePicker value={field} />}
                                />
                            </label>
                            <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                                Shift Description
                                <textarea
                                    {...register("shift_description")}
                                    className={
                                        "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    }
                                />
                            </label>
                        </form>

                        <div>
                            <Buttons
                                type={"submit"}
                                onClick={handleSubmit(handleShiftUpdate)}>
                                Submit
                            </Buttons>
                        </div>
                    </div>
                </Description>
            </div>
        </Modal>
    );
}

function DeleteModal({ state, onToggle, selectedShift }) {

  function handleShiftDelete(){
      router.delete(route('admin.config.shift.destroy', selectedShift?.id), {
          onSuccess: ()=>{
              onToggle();
          }
      });

  }

  return (
      <Modal
          state={state}
          onToggle={onToggle}>
          <DialogTitle className="flex font-bold text-2xl text-black justify-between items-center p-4">
              <span>
                  Confirm{" "}
                  <span className={"font-bold text-red-600"}>delete?</span>
              </span>
              <button
                  onClick={onToggle}
                  className={"text-red-800"}>
                  &times;
              </button>
          </DialogTitle>
          <Description>
              <div className={"px-12 pb-8"}>
                  <p className={"text-lg"}>
                      Are you sure you want to delete this shift?
                  </p>
                  <p className={"text-lg text-red-600 text-end"}>
                      *This action is irreversible!
                  </p>
              </div>
              <div className={"flex justify-between px-12 mb-8"}>
                  <button
                      onClick={handleShiftDelete}
                      className={
                          "text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"
                      }>
                      Confirm delete
                  </button>
                  <button
                      onClick={onToggle}
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
