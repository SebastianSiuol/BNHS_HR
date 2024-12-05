import React from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { NavButton } from "@/Pages/Admin/Faculty/Create"
import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const FORM_DATA_KEY = "third_form_local_data";

const emailDataSchema = z.object({
    email: z
        .string()
        .min(4, { message: "Required" })
        .email({ message: "Must be a valid email!" }),
});

export function AccountLoginForm({ }) {
    const { getSavedData, prevStep, nextStep  } = useMultiStepForm();

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
    } = useForm({
        resolver: zodResolver(emailDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onThirdFormSubmit(e) {
        e.preventDefault;
        nextStep();
    }

    return (
        <form>
            <LabeledInput
                id={"email"}
                register={register}
                label={"Email"}
                placeholder={"Email"}
                color={"black"}
                width={"normal"}
                error={errors}
            />

            <div className={"flex justify-between mt-16"}>
                <NavButton type={'prev'} onClick={prevStep}>
                    Back
                </NavButton>
                <NavButton type={'next'} onClick={handleSubmit(onThirdFormSubmit)}>
                    Next: Company Details
                </NavButton>
            </div>
        </form>
    );
}
