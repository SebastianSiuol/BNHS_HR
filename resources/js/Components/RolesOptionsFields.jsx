const roleTypes = [
    { type: "sis", label: "Student Information System" },
    { type: "hr", label: "Human Resources Management System" },
    { type: "logi", label: "Logistics System" },
];

export default function RolesOptionsFields({
    setValue,
    rolesOptions,
    watch,
    roleError = null,
    register
}) {
    const facultyRoleIds = rolesOptions
        .filter((role) => role.role_name.includes("faculty"))
        .map((role) => role.id);

    const selectedRoles = watch("roles_id", []);

    const facultySelected = selectedRoles.some((id) => facultyRoleIds.includes(id));

    function handleFacultyChange(e) {
        if (e.target.checked) {
            setValue("roles_id", [...new Set([...selectedRoles, ...facultyRoleIds])]);
        } else {
            setValue("roles_id", selectedRoles.filter((id) => !facultyRoleIds.includes(id)));
        }
    }

    function handleRoleChange(e, roleId) {
        if (e.target.checked) {
            setValue("roles_id", [...new Set([...selectedRoles, roleId])]);
        } else {
            setValue("roles_id", selectedRoles.filter((id) => id !== roleId));
        }
    }

    return (
        <div className="mb-6 relative">
            {roleError && (
                <p className="text-red-600 italic font-bold absolute top-0 right-0">
                    {roleError}
                </p>
            )}

            <div className="ml-5">
                {roleTypes.map(({ type, label }) => (
                    <RoleCheckboxGroup
                        key={type}
                        roles={rolesOptions.filter(
                            (role) => role.type === type && !role.role_name.includes("faculty")
                        )}
                        label={label}
                        selectedRoles={selectedRoles}
                        handleRoleChange={handleRoleChange}
                        register={register}
                    />
                ))}

                <div className="mb-4">
                    <p className="font-semibold">General</p>
                    <div className="ml-4 flex flex-col">
                        <label>
                            <input
                                type="checkbox"
                                checked={facultySelected}
                                onChange={handleFacultyChange}
                            />{" "}
                            Faculty
                        </label>
                    </div>
                </div>
            </div>
        </div>
    );
}

function RoleCheckboxGroup({ roles, label, selectedRoles, handleRoleChange }) {
    return (
        <div className="mb-4">
            <p className="font-semibold">{label}</p>
            <div className="ml-4 flex flex-col">
                {roles.map((role) => (
                    <label key={role.id}>
                        <input
                            type="checkbox"
                            value={role.id}
                            checked={selectedRoles.includes(role.id)}
                            onChange={(e) => handleRoleChange(e, role.id)}
                        />{" "}
                        {role.description}
                    </label>
                ))}
            </div>
        </div>
    );
}
