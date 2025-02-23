// Libraries and Dependencies
import { useEffect, useState } from "react";
import { usePage, router } from "@inertiajs/react";
import { useForm } from "react-hook-form";

// Structural Components
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { ContentHeader } from "@/Components/ContentHeader.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

import RolesOptionsFields from "@/Components/RolesOptionsFields";

// State Components
import { NavButton } from "@/Components/MultiStepForm/NavButton";

export default function Roles() {
    return (
        <>
            <PageHeaders>Edit Faculty Account</PageHeaders>
            <ContentContainer>
                <ContentHeader>Roles</ContentHeader>

                <RolesForm />
            </ContentContainer>
        </>
    );
}

function RolesForm() {
    const { selectedFaculty, rolesOptions } = usePage().props;
    const { roles } = selectedFaculty;
    const { roles_id } = roles;

    const { register, handleSubmit, setValue, getValues, watch } = useForm({
        defaultValues: { roles_id: [] },
    });

    const [roleError, setRoleError] = useState("");

    useEffect(
        function () {
            if (rolesOptions.length > 0) {
                setValue(
                    "roles_id",
                    roles_id.map((id) => id)
                );
            }
        },
        [rolesOptions, roles, setValue]
    );

    function onFormUpdate(data, e) {

        if (getValues("roles_id") === undefined || getValues("roles_id").length === 0) {
            setRoleError("Please select a role!");
            return;
        } else {
            setRoleError("");
            router.put(
                route("admin.faculty.update.roles", selectedFaculty?.public_id),
                data
            );
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

            <div className={"flex justify-end mt-16"}>
                <NavButton
                    type={"submit"}
                    onClick={handleSubmit(onFormUpdate)}>
                    Update
                </NavButton>
            </div>
        </>
    );
}
