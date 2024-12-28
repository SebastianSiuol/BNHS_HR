/*
 * Dependencies and Libraries
 */
import { useState, useEffect, useCallback } from "react";
import { useForm } from "react-hook-form";
import { useForm as useInertiaForm } from "@inertiajs/react";
import { usePage, router } from "@inertiajs/react";
import { Combobox, ComboboxInput, ComboboxOption, ComboboxOptions } from '@headlessui/react'

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

    useFetchToFillDataToSelect({ setState: setRoles, apiKey: AUTH_API_KEY, link: "/api/roles" });

    useEffect(() => {
        setValue('roles_id', selectedFaculty?.roles?.map((role)=>role.id.toString()));

    }, [selectedFaculty])


    function rolesUpdate(data, e) {
        e.preventDefault();
        if (Object.keys(selectedFaculty || {}).length !== 0) {
            console.log(selectedFaculty);
            router.patch(route('admin.config.role.update', selectedFaculty?.id), data)
        }
    }

    return (
        <>
            <>
                <form className="relative ">
                    <label className={"flex flex-col my-2 text-sm space-y-2 text-black font-normal"}>
                        <span>Search Faculty</span>
                        <AutoComplete
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

function AutoComplete({ selected, setSelected }) {

    const [query, setQuery] = useState("");
    const [facultyList, setFacultyList] = useState([]);

    useEffect(() => {
        const autoCompleteController = new AbortController();

        async function autoComplete() {
          try {
            if(query){

              const response = await fetch(`/api/faculty/autocomplete?search=${query}`, {
                method: "GET",
                headers: {
                  "x-auth-api-key": AUTH_API_KEY,
                  "content-type": "application/json",
                },
                signal: autoCompleteController.signal
              });

              if (!response.ok) throw new Error(`Error: ${response.statusText}`);


              const parsedResponse = await response.json();
              setFacultyList(parsedResponse);


            }
          } catch(err){
            if (err.name !== "AbortError") {
              console.log(err.message);
            }
          }

        }
        autoComplete();

        return () => {
          autoCompleteController.abort();
        };

    }, [query]);


    function handleSetSelectedFaculty (faculty){
        setSelected(faculty || {});
    };

    return (
        <>
            <Combobox
                onChange={(faculty)=>{handleSetSelectedFaculty(faculty)}}
                onClose={() =>
                    setQuery('')
                }>
                <div className={"relative w-full"}>
                    <ComboboxInput
                        placeholder="Faculty Name"
                        onChange={(e) => setQuery(e.target.value)}
                        className={
                            "w-full p-2.5 text-gray-900 text-sm bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-600 focus:border-blue-600"
                        }
                    />
                    {facultyList && facultyList.length !== 0 && (
                        <ComboboxOptions
                            anchor="bottom"
                            transition
                            className="absolute w-[var(--input-width)] z-10 bg-white border border-gray-300 rounded-md shadow-md max-h-40 overflow-y-auto">
                            {facultyList.faculties?.map((faculty) => (
                                <ComboboxOption
                                    key={faculty.id}
                                    value={faculty}
                                    className={({ active }) =>
                                        `cursor-pointer px-4 py-2 ${active ? "bg-blue-100" : ""}`
                                    }>
                                    {`[${faculty?.faculty_code}] ${faculty?.personal_information.first_name} ${faculty?.personal_information.last_name}`}
                                </ComboboxOption>
                            ))}
                        </ComboboxOptions>
                    )}
                </div>
            </Combobox>
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
              {role.description}
            </label>
          ))}
        </div>
      </div>
    );
  }