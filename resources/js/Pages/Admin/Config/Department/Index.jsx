import { useState, useEffect } from "react";
import { useForm, useFieldArray } from "react-hook-form";
import { useForm as useInertiaForm } from "@inertiajs/react";
import { usePage, router } from "@inertiajs/react";
import { Description, DialogTitle } from "@headlessui/react";

// Icons
import { FaPlusCircle } from "react-icons/fa";
import { FaSearch } from "react-icons/fa";

// Components
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
            <PageHeaders>Department</PageHeaders>
            <ContentContainer type="noOutline">
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { departments } = usePage().props;
    const [openAddModal, setOpenAddModal] = useState(false);
    const [openEditModal, setOpenEditModal] = useState(false);
    const [openDeleteModal, setOpenDeleteModal] = useState(false);
    const [selectedDept, setSelectedDept] = useState(null);

    const handleAddModal = () => {
        setOpenAddModal((e) => !e);
    };

    const handleEditModal = (id) => {
        setSelectedDept(departments?.data.find((dept) => dept.id === id));
        setOpenEditModal((e) => !e);
    };

    const handleDeleteModal = (id) => {
        setSelectedDept(departments?.data.find((dept) => dept.id === id));
        setOpenDeleteModal((e) => !e);
    }

    return (
        <>
            <AddModal state={openAddModal} onToggle={handleAddModal} />
            <EditModal
                state={openEditModal}
                onToggle={handleEditModal}
                selectedDept={selectedDept}
            />
            <DeleteModal
                state={openDeleteModal}
                onToggle={handleDeleteModal}
                selectedDept={selectedDept} />
            <div className="pb-4 flex items-center justify-end">
                {/* <SearchHeader /> */}
                <AddDepartment onAddClick={handleAddModal} />
            </div>
            <DepartmentTable
                departments={departments?.data}
                onEditClick={handleEditModal}
                onDeleteClick={handleDeleteModal}
            />
            <Pagination data={departments} />
        </>
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

function AddDepartment({ onAddClick }) {
    return (
        <div className="mt-2 sm:flex">
            <div className="flex items-center justify-end">
                <button
                    onClick={onAddClick}
                    className="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button"
                >
                    Add Department
                </button>
            </div>
        </div>
    );
}

function DepartmentTable({ departments, onEditClick, onDeleteClick }) {
    // Headers
    const headers = [
        "Department Name",
        "Designation",
        "Total Faculties",
        "Action",
    ];

    // Columns Data
    const columns = [
        (department) => department.name,
        (department) =>
            department.designations?.map((desig) => (
                <p key={desig.id}>{desig.name}</p>
            )),
        (department) => department.faculties_count,
        (department) => (
            <div className="flex items-center gap-x-4 justify-center">
                <button
                    onClick={() => {
                        onEditClick(department.id);
                    }}
                >
                    <CustomIcon type="edit" />
                </button>

                <button onClick={() => {onDeleteClick(department.id)}}>
                    <CustomIcon type="delete" />
                </button>
            </div>
        ),
    ];

    return (
        <Table
            data={departments}
            headers={headers}
            renderRow={(department) => (
                <TableRow
                    key={department.id}
                    data={department}
                    columns={columns}
                />
            )}
        />
    );
}

function AddModal({ state, onToggle }) {
    const [designationFields, setDesignationFields] = useState([1]);

    const {
        register,
        handleSubmit,
        formState: { errors },
        reset,
    } = useForm();

    function handleDepartmentSubmit(data, e) {
        e.preventDefault();
        router.post(route("admin.config.department.store"), data, {
            onSuccess: () => {
                reset();
                onToggle();
                setDesignationFields([1]);
            },
        });
    }

    function addDesignation() {
        if (designationFields.length < 5) {
            setDesignationFields([
                ...designationFields,
                designationFields.length + 1,
            ]);
        }
    }

    return (
        <Modal state={state} onToggle={onToggle}>
            <div className={"flex flex-col space-y-8 p-4"}>
                <DialogTitle
                    className="flex font-bold text-blue-900 justify-between items-center"
                    as={"div"}
                >
                    <span>Add New Department</span>
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
                                id={"department_name"}
                                label={"Department Name"}
                                register={register}
                                error={errors}
                            />
                            {designationFields.map((designation, index) => (
                                <LabelInput
                                    key={index}
                                    id={`designation[${index}]`}
                                    label={`Designation ${index + 1}`}
                                    register={register}
                                    error={errors}
                                />
                            ))}
                        </form>
                        <div className={"flex items-center justify-center"}>
                            <button onClick={addDesignation}>
                                <FaPlusCircle size={24} />
                            </button>
                        </div>
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

function EditModal({ state, onToggle, selectedDept }) {
    const [designationFields, setDesignationFields] = useState([]);
    const {
        register,
        handleSubmit,
        setValue,
        reset,
        formState: { errors },
    } = useForm();


    useEffect(() => {
        if (selectedDept) {
            setDesignationFields(
                selectedDept?.designations.map((designation) => ({
                    id: designation.id, // Use ID if available
                    name: designation.name,
                })) || []
            );
            setValue("department_name", selectedDept.name);
        }

        return () => {
            setDesignationFields([]); // Reset designation fields
            reset({ department_name: "" }); // Reset form values
        };
    }, [selectedDept]);

    function handleDesignationChange(index, value) {
        const updatedFields = designationFields.map((field, i) =>
            i === index ? { ...field, name: value } : field
        );
        setDesignationFields(updatedFields);
    }

    function addDesignation() {
        if (designationFields.length < 5) {
            setDesignationFields([
                ...designationFields,
                { id: null, name: "" }, // Add a new blank designation
            ]);
        }
    }

    function removeDesignation(index) {
        setDesignationFields(designationFields.filter((_, i) => i !== index));
    }

    function handleDepartmentUpdate(data, e) {
      e.preventDefault();
      const payload = {
          id: selectedDept?.id,
          department_name: data.department_name,
          designations: designationFields,
      };

      router.patch(route('admin.config.department.update', selectedDept?.id), payload)
  }

    return (
        <Modal state={state} onToggle={onToggle}>
            <div className={"flex flex-col space-y-8 p-4"}>
                <DialogTitle
                    className="flex font-bold text-blue-900 justify-between items-center"
                    as={"div"}>
                    <span>Update Department</span>
                    <button
                        onClick={onToggle}
                        className={
                            "text-red-500 hover:text-red-900 hover:scale-125 transition-all duration-200"
                        }>
                        &times;
                    </button>
                </DialogTitle>
                <Description as={"div"}>
                    <div className={"space-y-6"}>
                        <form>

                            <LabelInput
                                id={"department_name"}
                                label={"Department Name"}
                                register={register}
                                error={errors}
                            />

                            {designationFields?.map((desig, index) => (
                                <div
                                    key={index}
                                    className="flex items-center space-x-4 align-middle">
                                    <LabelInput
                                        id={`designation[${index}]`}
                                        label={`Designation ${index + 1}`}
                                        register={register}
                                        error={errors}
                                        value={desig.name}
                                        onChange={(e) =>
                                            handleDesignationChange(
                                                index,
                                                e.target.value
                                            )
                                        }
                                    />
                                    {index === 0 || (
                                        <button
                                        type="button"
                                        onClick={() => removeDesignation(index)}
                                        className="text-xl font-bold text-gray-800 hover:text-red-900 hover:scale-125 transition-all duration-200">
                                        &times;
                                        </button>
                                    )}

                                </div>
                            ))}
                        </form>
                        <div className={"flex items-center justify-center"}>
                            <button onClick={addDesignation}>
                                <FaPlusCircle size={24} />
                            </button>
                        </div>
                        <div className={'flex justify-end'}>
                            <Buttons
                                type={"submit"}
                                onClick={handleSubmit(handleDepartmentUpdate)}>
                                Update
                            </Buttons>
                        </div>
                    </div>
                </Description>
            </div>
        </Modal>
    );
}

function DeleteModal({ state, onToggle, selectedDept }) {
    console.log(selectedDept);



    function handleDelete(){
        router.delete(route('admin.config.department.destroy', selectedDept.id), {
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
                        Are you sure you want to delete this department?
                    </p>
                    <p className={"text-lg text-red-600 text-end"}>
                        *This action is irreversible!
                    </p>
                </div>
                <div className={"flex justify-between px-12 mb-8"}>
                    <button
                        onClick={handleDelete}
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