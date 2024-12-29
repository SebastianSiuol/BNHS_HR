import { useState, useEffect, useRef } from "react";
import { Combobox, ComboboxInput, ComboboxOption, ComboboxOptions } from "@headlessui/react";

const AUTH_API_KEY = "eVS3zvZPUTh4dGr1ok6wuSUlEdxVSj8LDhizEKSvQUG8SbMev6TXNCmKRnOMBOhC";

export function FacultyAutoComplete({ selected, setSelected }) {
    const [query, setQuery] = useState("");
    const [facultyList, setFacultyList] = useState([]);
    const [isInputClicked, setIsInputClicked] = useState(false);

    useEffect(() => {
        const autoCompleteController = new AbortController();

        async function autoComplete() {
            try {
                const response = await fetch(`/api/faculty/autocomplete?search=${query}`, {
                    method: "GET",
                    headers: {
                        "x-auth-api-key": AUTH_API_KEY,
                        "content-type": "application/json",
                    },
                    signal: autoCompleteController.signal,
                });

                if (!response.ok) throw new Error(`Error: ${response.statusText}`);

                const parsedResponse = await response.json();
                setFacultyList(parsedResponse);
            } catch (err) {
                if (err.name !== "AbortError") {
                    console.log(err.message);
                }
            }
        }

        if (isInputClicked) {
            autoComplete();
        } else if (query) {
            autoComplete();
        }

        return () => {
            autoCompleteController.abort();
        };
    }, [query, isInputClicked]);

    function handleSetSelectedFaculty(faculty) {
        setSelected(faculty || {});
    }

    return (
        <>
            <Combobox
                immediate={true}
                value={
                    Object.keys(selected || {}).length !== 0
                        ? `${selected?.personal_information?.first_name} ${selected?.personal_information?.last_name}`
                        : ""
                }
                onChange={(faculty) => {
                    handleSetSelectedFaculty(faculty);

                }}
                onClose={() => setQuery("")}>
                <div className={"relative w-full"}>
                    <ComboboxInput
                        placeholder="Faculty Name"
                        onFocus={() => setIsInputClicked(true)}
                        // onBlur={() => setIsInputClicked(false)}
                        onChange={(e) => setQuery(e.target.value)}
                        className={
                            "w-full p-2.5 text-gray-900 text-sm bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-600 focus:border-blue-600"
                        }
                    />
                    {facultyList && facultyList.length !== 0 && (
                        <ComboboxOptions
                            anchor="bottom"
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
