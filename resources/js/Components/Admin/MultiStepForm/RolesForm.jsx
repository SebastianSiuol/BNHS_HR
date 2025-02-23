import { useEffect, useState } from "react";
import { useForm, Controller, useController } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";

// Compoenents
import { NavButton } from "@/Components/MultiStepForm/NavButton";
import RolesOptionsFields from "@/Components/RolesOptionsFields";

// Hooks and Contexts
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";

const FORM_DATA_KEY = "fifth_form_local_data";

export function RolesForm() {
    const { rolesOptions } = usePage().props;
    const { getSavedData, prevStep, nextStep } = useMultiStepForm();
    const [roleError, setRoleError] = useState("");

    const { register, watch, getValues, setValue } = useForm({
        defaultValues: getSavedData(FORM_DATA_KEY) || [],
    });

    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    useEffect(() => {
        const savedData = getSavedData(FORM_DATA_KEY);
        setValue("roles_id", savedData?.roles_id || []);
    }, [getSavedData, setValue]);;


    function rolesFormSubmit() {
        if (
            getValues("roles_id") === undefined ||
            getValues("roles_id").length === 0
        ) {
            setRoleError("Please select a role!");
            return;
        } else {
            setRoleError("");
            nextStep();
        }
    }

    return (
        <>
            <RolesOptionsFields
                register={register}
                rolesOptions={rolesOptions}
                roleError={roleError}
                setValue={setValue}
                watch={watch}
            />

            <div className={"flex justify-between mt-16"}>
                <NavButton
                    type={"prev"}
                    onClick={prevStep}>
                    Back
                </NavButton>
                <NavButton
                    type={"next"}
                    onClick={rolesFormSubmit}>
                    Next: Documents
                </NavButton>
            </div>
        </>
    );
}
