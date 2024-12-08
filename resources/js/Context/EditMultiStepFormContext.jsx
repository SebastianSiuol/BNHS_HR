import { createContext, useContext, useReducer, useState, useEffect } from "react";
import { useForm as useInertiaForm, router, usePage } from "@inertiajs/react";

const EditMultiStepFormContext = createContext();

const formDataKeys = [
    "editFormData_personalDetails",
    "editFormData_addresses",
    "editFormData_accountLogin",
    "editFormData_companyDetails",
    "editFormData_roles",
];

const selectedDataKeys = [
  'personalDetails',
  'addresses',
  'companyDetails',
  'accountLoginDetails',
  'roles'
]

const AUTH_API_KEY = import.meta.env.VITE_AUTH_API_KEY;

export function EditMultiStepFormProvider({ children }) {
    /*
    * States
    */
    const { selected_faculty } = usePage().props;
    const [ step, setStep ] = useState(0);
    const [ selectedFacultyDetails, setSelectedFacultyDetails ] = useState(selected_faculty)
    const [ formDetails, setFormDetails ] = useState([]);

    /*
    * Functions
    *
    */
    const previousStep = () => {
      setStep((step)=>step - 1);
    }

    const nextStep = () => {
      setStep((step)=>step + 1);
    }

    function onFormNavigate({ formKey, formData }){
      setSelectedFacultyDetails((el)=>({
        ...el,
        [formKey]: {
          ...el[formKey],
           ...formData
          },
        }));
    }

    function onSubmitForm(submittedData) {
        const { roles_id } = submittedData;
        const mergedData = {...selectedFacultyDetails, roles : {'roles_id': roles_id}}
        router.put(route("admin.faculty.update", {faculty: selected_faculty.id}), mergedData, {
            onError: (errors) => {
                console.log(errors);
            },
            onSuccess: (success) => {
                localStorage.clear();
            },
        });
    }

    return (
        <EditMultiStepFormContext.Provider value={{ step, selectedFacultyDetails, previousStep, nextStep, onSubmitForm, onFormNavigate, AUTH_API_KEY }}>
            {children}
        </EditMultiStepFormContext.Provider>
    );
}

export function useEditMultiStepForm() {
    const context = useContext(EditMultiStepFormContext);
    if (context === undefined) throw new Error("Context used outside scope!");
    return context;
}
