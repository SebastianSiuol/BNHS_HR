/*
 * Dependencies and Libraries
 */
import { useState, useEffect } from "react";
import { useForm } from "react-hook-form";
import { usePage, router } from "@inertiajs/react";

/*
 Components
 */
import { Buttons } from "@/Components/Buttons";
import { ContentContainer } from "@/Components/ContentContainer";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { FacultyAutoComplete } from "@/Components/FacultyAutoComplete";

import { useFetchToFillDataToSelect } from "@/Hooks/useFetchToFillDataToSelect";




const roleTypes = [
    { type: "sis", label: "Student Information System" },
    { type: "hr", label: "Human Resources Management System" },
    { type: "logi", label: "Logistics System" },
];

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
    const [selectedFaculty, setSelectedFaculty] = useState({});

    const {
        register,
        handleSubmit,
        setValue,
        formState: { errors },
    } = useForm();

    useFetchToFillDataToSelect({ setState: setRoles, apiKey: import.meta.env.VITE_AUTH_API_KEY, link: "/api/roles" });

    useEffect(() => {
        setValue('roles_id', selectedFaculty?.roles?.map((role)=>role.id.toString()));

    }, [selectedFaculty])


    function rolesUpdate(data, e) {
        e.preventDefault();
        if (Object.keys(selectedFaculty || {}).length !== 0) {
            router.patch(route('admin.config.role.update', selectedFaculty?.id), data)
        }
    }

    return (
        <>
            <>
                <form className="relative ">
                    <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                        <span>Search Faculty</span>
                        <FacultyAutoComplete
                            selected={selectedFaculty}
                            setSelected={setSelectedFaculty}
                        />
                    </label>

                    {/* {roleError && <p className="text-red-600 italic font-bold absolute top-0 right-0">{roleError}</p>} */}

                    <div>
                        <span>
                            Selected Faculty:{" "}
                            {(Object.keys(selectedFaculty || {}).length !== 0)
                                ? `[${selectedFaculty?.faculty_code}] ${selectedFaculty?.personal_information?.first_name} ${selectedFaculty?.personal_information?.last_name}`
                                : "N/A"}
                        </span>
                    </div>

                    <div className="my-3 ml-5">
                        {roleTypes.map(({ type, label }) => (
                            <RoleCheckboxGroup
                                key={type}
                                roles={roles}
                                type={type}
                                label={label}
                                register={register}
                            />
                        ))}
                    </div>
                    <div className={"flex justify-between mt-16"}>
                        <Buttons
                            type={"submit"}
                            onClick={handleSubmit(rolesUpdate)}>
                            Save
                        </Buttons>
                    </div>
                </form>
            </>
        </>
    );
}



function RoleCheckboxGroup({ roles, type, label, register }) {
    return (
      <div className="mb-4">
        <p className="font-semibold">{label}</p>
        <div className="ml-4 flex flex-col">
          {roles.filter((role) => role.type === type).map((role) => (
            <label key={role.id}>
              <input type="checkbox" value={role.id} {...register("roles_id")} />
              {" "}{role.description}
            </label>
          ))}
        </div>
      </div>
    );
  }