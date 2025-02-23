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
    const { rolesOptions } = usePage().props
    const { getSavedData, prevStep, nextStep, } = useMultiStepForm();
    const [roleError, setRoleError] = useState('');
    const {
        register,
        handleSubmit,
        watch,
        getValues,
    } = useForm({
        defaultValues: getSavedData(FORM_DATA_KEY) ?? [],
    });

    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    function rolesFormSubmit(data) {

        if(getValues("roles_id") === undefined || getValues("roles_id").length === 0){
            setRoleError((roleError) => "Please select a role!");
            return;
        } else {
            setRoleError((roleError) => "");
            nextStep();
        }

    }

    return (
        <>
            <RolesOptionsFields
                register={register}
                rolesOptions={rolesOptions}
                roleError={roleError}
            />

            <div className={"flex justify-between mt-16"}>
                <NavButton type={"prev"} onClick={prevStep}>
                    Back
                </NavButton>
                <NavButton type={"next"} onClick={handleSubmit(rolesFormSubmit)}>
                    Next: Documents
                </NavButton>
            </div>
        </>
    );
}
