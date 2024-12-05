import React from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { NavButton } from "@/Pages/Admin/Faculty/Create"
import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const FORM_DATA_KEY = "fourth_form_local_data";

const companyDetailsDataSchema = z.object({
    faculty_code: z.string().min(4, { message: "Required" }),
    designation: z.string(),
    depart_head: z.string(),
    shift: z.string(),
    department: z.string(),
    date_of_joining: z.string(),
    position: z.string(),
    roles: z.string(),
});
export function CompanyDetailsForm() {
    const { getSavedData, prevStep, nextStep } = useMultiStepForm();

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
    } = useForm({
        resolver: zodResolver(companyDetailsDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onFourthFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }
    return (
        <form>
            <div className="grid grid-cols-none lg:grid-cols-2 gap-16">
                <div>
                    <LabeledInput
                        id={"faculty_code"}
                        register={register}
                        label={"Faculty Code"}
                        placeholder={"Faculty Code"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"designation"}
                        register={register}
                        label={"Designation"}
                        placeholder={"Designation"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />

                    <LabeledInput
                        id={"depart_head"}
                        register={register}
                        label={"Manager/Department Head"}
                        placeholder={"Manager/Department Head"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />

                    <LabeledInput
                        id={"shift"}
                        register={register}
                        label={"Shift"}
                        placeholder={"Shift"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                </div>
                <div>
                    <LabeledInput
                        id={"department"}
                        register={register}
                        label={"Department"}
                        placeholder={"Department"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"date_of_joining"}
                        register={register}
                        label={"Date of Joining"}
                        placeholder={"Date of Joining"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"position"}
                        register={register}
                        label={"Position"}
                        placeholder={"Position"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                    <LabeledInput
                        id={"roles"}
                        register={register}
                        label={"Roles"}
                        placeholder={"Roles"}
                        color={"black"}
                        width={"normal"}
                        error={errors}
                    />
                </div>
            </div>
            <div className={"flex justify-between mt-16"}>
                <NavButton type={'prev'} onClick={prevStep}>
                    Back
                </NavButton>
                <NavButton type={'next'} onClick={handleSubmit(onFourthFormSubmit)}>
                    Next: Documents
                </NavButton>
            </div>
        </form>
    );
}
