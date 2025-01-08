// Libraries and Dependencies
import { useEffect, useState } from "react";
import { usePage } from "@inertiajs/react";
import { zodResolver } from "@hookform/resolvers/zod";
import { useForm, Controller, useController } from "react-hook-form";
import dayjs from 'dayjs';

// Edit Multistep Form Context, Provider, and Hooks
import { useEditMultiStepForm } from "@/Context/EditMultiStepFormContext";
import { EditMultiStepFormProvider } from "@/Context/EditMultiStepFormContext";
import { useFetchToFillDataToSelect} from "@/Hooks/useFetchToFillDataToSelect";

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
import CustomDatePicker from "@/Components/CustomDatePicker";



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

    const headerValue = ["Personal Details", "Address", "Account Login", "Company Details", "Roles"];

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
            <ol className={"mb-6 space-y-4 lg:justify-between lg:flex lg:space-x-8 lg:space-y-0 mx-8"}>
                {headerValue.map((header, index) => (
                    <NavStepper step={step} header={header} index={index} key={header} />
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
    const { selectedFacultyDetails, onFormNavigate, nextStep } = useEditMultiStepForm();
    const { personalDetails } = selectedFacultyDetails;

    const { register, handleSubmit, control, formState: { errors }} = useForm({
        resolver: zodResolver(personalDataSchema),
        defaultValues: personalDetails,
    });

    function onFormSubmit(data) {
        console.log(data);
      onFormNavigate({ formKey: 'personalDetails', formData: data});
      nextStep();

    }

    const eighteenYearsAgo = dayjs().subtract(18, 'year');


    return (
        <form encType={"multi-part/formdata"}>
            <div className="grid grid-cols-none lg:grid-cols-4 gap-4">
                {/* First Row! */}
                <LabeledInput id={"first_name"} register={register} label={"First Name"} placeholder={"First Name"} color={"black"} width={"normal"} error={errors} />
                <LabeledInput id={"middle_name"} register={register} label={"Middle Name"} placeholder={"Middle Name"} color={"black"} width={"normal"} error={errors} />
                <LabeledInput id={"last_name"} register={register} label={"Last Name"} placeholder={"Last Name"} color={"black"} width={"normal"} error={errors} />
                <div className={"my-2"}>
                    <InputLabel labelFor={"name_extension_id"} color={"black"} width={"normal"}>
                        Name Extension
                    </InputLabel>

                    <InputSelect id={"name_extension_id"} register={register} error={errors}>
                        <option value='1'>None</option>
                        <option value='2'>Sr. </option>
                        <option value='3'>Jr. </option>
                        <option value='4'>I</option>
                        <option value='5'>II</option>
                        <option value='6'>III</option>
                        <option value='7'>IV</option>
                        <option value='8'>V</option>
                    </InputSelect>
                </div>
                {/* First Row! */}

                {/* Second Row */}
                <LabeledInput id={"place_of_birth"} register={register} label={"Place of Birth"} placeholder={"Place of Birth"} color={"black"} width={"normal"} error={errors} />
                <div className={"flex flex-col lg:my-2"}>
                    <InputLabel labelFor={"date_of_birth"} color={"black"} width={"normal"}>
                        Date of Birth
                    </InputLabel>
                    <Controller control={control} name={"date_of_birth"} render={({ field }) => <CustomDatePicker value={field} error={errors} name={"date_of_birth"} minimumDate={'1950-01-01'} maximumDate={eighteenYearsAgo.format(
                                "YYYY-MM-DD"
                            )}/>} />
                </div>
                <LabeledInput id={"sex"} register={register} label={"Sex"} placeholder={"Sex"} color={"black"} width={"normal"} error={errors} />
                <div className={"my-2"}>
                    <InputLabel labelFor={"civil_status_id"} color={"black"} width={"normal"}>
                        Civil Status
                    </InputLabel>
                    <InputSelect id={"civil_status_id"} register={register} error={errors}>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Widowed</option>
                        <option value="4">Separated</option>
                    </InputSelect>
                </div>
                {/* Second Row */}

                {/* Third Row */}
                <LabeledInput id={"contact_number"} register={register} label={"Contact Number"} placeholder={"Contact Number"} color={"black"} width={"normal"} error={errors} />
                <LabeledInput id={"telephone_number"} register={register} label={"Telephone Number"} placeholder={"Telephone Number"} color={"black"} width={"normal"} error={errors} />
                <LabeledInput id={"contact_person_name"} register={register} label={"Contact Person Name"} placeholder={"Contact Person Name"} color={"black"} width={"normal"} error={errors} />
                <LabeledInput id={"contact_person_number"} register={register} label={"Contact Person Number"} placeholder={"Contact Person Number"} color={"black"} width={"normal"} error={errors} />
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
        handleSubmit,
        watch,
        setValue,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(addressDataSchema),
        defaultValues: addresses,
    });

    function copyAddress(e) {
        e.preventDefault();

        const residentialFields = watch([
            "residential_house_num",
            "residential_street",
            "residential_subdivision",
            "residential_barangay",
            "residential_city",
            "residential_province",
            "residential_zip_code",
        ]);

        // Set permanent fields
        setValue("permanent_house_num", residentialFields[0]);
        setValue("permanent_street", residentialFields[1]);
        setValue("permanent_subdivision", residentialFields[2]);
        setValue("permanent_barangay", residentialFields[3]);
        setValue("permanent_city", residentialFields[4]);
        setValue("permanent_province", residentialFields[5]);
        setValue("permanent_zip_code", residentialFields[6]);
    }

    function onFormSubmit(data) {
        onFormNavigate({ formData: data, formKey: "addresses" });
        nextStep();
    }

    return (
        <>
            <form>
                <div className="relative grid grid-cols-none lg:grid-cols-2 gap-16">
                    <button
                        onClick={copyAddress}
                        className={
                            "absolute right-2 -top-20 my-2 py-1 px-4 bg-blue-600 text-sm font-bold text-white border border-blue-600 rounded-3xl hover:bg-blue-800 hover:text-grey-600 hover:border-blue-800"
                        }>
                        Copy Residential to Permanent
                    </button>

                    <div>
                        <div className="flex items-center">
                            <h6 className="font-semibold">
                                Residential Address
                            </h6>
                        </div>

                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"residential_house_num"}
                                register={register}
                                label={"House/Block/Lot No."}
                                placeholder={"House/Block/Lot No."}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />

                            <LabeledInput
                                id={"residential_street"}
                                register={register}
                                label={"Street"}
                                placeholder={"Street"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabeledInput
                                id={"residential_subdivision"}
                                register={register}
                                label={"Subdivision/Village"}
                                placeholder={"Subdivision/Village"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"residential_barangay"}
                                register={register}
                                label={"Barangay"}
                                placeholder={"Barangay"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"residential_city"}
                                register={register}
                                label={"City/Municipality"}
                                placeholder={"City/Municipality"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"residential_province"}
                                register={register}
                                label={"Province"}
                                placeholder={"Province"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"residential_zip_code"}
                                register={register}
                                label={"Zip Code"}
                                placeholder={"Zip Code"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>
                    </div>

                    <div>
                        <div className={"flex items-center"}>
                            <h6 className="font-semibold">Permanent Address</h6>
                        </div>
                        {/* First Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"permanent_house_num"}
                                register={register}
                                label={"House/Block/Lot No."}
                                placeholder={"House/Block/Lot No."}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />

                            <LabeledInput
                                id={"permanent_street"}
                                register={register}
                                label={"Street"}
                                placeholder={"Street"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Second Row! */}
                        <div>
                            <LabeledInput
                                id={"permanent_subdivision"}
                                register={register}
                                label={"Subdivision/Village"}
                                placeholder={"Subdivision/Village"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Third Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"permanent_barangay"}
                                register={register}
                                label={"Barangay"}
                                placeholder={"Barangay"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"permanent_city"}
                                register={register}
                                label={"City/Municipality"}
                                placeholder={"City/Municipality"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>

                        {/* Fourth Row! */}
                        <div className="mt-2 grid gap-4 grid-cols-2">
                            <LabeledInput
                                id={"permanent_province"}
                                register={register}
                                label={"Province"}
                                placeholder={"Province"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                            <LabeledInput
                                id={"permanent_zip_code"}
                                register={register}
                                label={"Zip Code"}
                                placeholder={"Zip Code"}
                                color={"black"}
                                width={"normal"}
                                error={errors}
                            />
                        </div>
                    </div>
                </div>
                <div className={"flex justify-between mt-8"}>
                    <NavButton
                        type={"prev"}
                        onClick={previousStep}>
                        Back
                    </NavButton>
                    <NavButton
                        type={"next"}
                        onClick={handleSubmit(onFormSubmit)}>
                        Next: Account
                    </NavButton>
                </div>
            </form>
        </>
    );
}

function AccountLoginForm (){
  const { previousStep, selectedFacultyDetails, onFormNavigate, nextStep } = useEditMultiStepForm();
  const { accountLoginDetails } = selectedFacultyDetails;

  const { register, handleSubmit, formState: { errors }} = useForm({
      resolver: zodResolver(emailDataSchema),
      defaultValues: accountLoginDetails,
  });

  function onFormSubmit(data) {
    onFormNavigate({ formData: data, formKey: 'accountLoginDetails' });
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
            <NavButton type={'prev'} onClick={previousStep}>
                Back
            </NavButton>
            <NavButton type={'next'} onClick={handleSubmit(onFormSubmit)}>
                Next: Company Details
            </NavButton>
        </div>
    </form>
);
}

export function CompanyDetailsForm() {
    const { previousStep, selectedFacultyDetails, onFormNavigate, AUTH_API_KEY, nextStep } = useEditMultiStepForm();
    const { companyDetails } = selectedFacultyDetails;

    const {
        register,
        handleSubmit,
        control,
        watch,
        setValue,
        formState: { errors },
    } = useForm({
        resolver: zodResolver(companyDetailsDataSchema),
        defaultValues: companyDetails,
    });

    const [isLoading, setIsLoading] = useState(false);
    const [departments, setDepartments] = useState([]);
    const [positions, setPositions] = useState([]);
    const [shifts, setShifts] = useState([]);
    const [designations, setDesignations] = useState([]);


    // Get Departments
    useFetchToFillDataToSelect({ setState: setDepartments, apiKey: AUTH_API_KEY, link: "/api/get-departments" });

    // Get Positions
    useFetchToFillDataToSelect({ setState: setPositions, apiKey: AUTH_API_KEY, link: "/api/get-positions" });

    // Get Shifts
    useFetchToFillDataToSelect({ setState: setShifts, apiKey: AUTH_API_KEY, link: "/api/get-shifts" });

    useEffect(
      function () {
        async function getDesignations() {
          const deptId = watch("department_id");
          setIsLoading(true);
          try {
            const response = await fetch(`/api/get-designations?department=${deptId}`, {
              method: "GET",
              headers: {
                "x-auth-api-key": AUTH_API_KEY,
                            "content-type": "application/json",
                        },
                    });

                    const data = await response.json();

                    if (data) {
                      setDesignations(data);
                    }
                  } catch (err) {
                    console.error(err);
                } finally {
                  setIsLoading(false);
                }
              }
              getDesignations();
            },
            [watch("department_id")]
          );

          useEffect(function(){
            if (departments.length > 0) {
              setValue("department_id", companyDetails.department_id); // set default value for department
            }
            if (positions.length > 0) {
              setValue("position_id", companyDetails.position_id); // set default value for position
            }
            if (shifts.length > 0) {
              setValue("shift_id", companyDetails.shift_id); // set default value for shift
            }
            if (designations.length > 0) {
              setValue("designation_id", companyDetails.designation_id); // set default value for shift
            }
          }, [positions, shifts]);

          function capitalizeFirstLetter(text) {
              const word = text
                  ?.split(" ")
                  .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
                  .join(" ");

              return word;
          }

          useEffect(()=>{
            console.log(errors)
          },[errors])

          function onFormSubmit(data) {
            onFormNavigate({ formData: data, formKey: "companyDetails" });
            nextStep();
          }


          return (
            <form>
            <div className="grid grid-cols-none lg:grid-cols-2 lg:gap-16">
                <div>
                    <div className={"my-2"}>
                        <InputLabel labelFor={"department_id"} color={"black"} width={"normal"}>
                            Department
                        </InputLabel>

                        <InputSelect id={"department_id"} register={register}>
                            {departments.map((dept) => (
                                <option value={`${dept.id}`} key={dept.id}>
                                    {dept.name}
                                </option>
                            ))}
                        </InputSelect>
                    </div>

                    <div className={"my-2"}>
                        <InputLabel labelFor={"designation_id"} color={"black"} width={"normal"}>
                            Designations
                        </InputLabel>

                        <InputSelect id={"designation_id"} register={register}>
                            {designations.map((desig) => (
                                <option value={`${desig.id}`} key={desig.id}>
                                    {desig.name}
                                </option>
                            ))}
                        </InputSelect>
                    </div>

                    <LabeledInput id={"depart_head"} register={register} label={"Manager/Department Head"} placeholder={"Manager/Department Head"} color={"black"} width={"normal"} error={errors} />

                    <div className={"my-2"}>
                        <InputLabel labelFor={"shift_id"} color={"black"} width={"normal"}>
                            Shifts
                        </InputLabel>

                        <InputSelect id={"shift_id"} register={register}>
                            {shifts.map((shift) => (
                                <option value={`${shift.id}`} key={shift.id}>
                                    {capitalizeFirstLetter(shift.name)}
                                </option>
                            ))}
                        </InputSelect>
                    </div>
                </div>
                <div>
                    <div className={"flex flex-col lg:my-2"}>
                        <InputLabel labelFor={"date_of_joining"} color={"black"} width={"normal"}>
                            Date of Joining
                        </InputLabel>

                        <Controller control={control} name={"date_of_joining"} render={({ field }) => <CustomDatePicker value={field} error={errors} name={"date_of_joining"} minimumDate={"1950-01-01"}
                                    />} />
                    </div>

                    <div className={"my-2"}>
                        <InputLabel labelFor={"position_id"} color={"black"} width={"normal"}>
                            Position
                        </InputLabel>

                        <InputSelect id={"position_id"} register={register}>
                            {positions.map((pos) => (
                                <option value={`${pos.id}`} key={pos.id}>
                                    {capitalizeFirstLetter(pos.title)}
                                </option>
                            ))}
                        </InputSelect>
                    </div>
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

function RolesForm(){
  const { previousStep, selectedFacultyDetails, onFormNavigate, onSubmitForm, AUTH_API_KEY } = useEditMultiStepForm();
  const { roles } = selectedFacultyDetails;
  const { roles_id } = roles;


  const { register, handleSubmit, setValue, formState: { errors }} = useForm({
      // resolver: zodResolver(personalDataSchema),
      defaultValues: { roles_id: [] },
  });

  const [rolesDetails, setRolesDetails] = useState([]);
  const [roleError, setRoleError] = useState('');

  useFetchToFillDataToSelect({ setState: setRolesDetails, apiKey: AUTH_API_KEY, link: "/api/roles" });

  useEffect(function(){
    if(rolesDetails.length > 0){
      setValue('roles_id', roles_id.map((id)=>id.toString()))
    }
  },[rolesDetails, roles, setValue])

  function onFormSubmit(data) {
    onFormNavigate({ formKey: 'roles', formData: data});
    onSubmitForm(data);
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
                        {rolesDetails
                            .filter((role) => role.type === "sis")
                            .map((role) => (
                                <label key={role.id}>
                                    <input type="checkbox" value={role.id} {...register("roles_id")}  /> {`${role.description}`}
                                </label>
                            ))}
                    </div>
                </div>

                <div className="mb-4">
                    <p className="font-semibold">Human Resources Management System</p>
                    <div className="ml-4 flex flex-col">
                        {rolesDetails
                            .filter((role) => role.type === "hr")
                            .map((role) => (
                                <label key={role.id}>
                                    <input type="checkbox" value={role.id} {...register("roles_id")}  /> {`${role.description}`}
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
                                    <input type="checkbox" value={role.id} {...register("roles_id")}  /> {`${role.description}`}
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