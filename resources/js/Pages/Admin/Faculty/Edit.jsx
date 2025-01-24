// Libraries and Dependencies
import { useEffect, useState } from "react";
import { usePage } from "@inertiajs/react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller, useController } from "react-hook-form";
import dayjs from "dayjs";

// Edit Multistep Form Context, Provider, and Hooks
import { useEditMultiStepForm } from "@/Context/EditMultiStepFormContext";
import { EditMultiStepFormProvider } from "@/Context/EditMultiStepFormContext";
import { useFetchToFillDataToSelect } from "@/Hooks/useFetchToFillDataToSelect";
import { useFetchCompanyDetails } from "@/Hooks/useFetchCompanyDetails";
import { capitalizeFirstLetter } from "@/Utils/stringUtils";
import { getFullName } from '@/Utils/formatTableDataUtils';

// Schemas
import { personalDataSchema } from "@/Schemas/MultistepFormSchema";
import { addressDataSchema } from "@/Schemas/MultistepFormSchema";
import { companyDetailsDataSchema } from "@/Schemas/MultistepFormSchema";
import { emailDataSchema } from "@/Schemas/MultistepFormSchema";

// Structural Components
import { ContentContainer } from "@/Components/ContentContainer.jsx";
import { ContentHeader } from "@/Components/ContentHeader.jsx";
import { PageHeaders } from "@/Components/Admin/PageHeaders.jsx";

// State Components
import { NavStepper } from "@/Components/MultiStepForm/NavStepper";
import { NavButton } from "@/Components/MultiStepForm/NavButton";
import { InputLabel } from "@/Components/InputLabel";
import { InputSelect } from "@/Components/InputSelect";
import { LabeledInput } from "@/Components/LabeledInput";
import { LabelInput } from "@/Components/LabelInput";
import CustomDatePicker from "@/Components/CustomDatePicker";
import { AddressFields } from '@/Components/AddressFields';

export default function Edit() {
    return (
        <>
            <PageHeaders>Edit Faculty Account</PageHeaders>
            <EditMultiStepFormProvider>
                <HandlePage />
            </EditMultiStepFormProvider>
        </>
    );
}

function HandlePage() {
    const { step } = useEditMultiStepForm();

    const headerValue = [
        "Personal Details",
        "Address",
        "Account Login",
        "Company Details",
        "Roles",
    ];

    const formComponents = [
        <PersonalDetailsForm />,
        <AddressForm />,
        <AccountLoginForm />,
        <CompanyDetailsForm />,
        <RolesForm />,
        // <DocumentForm  />,
    ];

    return (
        <>
            <ol
                className={
                    "mb-6 space-y-4 lg:justify-between lg:flex lg:space-x-8 lg:space-y-0 mx-8"
                }
            >
                {headerValue.map((header, index) => (
                    <NavStepper
                        step={step}
                        header={header}
                        index={index}
                        key={header}
                    />
                ))}
            </ol>
            <ContentContainer>
                <ContentHeader>{headerValue[step]}</ContentHeader>

                {formComponents[step]}
            </ContentContainer>
        </>
    );
}

function PersonalDetailsForm() {
    const { selectedFacultyDetails, onFormNavigate, nextStep } =
        useEditMultiStepForm();
    const { personalDetails } = selectedFacultyDetails;

    const {
        register,
        handleSubmit,
        control,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(personalDataSchema),
        defaultValues: personalDetails,
    });

    function onFormSubmit(data) {
        console.log(data);
        onFormNavigate({ formKey: "personalDetails", formData: data });
        nextStep();
    }

    const eighteenYearsAgo = dayjs().subtract(18, "year");

    return (
        <form encType={"multi-part/formdata"}>
            <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                {/* First Row! */}
                <LabelInput
                    id={"first_name"}
                    register={register}
                    label={"First Name"}
                    error={errors}
                />
                <LabelInput
                    id={"middle_name"}
                    register={register}
                    label={"Middle Name"}
                    error={errors}
                />
                <LabelInput
                    id={"last_name"}
                    register={register}
                    label={"Last Name"}
                    error={errors}
                />
                <label className={"my-2 space-y-2 text-sm"}>
                    <span>Name Extension</span>

                    <InputSelect
                        id={"name_extension_id"}
                        register={register}
                        error={errors}
                    >
                        <option value="1">None</option>
                        <option value="2">Sr. </option>
                        <option value="3">Jr. </option>
                        <option value="4">I</option>
                        <option value="5">II</option>
                        <option value="6">III</option>
                        <option value="7">IV</option>
                        <option value="8">V</option>
                    </InputSelect>
                </label>
                {/* First Row! */}

                {/* Second Row */}
                <LabelInput
                    id={"place_of_birth"}
                    register={register}
                    label={"Place of Birth"}
                    error={errors}
                />
                <div className={"flex flex-col lg:my-2"}>
                    <InputLabel
                        labelFor={"date_of_birth"}
                        color={"black"}
                        width={"normal"}
                    >
                        Date of Birth
                    </InputLabel>
                    <Controller
                        control={control}
                        name={"date_of_birth"}
                        render={({ field }) => (
                            <CustomDatePicker
                                value={field}
                                error={errors}
                                name={"date_of_birth"}
                                minimumDate={"1950-01-01"}
                                maximumDate={eighteenYearsAgo.format(
                                    "YYYY-MM-DD"
                                )}
                            />
                        )}
                    />
                </div>
                <label className={"my-2 space-y-2 text-sm"}>
                    <span>Sex</span>
                    <InputSelect id={"sex"} register={register}>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </InputSelect>
                </label>
                <label className={"my-2 space-y-2 text-sm"}>
                    <span>Civil Status</span>
                    <InputSelect id={"civil_status_id"} register={register}>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Widowed</option>
                        <option value="4">Separated</option>
                    </InputSelect>
                </label>
                {/* Second Row */}

                {/* Third Row */}
                <LabelInput
                    id={"contact_number"}
                    register={register}
                    label={"Contact Number"}
                    error={errors}
                />
                <LabelInput
                    id={"telephone_number"}
                    register={register}
                    label={"Telephone Number"}
                    error={errors}
                />
                <LabelInput
                    id={"contact_person_name"}
                    register={register}
                    label={"Contact Person Name"}
                    error={errors}
                />
                <LabelInput
                    id={"contact_person_number"}
                    register={register}
                    label={"Contact Person Number"}
                    error={errors}
                />
                {/* Third Row */}
            </div>

            <div className={"flex justify-end mt-16"}>
                <NavButton type={"next"} onClick={handleSubmit(onFormSubmit)}>
                    Next: Address
                </NavButton>
            </div>
        </form>
    );
}

function AddressForm() {
    const { previousStep, selectedFacultyDetails, onFormNavigate, nextStep } =
        useEditMultiStepForm();
    const { addresses } = selectedFacultyDetails;

    const {
        register,
        formState: { errors },
        handleSubmit,
        watch,
        setValue,
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: addresses,
    });

    function onFormSubmit(data) {
        onFormNavigate({ formData: watch(), formKey: "addresses" });
        nextStep();
    }

    return (
        <>
            <form>
                <div className="relative grid grid-cols-none lg:grid-cols-2 gap-16">

                    <label className={"absolute right-2 -top-20 my-2 py-1 px-4 text-sm font-bold"}>
                        <input type={"checkbox"} {...register('sameAddress')}/>
                        <span>Same as Residential</span>
                    </label>

                    <AddressFields
                        title={"Residential Address"}
                        prefix="residential"
                        register={register}
                        watch={watch}
                        setValue={setValue}
                        errors={errors}
                    />

                    <AddressFields
                        title={"Permanent Address"}
                        prefix="permanent"
                        register={register}
                        watch={watch}
                        setValue={setValue}
                        errors={errors}
                        disabled={watch('sameAddress')}
                    />
                </div>
                <div className={"flex justify-between mt-8"}>
                    <NavButton type={"prev"} onClick={previousStep}>
                        Back
                    </NavButton>
                    <NavButton type={"next"} onClick={handleSubmit(onFormSubmit)}>
                        Next: Account
                    </NavButton>
                </div>
            </form>
        </>
    );
}

function AccountLoginForm() {
    const { previousStep, selectedFacultyDetails, onFormNavigate, nextStep } =
        useEditMultiStepForm();
    const { accountLoginDetails } = selectedFacultyDetails;

    const {
        register,
        handleSubmit,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(emailDataSchema),
        defaultValues: accountLoginDetails,
    });

    function onFormSubmit(data) {
        onFormNavigate({ formData: data, formKey: "accountLoginDetails" });
        nextStep();
    }

    return (
        <form>
            <LabeledInput
                id={"email"}
                register={register}
                label={"Email"}
                placeholder={"Email"}
                color={"black"}
                width={"normal"}
                error={errors}
            />

            <div className={"flex justify-between mt-16"}>
                <NavButton type={"prev"} onClick={previousStep}>
                    Back
                </NavButton>
                <NavButton type={"next"} onClick={handleSubmit(onFormSubmit)}>
                    Next: Company Details
                </NavButton>
            </div>
        </form>
    );
}

export function CompanyDetailsForm() {
    const {
        previousStep,
        selectedFacultyDetails,
        onFormNavigate,
        nextStep,
    } = useEditMultiStepForm();
    const { companyDetails } = selectedFacultyDetails;

    const {
            register,
            handleSubmit,
            watch,
            control,
            setValue,
            formState: { errors },
            setError,
            clearErrors,
        } = useForm({
            resolver: zodResolver(companyDetailsDataSchema),
            defaultValues: companyDetails,
        });

    const [ existingCompanyDetails, setExistingCompanyDetails ] = useState(companyDetails);

    console.log(existingCompanyDetails);

    const [departments, setDepartments] = useState([]);
    const [positions, setPositions] = useState([]);
    const [shifts, setShifts] = useState([]);
    const [departmentHeads, setDepartmentHeads] = useState([]);

    const [allFetchErrors, setAllFetchErrors] = useState([]);
    const [allFetchLoading, setAllFetchLoading] = useState([]);

    const [designations, setDesignations] = useState([]);

    function handleSetError(key, error) {
        setAllFetchErrors((prevErrors) => ({
            ...prevErrors,
            [key]: error,
        }));
    }

    function handleSetLoading(key, value) {
        setAllFetchLoading((allLoadings) => ({
            ...allLoadings,
            [key]: value,
        }));
    }

    useFetchCompanyDetails({
        setState: setDepartments,
        setLoading: (value) => handleSetLoading("departments", value),
        setError: (error) => handleSetError("departments", error),
        link: route("api.get.departments"),
    });

    useFetchCompanyDetails({
        setState: setPositions,
        setLoading: (value) => handleSetLoading("positions", value),
        setError: (error) => handleSetError("positions", error),
        link: route("api.get.positions"),
    });

    useFetchCompanyDetails({
        setState: setShifts,
        setLoading: (value) => handleSetLoading("shifts", value),
        setError: (error) => handleSetError("shifts", error),
        link: route("api.get.shifts"),
    });

    useEffect(
        function () {
            async function getDesignations() {
                setAllFetchLoading((allLoadings) => ({
                    ...allLoadings,
                    designations: true,
                }));

                try {
                    const response = await fetch(
                        route("api.get.designations", watch("department_id")),
                        {
                            method: "GET",
                            headers: {
                                "content-type": "application/json",
                            },
                        }
                    );

                    if (!response.ok) {
                        setAllFetchErrors((prevErrors) => ({
                            ...prevErrors,
                            designations: "Something happened!",
                        }));
                    }

                    const data = await response.json();

                    if (data) {
                        setDesignations(data);
                        setAllFetchErrors((prevErrors) => ({
                            ...prevErrors,
                            designations: null,
                        }))
                    }
                } catch (err) {
                    console.error(err);
                } finally {
                    setAllFetchLoading((allLoadings) => ({
                        ...allLoadings,
                        designations: false,
                    }));
                }
            }
            getDesignations();
        },
        [watch("department_id")]
    );


    useEffect(
        function () {
            async function getDepartmentHeads() {
                setAllFetchLoading((allLoadings) => ({
                    ...allLoadings,
                    department_head: true,
                }));

                try {
                    const response = await fetch(
                        route("api.get.head", watch("department_id")),
                        {
                            method: "GET",
                            headers: {
                                "content-type": "application/json",
                            },
                        }
                    );

                    const data = await response.json();

                    if (!response.ok) {
                        setDepartmentHeads([]);
                        setAllFetchErrors((prevErrors) => ({
                            ...prevErrors,
                            department_head: data.message,
                        }));
                    } else {
                        if (data) {
                            setDepartmentHeads(data);
                            setAllFetchErrors((prevErrors) => ({
                                ...prevErrors,
                                department_head: null,
                            }));
                            clearErrors("department_head");
                        }
                    }

                } catch (err) {
                    console.error(err);
                } finally {
                    setAllFetchLoading((allLoadings) => ({
                        ...allLoadings,
                        department_head: false,
                    }));
                }
            }
            getDepartmentHeads();
        },
        [watch("department_id")]
    )

    useEffect(() => {
        const subscription = watch((values) => {
            setExistingCompanyDetails(values);
        });
        return () => subscription.unsubscribe();
    }, [watch]);


    // Used for applying existing values
    useEffect(() => {

        const allFetchesCompleted = Object.values(allFetchLoading).every(
            (loading) => !loading
        );

        if (allFetchesCompleted) {
            setValue("department_id", existingCompanyDetails?.department_id ?? "0");
            setValue("position_id", existingCompanyDetails?.position_id ?? "0");
            setValue("shift_id", existingCompanyDetails?.shift_id ?? "0");
            setValue(
                "designation_id",
                existingCompanyDetails?.designation_id ?? "0"
            );

            // Set "N/A" for fields that encountered errors
            // if (allFetchErrors["departments"]) {
            //     setValue("department_id", "N/A");
            // }
            // if (allFetchErrors["positions"]) {
            //     setValue("position_id", "N/A");
            // }
            // if (allFetchErrors["shifts"]) {
            //     setValue("shift_id", "N/A");
            // }
            // if (allFetchErrors["designations"]) {
            //     setValue("designation_id", "N/A");
            // }
            if (allFetchErrors["department_head"]) {
                setError("department_head", {type: "custom", message: "No Department Head found in Department!"});
            }
        }
    }, [allFetchLoading, setValue]);

    function onFormSubmit() {
        onFormNavigate({ formData: watch(), formKey: "companyDetails" });
        nextStep();
      }
    return (
        <form>
            <div className="grid grid-cols-none lg:grid-cols-2 lg:gap-16">
                <div>
                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Department</span>
                        <InputSelect id={"department_id"} register={register} error={errors}>
                            <option value={"0"}>Select Department</option>
                            {departments.map((dept) => (
                                <option value={`${dept.id}`} key={dept.id}>
                                    {dept.name}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Designations</span>
                        <InputSelect id={"designation_id"} register={register} error={errors}>
                            <option value={"0"}>Select Department First</option>
                            {designations.map((desig) => (
                                <option value={`${desig.id}`} key={desig.id}>
                                    {desig.name}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Manager/Department Head</span>
                        <InputSelect id={"department_head"} register={register} error={errors}>
                        <option value={'blank'}>No Head</option>
                            {departmentHeads.map((deptHead) => (
                                <option value={`${deptHead.id}`} key={deptHead.id}>
                                    {getFullName(deptHead) ?? 'null'}
                                </option>
                            ))}
                        </InputSelect>
                    </label>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Shift</span>
                        <InputSelect id={"shift_id"} register={register} error={errors}>
                            <option value={"0"}>Select Shift</option>
                            {shifts.map((shift) => (
                                <option value={`${shift.id}`} key={shift.id}>
                                    {capitalizeFirstLetter(shift.name)}
                                </option>
                            ))}
                        </InputSelect>
                    </label>
                </div>
                <div>
                    <div className={"flex flex-col lg:my-2"}>
                        <InputLabel
                            labelFor={"date_of_joining"}
                            color={"black"}
                            width={"normal"}
                        >
                            Date of Joining
                        </InputLabel>

                        <Controller
                            control={control}
                            name={"date_of_joining"}
                            render={({ field }) => (
                                <CustomDatePicker
                                    value={field}
                                    error={errors}
                                    name={"date_of_joining"}
                                />
                            )}
                        />
                    </div>

                    <label className={"my-2 space-y-2 text-sm"}>
                        <span>Position</span>
                        <InputSelect id={"position_id"} register={register} error={errors}>
                            <option value={"0"}>Select Position</option>
                            {positions.map((pos) => (
                                <option value={`${pos.id}`} key={pos.id}>
                                    {capitalizeFirstLetter(pos.title)}
                                </option>
                            ))}
                        </InputSelect>
                    </label>
                </div>
            </div>
            <div className={"flex justify-between mt-16"}>
                <NavButton type={"prev"} onClick={previousStep}>
                    Back
                </NavButton>
                <NavButton type={"next"} onClick={handleSubmit(onFormSubmit)}>
                    Next: Assigning Roles
                </NavButton>
            </div>
        </form>
    );
}

function RolesForm() {
    const {
        previousStep,
        selectedFacultyDetails,
        onFormNavigate,
        onSubmitForm,
        AUTH_API_KEY,
    } = useEditMultiStepForm();
    const { roles } = selectedFacultyDetails;
    const { roles_id } = roles;

    const {
        register,
        handleSubmit,
        setValue,
        formState: { errors },
    } = useForm({
        // resolver: zodResolver(personalDataSchema),
        defaultValues: { roles_id: [] },
    });

    const [rolesDetails, setRolesDetails] = useState([]);
    const [roleError, setRoleError] = useState("");

    useFetchToFillDataToSelect({
        setState: setRolesDetails,
        apiKey: AUTH_API_KEY,
        link: "/api/roles",
    });

    useEffect(
        function () {
            if (rolesDetails.length > 0) {
                setValue(
                    "roles_id",
                    roles_id.map((id) => id.toString())
                );
            }
        },
        [rolesDetails, roles, setValue]
    );

    function onFormSubmit(data) {
        onFormNavigate({ formKey: "roles", formData: data });
        onSubmitForm(data);
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
                            {rolesDetails
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
                            {rolesDetails
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
                            {rolesDetails
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
            <div className={"flex justify-between mt-16"}>
                <NavButton type={"prev"} onClick={previousStep}>
                    Back
                </NavButton>
                <NavButton type={"submit"} onClick={handleSubmit(onFormSubmit)}>
                    Submit
                </NavButton>
            </div>
        </>
    );
}
