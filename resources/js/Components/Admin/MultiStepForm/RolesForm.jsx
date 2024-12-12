import { useEffect, useState } from "react";
import { useForm, Controller, useController } from "react-hook-form";

// Compoenents
import { NavButton } from "@/Components/MultiStepForm/NavButton";


// Hooks and Contexts
import { useMultiStepForm } from "@/Context/MultiStepFormContext";
import { usePersistsData } from "@/Hooks/usePersistsData";
import { useFetchToFillDataToSelect } from "@/Hooks/useFetchToFillDataToSelect";

const FORM_DATA_KEY = "fifth_form_local_data";

// const rolesFormSchema = z.object({
//     role_id : z.array()
// });

export function RolesForm() {
    const { dispatch, isLoading, getSavedData, prevStep, nextStep, AUTH_API_KEY } = useMultiStepForm();
    const [roles, setRoles] = useState([]);
    const [roleError, setRoleError] = useState('');
    const {
        register,
        handleSubmit,
        watch,
        getValues,
    } = useForm({
        // resolver: zodResolver(rolesFormSchema),
        defaultValues: getSavedData(FORM_DATA_KEY),
    });

    usePersistsData({ localStorageKey: FORM_DATA_KEY, value: watch() });

    useFetchToFillDataToSelect({ setState: setRoles, apiKey: AUTH_API_KEY, link: "/api/roles" });

    function rolesFormSubmit(data) {

        if(getValues('roles_id').length === 0){
            setRoleError((roleError) => "Please select a role!");
            return;
        } else {
            setRoleError((roleError) => "");
            nextStep();
        }

    }

    return (
        <>
            <div className="mb-6 relative">
                <h3 className="text-lg font-medium text-gray-700 mb-4">Select User Roles:</h3>

                {roleError && <p className="text-red-600 italic font-bold absolute top-0 right-0">{roleError}</p>}

                <div className="ml-5">
                    <div className="mb-4">
                        <p className="font-semibold">Student Information System</p>
                        <div className="ml-4 flex flex-col">
                            {roles
                                .filter((role) => role.type === "sis")
                                .map((role) => (
                                    <label>
                                        <input type="checkbox" value={role.id} {...register("roles_id")} /> {`${role.description}`}
                                    </label>
                                ))}
                        </div>
                    </div>

                    <div className="mb-4">
                        <p className="font-semibold">Human Resources Management System</p>
                        <div className="ml-4 flex flex-col">
                            {roles
                                .filter((role) => role.type === "hr")
                                .map((role) => (
                                    <label>
                                        <input type="checkbox" value={role.id} {...register("roles_id")} /> {`${role.description}`}
                                    </label>
                                ))}
                        </div>
                    </div>

                    <div className="mb-4">
                        <p className="font-semibold">Logistics System</p>
                        <div className="ml-4 flex flex-col">
                            {roles
                                .filter((role) => role.type === "logi")
                                .map((role) => (
                                    <label>
                                        <input type="checkbox" value={role.id} {...register("roles_id")} /> {`${role.description}`}
                                    </label>
                                ))}
                        </div>
                    </div>
                </div>
            </div>
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
