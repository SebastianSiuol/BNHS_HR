import {
    createContext,
    useContext,
    useReducer,
    useEffect,
    useState,
} from "react";
import { useForm as inertiaForm } from "@inertiajs/react";

const MultiStepFormContext = createContext();

const initialData = {
    contact_number: "",
    contact_person_name: "",
    contact_person_number: "",
    csc_form_212: "",
    date_of_birth: "",
    date_of_joining: "",
    depart_head: "",
    department: "",
    designation: "",
    dropbox_url: "",
    email: "",
    faculty_code: "",
    first_name: "",
    gdrive_url: "",
    joining_letter: "",
    last_name: "",
    marital_status: "",
    middle_name: "",
    name_extension: "",
    place_of_birth: "",
    position: "",
    residential_barangay: "",
    residential_city: "",
    residential_house_num: "",
    residential_province: "",
    residential_street: "",
    residential_subdivision: "",
    residential_zip_code: "",
    permanent_barangay: "",
    permanent_city: "",
    permanent_house_num: "",
    permanent_province: "",
    permanent_street: "",
    permanent_subdivision: "",
    permanent_zip_code: "",
    resume_file: "",
    offer_letter: "",
    roles: "",
    sex: "",
    shift: "",
    telephone_number: "",
};

const formDataKeys = [
    "first_form_local_data",
    "second_form_local_data",
    "third_form_local_data",
    "fourth_form_local_data",
    "fifth_form_local_data",
];

const initialStates = {
    step: 0,
    formData: {},
    submitData: {}
}

function reducer(state, action) {
    switch (action.type) {
        case "PREV_STEP":
            return {
                ...state,
                step: state.step - 1,
            };
        case "NEXT_STEP":
            return {
                ...state,
                step: state.step + 1,
            };
        default:
            throw new Error("Unknown action passed!");
    }
}

export function MultiStepFormProvider({ children }) {
    const [{ step }, dispatch] = useReducer(reducer, initialStates);

    const { post } = inertiaForm({});

    function prevStep() {
        dispatch({ type: "PREV_STEP" });
    }

    function nextStep() {
        dispatch({ type: "NEXT_STEP" });
    }

    // Initially gets Data
    function getSavedData(dataKey) {
        let retrievedData = localStorage.getItem(dataKey);
        if (retrievedData) {
            try {
                retrievedData = JSON.parse(retrievedData);
            } catch (err) {
                console.log(err);
            }
            return retrievedData;
        }
        return;
    }

    function getAllSavedData() {
        const combinedData = {};

        formDataKeys.forEach((formKey) => {
            const retrievedData = localStorage.getItem(formKey);
            if (retrievedData) {
                try {
                    const parsedData = JSON.parse(retrievedData);
                    Object.assign(combinedData, parsedData);
                } catch (err) {
                    console.error(
                        `Error parsing data for formKey: ${formKey}`,
                        err
                    );
                }
            }
        });

        return combinedData;
    }

    function postData() {
        const allData = getAllSavedData();
        post(route("faculty.store", [allData]));
    }

    return (
        <MultiStepFormContext.Provider
            value={{
                step,
                prevStep,
                nextStep,
                getSavedData,
                postData,
            }}
        >
            {children}
        </MultiStepFormContext.Provider>
    );
}

export function useMultiStepForm() {
    const context = useContext(MultiStepFormContext);
    if (context === undefined) throw new Error("Context used outside scope!");
    return context;
}
