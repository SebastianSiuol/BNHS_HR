import React from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const FORM_DATA_KEY = "third_form_local_data";

const addressDataSchema = z.object({
    email: z
        .string()
        .min(4, { message: "Required" })
        .email({ message: "Must be a valid email!" }),
});

export function AccountLoginForm({ prevStep, nextStep }) {
    const { nextForm } = useMultiStepForm();

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: getSavedData(),
    });

    // Initially gets Data
    function getSavedData() {
        let data = localStorage.getItem(FORM_DATA_KEY);
        if (data) {
            try {
                data = JSON.parse(data);
            } catch (err) {
                console.log(err);
            }
            return data;
        }
        return;
    }

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function onThirdFormSubmit(data) {
        nextForm(data);
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
                <button
                    onClick={prevStep}
                    className={
                        "text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    }
                >
                    Back
                </button>
                <button
                    onClick={handleSubmit(onThirdFormSubmit)}
                    className={
                        "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    }
                >
                    Next: Account Login
                </button>
            </div>
        </form>
    );
}
