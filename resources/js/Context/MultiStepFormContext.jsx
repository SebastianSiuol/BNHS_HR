import {createContext, useContext, useReducer } from "react";
import { useForm as useInertiaForm, router } from "@inertiajs/react";
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MultiStepFormContext = createContext();

const formDataKeys = [
    "first_form_local_data",
    "second_form_local_data",
    "third_form_local_data",
    "fourth_form_local_data",
    "fifth_form_local_data",
];

const initialStates = {
    step: 0,
    isLoading: false,
    formData: []
}

const AUTH_API_KEY = '';

function reducer(state, action) {
    switch (action.type) {
        case 'IS_LOADING':
            return {...state, isLoading: true}
        case 'FINISHED_LOADING':
            return {...state, isLoading: false}

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
    const [{ step, isLoading }, dispatch] = useReducer(reducer, initialStates);

    function prevStep() {
        dispatch({ type: "PREV_STEP" });
    }

    function nextStep() {
        dispatch({ type: "NEXT_STEP" });
    }

    // Initially gets Data for Form Persistance
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

    // Retrieve all Data in the Local Storage
    function getAllSavedDataFromLocalStorage() {
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

    function postFormDatatoServer(value) {
        const retrievedData = getAllSavedDataFromLocalStorage();

        const mergedData = {...retrievedData, ...value,};

        // Use this fooking way, or else it wont upload the files.
        router.post(route('admin.faculty.store'), mergedData, {
            onError: errors => {
                const errorMessages = Object.values(errors).flat().map((error) => error);

                errorSwal(errorMessages);
            },
            onSuccess: () => {
                localStorage.clear();
            },
        });
    }

    return (
        <MultiStepFormContext.Provider
            value={{
                dispatch,
                step,
                isLoading,
                prevStep,
                nextStep,
                getSavedData,
                postFormDatatoServer,
                AUTH_API_KEY,
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



function errorSwal( error ) {

    const swalText = error.join('<br>');

    withReactContent(Swal).fire({
        title: <b>ERROR</b>,
        icon: 'error',
        html: swalText,
        confirmButtonText: 'Confirm',
        customClass: {
            container: '...',
            popup: 'border rounded-3xl',
            header: '...',
            title: 'text-gray-500',
            icon: '...',
            htmlContainer: '...',
            validationMessage: '...',
            actions: '...',
            confirmButton: 'bg-blue-800',
          }
    });
}