import { useEffect, useState, useRef } from "react";
import { z } from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";

import { NavButton } from "@/Components/MultiStepForm/NavButton";
import { LabeledInput } from "@/Components/LabeledInput";
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const FORM_DATA_KEY = "third_form_local_data";

const emailDataSchema = z.object({
    email: z
        .string()
        .min(4, { message: "Required" })
        .email({ message: "Must be a valid email!" })
});

export function AccountLoginForm({ }) {
    const { getSavedData, prevStep, nextStep, AUTH_API_KEY  } = useMultiStepForm();
    const [ accessable, setAccessable ] = useState(false);
    const debounceTimeout = useRef(null);

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
        setError,
        clearErrors,
    } = useForm({
        resolver: zodResolver(emailDataSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    // Persistantly Uploads Form Data
    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    useEffect(
        function () {
            if (debounceTimeout.current) {
                clearTimeout(debounceTimeout.current);
            }

            const email = watch("email");
            if (email) {
                debounceTimeout.current = setTimeout(() => {
                    async function checkEmailExists() {
                        try {
                            const response = await fetch(
                                `/api/admin/faculty/create/check-email?email=${email}`,
                                {
                                    method: "GET",
                                    headers: {
                                        "x-auth-api-key": AUTH_API_KEY,
                                        "content-type": "application/json",
                                    },
                                }
                            );

                            const { doesEmailExists } = await response.json();

                            if (doesEmailExists) {
                                setError("email", {
                                    type: "unique",
                                    message: "Email already exists!",
                                });
                                setAccessable(false);
                            } else {
                                clearErrors();
                                setAccessable(true);
                            }
                        } catch (error) {
                            console.error("Error checking email:", error);
                        }
                    }
                    checkEmailExists();
                }, 500);
            }

            return () => clearTimeout(debounceTimeout.current);
        },
        [watch("email")]
    );


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
                {accessable && (<NavButton type={'next'} onClick={handleSubmit(onThirdFormSubmit)} disabled={!accessable}>
                    Next: Company Details
                </NavButton>)}
            </div>
        </form>
    );
}
