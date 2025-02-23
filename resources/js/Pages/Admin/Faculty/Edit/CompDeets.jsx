// Libraries and Dependencies
import { useEffect, useState } from "react";
import { usePage, router } from "@inertiajs/react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller, useController } from "react-hook-form";

// Edit Multistep Form Context, Provider, and Hooks

import { capitalizeFirstLetter } from "@/Utils/stringUtils";
import { getFullName } from "@/Utils/formatTableDataUtils";

// Schemas
import { companyDetailsDataSchema } from "@/Schemas/MultistepFormSchema";

// Structural Components
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { ContentHeader } from "@/Components/ContentHeader.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

// State Components
import { NavButton } from "@/Components/MultiStepForm/NavButton";
import { InputSelect } from "@/Components/InputSelect";

export default function CompDeets() {
    return (
        <>
            <PageHeaders>Edit Faculty Account</PageHeaders>
            <ContentContainer>
                <ContentHeader>Company Details</ContentHeader>
                <CompanyDetailsForm />
            </ContentContainer>
        </>
    );
}

export function CompanyDetailsForm() {
    const { selectedFaculty, departments, positions, shifts } = usePage().props;
    const [designations, setDesignations] = useState([]);
    const [departmentHeads, setDepartmentHeads] = useState([]);

    const [allFetchErrors, setAllFetchErrors] = useState([]);
    const [allFetchLoading, setAllFetchLoading] = useState([]);

    const {
        register,
        handleSubmit,
        watch,
        setValue,
        formState: { errors },
        setError,
        clearErrors,
    } = useForm({
        resolver: zodResolver(companyDetailsDataSchema),
        defaultValues: selectedFaculty,
    });

    const selectedDept = parseInt(watch("department_id"));

    useEffect(() => {
        if (selectedDept) {
            const chosenDept = departments.find(
                (dept) => dept.id === selectedDept
            );
            setDesignations(chosenDept?.designations || []);
        } else {
            setDesignations([]);
        }
    }, [selectedDept]);

    useEffect(() => {
        const savedDesignationId = selectedFaculty?.designation_id;
        if (savedDesignationId && designations.length > 0) {
            const isValidDesignation = designations.some(
                (desig) => desig.id === parseInt(savedDesignationId)
            );

            if (isValidDesignation) {
                setValue("designation_id", savedDesignationId);
            }
        }
    }, [designations]);

    useEffect(
        function () {
            async function getDepartmentHeads() {
                setAllFetchLoading((allLoadings) => ({
                    ...allLoadings,
                    department_head: true,
                }));

                try {
                    const response = await fetch(
                        route("api.get.head", selectedDept),
                        {
                            method: "GET",
                            headers: {
                                "content-type": "application/json",
                            },
                        }
                    );

                    const data = await response.json();

                    if (!response.ok) {
                        setDepartmentHeads([]);
                        setAllFetchErrors((prevErrors) => ({
                            ...prevErrors,
                            department_head: data.message,
                        }));
                    } else {
                        if (data) {
                            setDepartmentHeads(data);
                            setAllFetchErrors((prevErrors) => ({
                                ...prevErrors,
                                department_head: null,
                            }));
                            clearErrors("department_head");
                        }
                    }
                } catch (err) {
                    console.error(err);
                } finally {
                    setAllFetchLoading((allLoadings) => ({
                        ...allLoadings,
                        department_head: false,
                    }));
                }
            }
            getDepartmentHeads();
        },
        [selectedDept]
    );

    useEffect(() => {
        const allFetchesCompleted = Object.values(allFetchLoading).every(
            (loading) => !loading
        );

        if (allFetchesCompleted) {
            if (allFetchErrors["department_head"]) {
                setError("department_head", {
                    type: "custom",
                    message: "No Department Head found in Department!",
                });
            }
        }
    }, [allFetchLoading, setValue]);

    function onFormUpdate(data, e) {
        router.put(
            route(
                "admin.faculty.update.comp-deets",
                selectedFaculty?.public_id
            ),
            data
        );
    }
    return (
        <form>
            <div className="grid grid-cols-none lg:grid-cols-2 lg:gap-16">
                <div>
                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Department</span>
                        <InputSelect
                            id={"department_id"}
                            register={register}
                            error={errors}>
                            <option value={"0"}>Select Department</option>
                            {departments.map((dept) => (
                                <option
                                    value={`${dept.id}`}
                                    key={dept.id}>
                                    {dept.name}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Designations</span>
                        <InputSelect
                            id={"designation_id"}
                            register={register}
                            error={errors}>
                            <option value={"0"}>Select Department First</option>
                            {designations.map((desig) => (
                                <option
                                    value={`${desig.id}`}
                                    key={desig.id}>
                                    {desig.name}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Manager/Department Head</span>
                        <InputSelect
                            id={"department_head"}
                            register={register}
                            error={errors}>
                            <option value={"blank"}>No Head</option>
                            {departmentHeads.map((deptHead) => (
                                <option
                                    value={`${deptHead.id}`}
                                    key={deptHead.id}>
                                    {getFullName(deptHead)
                                        ? `[${
                                              deptHead.faculty_code
                                          }] ${getFullName(deptHead)}`
                                        : null}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Shift</span>
                        <InputSelect
                            id={"shift_id"}
                            register={register}
                            error={errors}>
                            <option value={"0"}>Select Shift</option>
                            {shifts.map((shift) => (
                                <option
                                    value={`${shift.id}`}
                                    key={shift.id}>
                                    {capitalizeFirstLetter(shift.name)}
                                </option>
                            ))}
                        </InputSelect>
                    </label>
                </div>
                <div>
                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Position</span>
                        <InputSelect
                            id={"position_id"}
                            register={register}
                            error={errors}>
                            <option value={"0"}>Select Position</option>
                            {positions.map((pos) => (
                                <option
                                    value={`${pos.id}`}
                                    key={pos.id}
                                    disabled={pos.isFull}>
                                    <span className="font-bold">{`${capitalizeFirstLetter(
                                        pos.title
                                    )}`}</span>
                                    <span>{` | `}</span>
                                    <span>{`Slot Left:${pos.allotmentLeft}`}</span>
                                </option>
                            ))}
                        </InputSelect>
                    </label>
                </div>
            </div>
            <div className={"flex justify-end mt-16"}>
                <NavButton
                    type={"submit"}
                    onClick={handleSubmit(onFormUpdate)}>
                    Update
                </NavButton>
            </div>
        </form>
    );
}
