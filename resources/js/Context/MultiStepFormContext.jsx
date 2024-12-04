import { createContext, useEffect, useContext, useReducer, useState} from "react";
import { useForm } from "react-hook-form";
import { z } from "zod";

const MultiStepFormContext = createContext();

export function MultiStepFormProvider({ children }) {
    const [submitData, setSubmitData] = useState({});

    function nextForm(submittedData) {
        setSubmitData((data)=>({...data, submittedData}))
    }

    return (
        <MultiStepFormContext.Provider
            value={{
                nextForm,
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
