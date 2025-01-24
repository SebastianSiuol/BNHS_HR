import { useEffect, useState } from "react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller, useController } from "react-hook-form";
import { usePage } from "@inertiajs/react";

// Compoenents
import CustomDatePicker from "@/Components/CustomDatePicker";
import { NavButton } from "@/Components/MultiStepForm/NavButton";

import { InputLabel } from "@/Components/InputLabel";
import { InputSelect } from "@/Components/InputSelect";

// Hooks and Contexts
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";
import { capitalizeFirstLetter } from "@/Utils/stringUtils";
import { getFullName } from '@/Utils/formatTableDataUtils';
import { companyDetailsDataSchema } from '@/Schemas/MultistepFormSchema';

const FORM_DATA_KEY = "fourth_form_local_data";

export function CompanyDetailsForm() {
    const {
        getSavedData,
        prevStep,
        nextStep,
    } = useMultiStepForm();

    const { departments, positions, shifts } = usePage().props;
    const [designations, setDesignations] = useState([]);
    const [departmentHeads, setDepartmentHeads] = useState([]);

    const [allFetchErrors, setAllFetchErrors] = useState([]);
    const [allFetchLoading, setAllFetchLoading] = useState([]);
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
        defaultValues: savedDataFromLocal,
    });

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

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
        const savedDesignationId = savedDataFromLocal?.designation_id;
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
    )

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