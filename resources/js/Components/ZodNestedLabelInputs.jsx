import React from "react";
import { LabelInput } from "@/Components/LabelInput";


export function ZodNestedLabelInputs({
    id,
    label,
    register,
    placeholder,
    color = "black",
    width = "normal",
    errors,
    disabled = false,
    ...props
}) {


    // Access the nested error for this specific field
    // const err = id.split(".").reduce((acc, key) => acc?.[key], errors);
    console.log(errors);

    return (
        <LabelInput
            id={id}
            label={label}
            register={register}
            placeholder={placeholder}
            color={color}
            width={width}
            disabled={disabled}
            error={errors} // Pass the specific error
            {...props}
        />
    );
}
