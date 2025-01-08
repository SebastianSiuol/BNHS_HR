import { useEffect, useState } from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller, useController } from "react-hook-form";


// Compoenents
import CustomDatePicker from "@/Components/CustomDatePicker";
import { NavButton } from "@/Components/MultiStepForm/NavButton";

import { InputLabel } from "@/Components/InputLabel";
import { InputSelect } from "@/Components/InputSelect";
import { LabeledInput } from "@/Components/LabeledInput";

// Hooks and Contexts
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";
import { useFetchToFillDataToSelect } from "@/Hooks/useFetchToFillDataToSelect";

const FORM_DATA_KEY = "fourth_form_local_data";

const companyDetailsDataSchema = z.object({

    department_id: z.string(),
    designation_id: z.string(),
    depart_head: z.string(),
    shift_id: z.string(),
    date_of_joining: z.string(),
    position_id: z.string(),
});

export function CompanyDetailsForm() {
    const {  dispatch, isLoading, getSavedData, prevStep, nextStep, AUTH_API_KEY} = useMultiStepForm();
    const [ departments, setDepartments ] = useState([]);
    const [ positions, setPositions ] = useState([]);
    const [ shifts, setShifts ] = useState([]);
    const [ designations, setDesignations ] = useState([]);
    const { register, formState: { errors }, handleSubmit, watch, control } = useForm(
        {
            resolver: zodResolver(companyDetailsDataSchema),
            defaultValues: getSavedData(FORM_DATA_KEY),
        });

        const { field } = useController({
            control: control,
            name: "date_of_joining"
        });

        // Persistantly Uploads Form Data
        usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

        // Get Departments
        useFetchToFillDataToSelect({ setState: setDepartments, apiKey: AUTH_API_KEY, link: "/api/get-departments" });

        // Get Positions
        useFetchToFillDataToSelect({ setState: setPositions, apiKey: AUTH_API_KEY, link: "/api/get-positions" });

        useFetchToFillDataToSelect({ setState: setShifts, apiKey: AUTH_API_KEY, link: "/api/get-shifts" });


        function capitalizeFirstLetter(text) {

            const word = text?.split(" ").map((word) => word.charAt(0).toUpperCase() + word.slice(1)).join(" ");

            return word;
        };


        useEffect(function(){
            async function getDesignations(){
                const deptId = watch('department_id')
                dispatch({ type: 'IS_LOADING' });
                try{
                    const response = await fetch(`/api/get-designations?department=${deptId}`, {
                        method: "GET",
                        headers: {
                            "x-auth-api-key": AUTH_API_KEY,
                            "content-type": "application/json",
                        },
                    });

                    const data = await response.json();

                    if (data) {
                        setDesignations(data);
                    }

                } catch (err){
                    console.error(err);
                } finally {
                    dispatch({ type: 'FINISHED_LOADING' });
                }
            }
            getDesignations();
        },[watch('department_id')])

    function onFourthFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }
    return (
        <form>
            <div className="grid grid-cols-none lg:grid-cols-2 lg:gap-16">
                <div>
                    <div className={"my-2"}>
                        <InputLabel
                            labelFor={"department_id"}
                            color={"black"}
                            width={"normal"}
                        >
                            Department
                        </InputLabel>

                        <InputSelect id={"department_id"} register={register}>
                            {departments.map((dept) => (
                                <option value={`${dept.id}`} key={dept.id}>
                                    {dept.name}
                                </option>
                            ))}
                        </InputSelect>
                    </div>

                    <div className={"my-2"}>
                        <InputLabel
                            labelFor={"designation_id"}
                            color={"black"}
                            width={"normal"}
                        >
                            Designations
                        </InputLabel>

                        <InputSelect id={"designation_id"} register={register}>
                            {isLoading && (
                                <option selected={true} value={"0"}>
                                    SELECT DEPARTMENT
                                </option>
                            )}
                            {designations.map((desig) => (
                                <option value={`${desig.id}`} key={desig.id}>
                                    {desig.name}
                                </option>
                            ))}
                        </InputSelect>
                    </div>

                    <LabeledInput
                        id={"depart_head"}
                        register={register}
                        label={"Manager/Department Head"}
                        placeholder={"Manager/Department Head"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />

                    <div className={"my-2"}>
                        <InputLabel
                            labelFor={"shift_id"}
                            color={"black"}
                            width={"normal"}
                        >
                            Shifts
                        </InputLabel>

                        <InputSelect id={"shift_id"} register={register}>
                            {shifts.map((shift) => (
                                <option value={`${shift.id}`} key={shift.id}>
                                    {capitalizeFirstLetter(shift.name)}
                                </option>
                            ))}
                        </InputSelect>
                    </div>
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
                                <CustomDatePicker value={field} error={errors} name={"date_of_joining"}
                                />
                            )}
                        />
                    </div>

                    <div className={"my-2"}>
                        <InputLabel
                            labelFor={"position_id"}
                            color={"black"}
                            width={"normal"}
                        >
                            Position
                        </InputLabel>

                        <InputSelect id={"position_id"} register={register}>
                            {positions.map((pos) => (
                                <option value={`${pos.id}`} key={pos.id}>
                                    {capitalizeFirstLetter(pos.title)}
                                </option>
                            ))}
                        </InputSelect>
                    </div>

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
