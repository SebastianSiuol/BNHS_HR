import { useEffect, useState } from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller, useController } from "react-hook-form";

// Compoenents
import CustomDatePicker from "@/Components/CustomDatePicker";
import { NavButton } from "@/Components/MultiStepForm/NavButton";

import { InputLabel } from "@/Components/InputLabel";
import { InputSelect } from "@/Components/InputSelect";

// Hooks and Contexts
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";
import { useFetchforCompanyDetails } from "@/Hooks/useFetchforCompanyDetails";
import { capitalizeFirstLetter } from "@/Utils/stringUtils";
import { getFullName } from '@/Utils/formatTableDataUtils';
import { companyDetailsDataSchema } from '@/Schemas/MultistepFormSchema';

const FORM_DATA_KEY = "fourth_form_local_data";

// const companyDetailsDataSchema = z.object({
//     department_id: z.any().optional(),
//     designation_id: z.any().optional(),
//     department_head: z.any().optional(),
//     shift_id: z.any().optional(),
//     date_of_joining: z.coerce.date(),
//     position_id: z.any().optional(),
// });

export function CompanyDetailsForm() {
    const {
        getSavedData,
        prevStep,
        nextStep,
    } = useMultiStepForm();

    const [departments, setDepartments] = useState([]);
    const [positions, setPositions] = useState([]);
    const [shifts, setShifts] = useState([]);
    const [departmentHeads, setDepartmentHeads] = useState([]);

    const [allFetchErrors, setAllFetchErrors] = useState([]);
    const [allFetchLoading, setAllFetchLoading] = useState([]);

    const [designations, setDesignations] = useState([]);

    const savedDataFromLocal = getSavedData(FORM_DATA_KEY);

    const {
        register,
        handleSubmit,
        watch,
        control,
        setValue,
        formState: { errors },
        setError,
        clearErrors,
    } = useForm({
        resolver: zodResolver(companyDetailsDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function handleSetError(key, error) {
        setAllFetchErrors((prevErrors) => ({
            ...prevErrors,
            [key]: error,
        }));
    }

    function handleSetLoading(key, value) {
        setAllFetchLoading((allLoadings) => ({
            ...allLoadings,
            [key]: value,
        }));
    }

    useFetchforCompanyDetails({
        setState: setDepartments,
        setLoading: (value) => handleSetLoading("departments", value),
        setError: (error) => handleSetError("departments", error),
        link: route("api.get.departments"),
    });

    useFetchforCompanyDetails({
        setState: setPositions,
        setLoading: (value) => handleSetLoading("positions", value),
        setError: (error) => handleSetError("positions", error),
        link: route("api.get.positions"),
    });

    useFetchforCompanyDetails({
        setState: setShifts,
        setLoading: (value) => handleSetLoading("shifts", value),
        setError: (error) => handleSetError("shifts", error),
        link: route("api.get.shifts"),
    });

    useEffect(
        function () {
            async function getDesignations() {
                setAllFetchLoading((allLoadings) => ({
                    ...allLoadings,
                    designations: true,
                }));

                try {
                    const response = await fetch(
                        route("api.get.designations", watch("department_id")),
                        {
                            method: "GET",
                            headers: {
                                "content-type": "application/json",
                            },
                        }
                    );

                    if (!response.ok) {
                        setAllFetchErrors((prevErrors) => ({
                            ...prevErrors,
                            designations: "Something happened!",
                        }));
                    }

                    const data = await response.json();

                    if (data) {
                        setDesignations(data);
                        setAllFetchErrors((prevErrors) => ({
                            ...prevErrors,
                            designations: null,
                        }))
                    }
                } catch (err) {
                    console.error(err);
                } finally {
                    setAllFetchLoading((allLoadings) => ({
                        ...allLoadings,
                        designations: false,
                    }));
                }
            }
            getDesignations();
        },
        [watch("department_id")]
    );


    useEffect(
        function () {
            async function getDepartmentHeads() {
                setAllFetchLoading((allLoadings) => ({
                    ...allLoadings,
                    department_head: true,
                }));

                try {
                    const response = await fetch(
                        route("api.get.head", watch("department_id")),
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
        [watch("department_id")]
    )

    useEffect(() => {
        const allFetchesCompleted = Object.values(allFetchLoading).every(
            (loading) => !loading
        );

        if (allFetchesCompleted) {
            setValue("department_id", savedDataFromLocal?.department_id ?? "0");
            setValue("position_id", savedDataFromLocal?.position_id ?? "0");
            setValue("shift_id", savedDataFromLocal?.shift_id ?? "0");
            setValue(
                "designation_id",
                savedDataFromLocal?.designation_id ?? "0"
            );

            console.log(errors);

            // Set "N/A" for fields that encountered errors
            if (allFetchErrors["departments"]) {
                setValue("department_id", "N/A");
            }
            if (allFetchErrors["positions"]) {
                setValue("position_id", "N/A");
            }
            if (allFetchErrors["shifts"]) {
                setValue("shift_id", "N/A");
            }
            if (allFetchErrors["designations"]) {
                setValue("designation_id", "N/A");
            }
            if (allFetchErrors["department_head"]) {
                setError("department_head", {type: "custom", message: "No Department Head found in Department!"});
            }
        }
    }, [allFetchLoading, setValue]);

    function onFourthFormSubmit(e) {
        e.preventDefault;
        console.log(errors);
        nextStep();
    }
    return (
        <form>
            <div className="grid grid-cols-none lg:grid-cols-2 lg:gap-16">
                <div>
                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Department</span>
                        <InputSelect id={"department_id"} register={register} error={errors}>
                            <option value={"0"}>Select Department</option>
                            {departments.map((dept) => (
                                <option value={`${dept.id}`} key={dept.id}>
                                    {dept.name}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Designations</span>
                        <InputSelect id={"designation_id"} register={register} error={errors}>
                            <option value={"0"}>Select Department First</option>
                            {designations.map((desig) => (
                                <option value={`${desig.id}`} key={desig.id}>
                                    {desig.name}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Manager/Department Head</span>
                        <InputSelect id={"department_head"} register={register} error={errors}>
                        <option value={'blank'}>No Head</option>
                            {departmentHeads.map((deptHead) => (
                                <option value={`${deptHead.id}`} key={deptHead.id}>
                                    {getFullName(deptHead) ?? 'null'}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Shift</span>
                        <InputSelect id={"shift_id"} register={register} error={errors}>
                            <option value={"0"}>Select Shift</option>
                            {shifts.map((shift) => (
                                <option value={`${shift.id}`} key={shift.id}>
                                    {capitalizeFirstLetter(shift.name)}
                                </option>
                            ))}
                        </InputSelect>
                    </label>
                </div>
                <div>
                    <div className={"flex flex-col lg:my-2"}>
                        <InputLabel
                            labelFor={"date_of_joining"}
                            color={"black"}
                            width={"normal"}
                        >
                            Date of Joining
                        </InputLabel>

                        <Controller
                            control={control}
                            name={"date_of_joining"}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name={"date_of_joining"}
                                />
                            )}
                        />
                    </div>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Position</span>
                        <InputSelect id={"position_id"} register={register} error={errors}>
                            <option value={"0"}>Select Position</option>
                            {positions.map((pos) => (
                                <option value={`${pos.id}`} key={pos.id}>
                                    {capitalizeFirstLetter(pos.title)}
                                </option>
                            ))}
                        </InputSelect>
                    </label>
                </div>
            </div>
            <div className={"flex justify-between mt-16"}>
                <NavButton type={"prev"} onClick={prevStep}>
                    Back
                </NavButton>
                <NavButton
                    type={"next"}
                    onClick={handleSubmit(onFourthFormSubmit)}
                >
                    Next: Assigning Roles
                </NavButton>
            </div>
        </form>
    );
}
