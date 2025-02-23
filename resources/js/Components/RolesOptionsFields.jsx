const roleTypes = [
    { type: "sis", label: "Student Information System" },
    { type: "hr", label: "Human Resources Management System" },
    { type: "logi", label: "Logistics System" },
];

export default function RolesOptionsFields({
    register,
    rolesOptions,
    roleError = null,
}) {
    return (
        <>
            <div className="mb-6 relative">
                {/* <h3 className="text-lg font-medium text-gray-700 mb-4">
                    Select User Roles:
                </h3> */}

                {roleError && (
                    <p className="text-red-600 italic font-bold absolute top-0 right-0">
                        {roleError}
                    </p>
                )}

                <div className="ml-5">
                    {roleTypes.map(({ type, label }) => (
                        <RoleCheckboxGroup
                            key={type}
                            roles={rolesOptions}
                            type={type}
                            label={label}
                            register={register}
                        />
                    ))}
                </div>
            </div>
        </>
    );
}

function RoleCheckboxGroup({ roles, type, label, register }) {
    return (
        <div className="mb-4">
            <p className="font-semibold">{label}</p>
            <div className="ml-4 flex flex-col">
                {roles
                    .filter((role) => role.type === type)
                    .map((role) => (
                        <label key={role.id}>
                            <input
                                type="checkbox"
                                value={role.id}
                                {...register("roles_id")}
                            />{" "}
                            {role.description}
                        </label>
                    ))}
            </div>
        </div>
    );
}
