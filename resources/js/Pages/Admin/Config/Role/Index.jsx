/*
 * Dependencies and Libraries
 */
import { useState, useEffect, useCallback } from "react";
import { useForm } from "react-hook-form";
import { useForm as useInertiaForm } from "@inertiajs/react";
import { usePage, router } from "@inertiajs/react";

/*
 Components
 */
import Pagination from "@/Components/Pagination";
import CustomIcon from "@/Components/CustomIcon";
import Modal from "@/Components/Modal";
import { LabelInput } from "@/Components/LabelInput";
import { Buttons } from "@/Components/Buttons";
import { ContentContainer } from "@/Components/ContentContainer";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

import { useFetchToFillDataToSelect } from "@/Hooks/useFetchToFillDataToSelect";

const AUTH_API_KEY = 'eVS3zvZPUTh4dGr1ok6wuSUlEdxVSj8LDhizEKSvQUG8SbMev6TXNCmKRnOMBOhC';

export default function Index() {
    return (
        <>
            <PageHeaders>Roles</PageHeaders>
            <ContentContainer>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const [roles, setRoles] = useState([]);
    const {
        register,
        handleSubmit,
    } = useForm();

    useFetchToFillDataToSelect({ setState: setRoles, apiKey: AUTH_API_KEY, link: "/api/roles" });

    function rolesUpdate(data, e){
      e.preventDefault();
      console.log();
    }

    return (
        <>
            <div className="mb-6 relative">
                <h3 className="text-lg font-medium text-gray-700 mb-4">Select User Roles:</h3>

                {/* {roleError && <p className="text-red-600 italic font-bold absolute top-0 right-0">{roleError}</p>} */}

                <div className="ml-5">
                    <div className="mb-4">
                        <p className="font-semibold">Student Information System</p>
                        <div className="ml-4 flex flex-col">
                            {roles
                                .filter((role) => role.type === "sis")
                                .map((role) => (
                                    <label>
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
                        <p className="font-semibold">Human Resources Management System</p>
                        <div className="ml-4 flex flex-col">
                            {roles
                                .filter((role) => role.type === "hr")
                                .map((role) => (
                                    <label>
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
                            {roles
                                .filter((role) => role.type === "logi")
                                .map((role) => (
                                    <label>
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
            <div className={"flex justify-between mt-16"}>
                <Buttons
                    type={"submit"}
                    onClick={handleSubmit(rolesUpdate)}>
                    Save
                </Buttons>
            </div>
        </>
    );
}