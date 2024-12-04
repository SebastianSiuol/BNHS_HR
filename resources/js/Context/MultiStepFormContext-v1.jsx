import {
    createContext,
    useEffect,
    useContext,
    useReducer,
    useState,
} from "react";
import { useForm } from "@inertiajs/react";
import { z } from "zod";

const MultiStepFormContext = createContext();

const inputSchema = z.object({
    first_name: z.string().email(),
});

export function MultiStepFormProvider({ children }) {
    const [submitData, setSubmitData] = useState({});

    const { data, setData, errors, setError } = useForm({

    });

    function firstStepFormFinish() {

        const result = inputSchema.safeParse(data);

        if(result.success){
            console.log("Success");
        } else{
            console.log(result.error)
        }


        setSubmitData((x) => ({...x, data}));
    }

















    return (
        <MultiStepFormContext.Provider
            value={{
                data,
                errors,
                setData,
                firstStepFormFinish,
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
