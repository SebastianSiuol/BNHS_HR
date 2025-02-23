// Libraries and Dependencies
import { useEffect, useState } from "react";
import { usePage, router } from "@inertiajs/react";
import { useForm, Controller, useController } from "react-hook-form";

// Structural Components
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { ContentHeader } from "@/Components/ContentHeader.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

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
    const { selectedFaculty, rolesOption } = usePage().props;
    const { roles } = selectedFaculty;
    const { roles_id } = roles;

    const {
        register,
        handleSubmit,
        setValue,
        formState: { errors },
    } = useForm({
        defaultValues: { roles_id: [] },
    });

    const [roleError, setRoleError] = useState("");

    useEffect(
        function () {
            if (rolesOption.length > 0) {
                setValue(
                    "roles_id",
                    roles_id.map((id) => id.toString())
                );
            }
        },
        [rolesOption, roles, setValue]
    );

    function onFormUpdate(data,e) {
      router.put(route('admin.faculty.update.roles', selectedFaculty?.public_id), data);
    }

    return (
        <>
            <div className="mb-6 relative">
                <h3 className="text-lg font-medium text-gray-700 mb-4">
                    Select User Roles:
                </h3>

                {roleError && (
                    <p className="text-red-600 italic font-bold absolute top-0 right-0">
                        {roleError}
                    </p>
                )}

                <div className="ml-5">
                    <div className="mb-4">
                        <p className="font-semibold">
                            Student Information System
                        </p>
                        <div className="ml-4 flex flex-col">
                            {rolesOption
                                .filter((role) => role.type === "sis")
                                .map((role) => (
                                    <label key={role.id}>
                                        <input
                                            type="checkbox"
                                            value={role.id}
                                            {...register("roles_id")}
                                        />{" "}
                                        {`${role.description}`}
                                    </label>
                                ))}
                        </div>
                    </div>

                    <div className="mb-4">
                        <p className="font-semibold">
                            Human Resources Management System
                        </p>
                        <div className="ml-4 flex flex-col">
                            {rolesOption
                                .filter((role) => role.type === "hr")
                                .map((role) => (
                                    <label key={role.id}>
                                        <input
                                            type="checkbox"
                                            value={role.id}
                                            {...register("roles_id")}
                                        />{" "}
                                        {`${role.description}`}
                                    </label>
                                ))}
                        </div>
                    </div>

                    <div className="mb-4">
                        <p className="font-semibold">Logistics System</p>
                        <div className="ml-4 flex flex-col">
                            {rolesOption
                                .filter((role) => role.type === "logi")
                                .map((role) => (
                                    <label key={role.id}>
                                        <input
                                            type="checkbox"
                                            value={role.id}
                                            {...register("roles_id")}
                                        />{" "}
                                        {`${role.description}`}
                                    </label>
                                ))}
                        </div>
                    </div>
                </div>
            </div>
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
