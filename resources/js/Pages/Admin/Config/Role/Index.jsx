/*
 * Dependencies and Libraries
 */
import { useState, useEffect } from "react";
import { useForm } from "react-hook-form";
import { usePage, router, Head } from "@inertiajs/react";

/*
 Components
 */
import { Buttons } from "@/Components/Buttons";
import { ContentContainer } from "@/Components/ContentContainer";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";
import { FacultyAutoComplete } from "@/Components/FacultyAutoComplete";
import RolesOptionsFields from "@/Components/RolesOptionsFields";

export default function Index() {
    return (
        <>
            <Head title={'Roles Configuration'}/>
            <PageHeaders>Roles</PageHeaders>
            <ContentContainer>
                <HandlePage />
            </ContentContainer>
        </>
    );
}

function HandlePage() {
    const { rolesOptions } = usePage().props;
    const [selectedFaculty, setSelectedFaculty] = useState({});
    const [roleError, setRoleError] = useState("");

    const { register, handleSubmit, setValue, watch, getValues } = useForm({
        defaultValues: { roles_id: [] },
    });

    useEffect(() => {
        setValue(
            "roles_id",
            selectedFaculty?.roles?.map((role) => role.id.toString())
        );
    }, [selectedFaculty]);

    function rolesUpdate(data, e) {
        e.preventDefault();
        if (getValues("roles_id") === undefined || getValues("roles_id").length === 0) {
            setRoleError("Please select a role!");
            return;
        } else {
            setRoleError("");
            if (Object.keys(selectedFaculty || {}).length !== 0) {
                router.patch(
                    route("admin.config.role.update", selectedFaculty?.id),
                    data
                );
            }
        }
    }

    return (
        <>
            <>
                <form className="relative ">
                    <label
                        className={
                            "flex flex-col my-2 text-sm space-y-2 text-black font-normal"
                        }>
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
                            {Object.keys(selectedFaculty || {}).length !== 0
                                ? `[${selectedFaculty?.faculty_code}] ${selectedFaculty?.personal_information?.first_name} ${selectedFaculty?.personal_information?.last_name}`
                                : "N/A"}
                        </span>
                    </div>

                    <RolesOptionsFields
                        register={register}
                        rolesOptions={rolesOptions}
                        roleError={roleError}
                    />

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