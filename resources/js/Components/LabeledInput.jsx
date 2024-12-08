// For React Hook Forms
const fontColor = {
    white: "text-white ",
    black: "text-black ",
};

const fontWidth = {
    normal: "font-normal ",
    bold: "font-bold ",
};

export function LabeledInput({ id, register, label, value='x', type = "store", inputType = "store", placeholder, color, width, error,  ...props }) {
    const inputClass = "w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600";

    return (
        <div className={"my-2"}>
            {label && (
                <Label id={id} label={label} color={color} width={width}/>
            )}

            {inputType === "store" && <RHFStore id={id} register={register} type={type} placeholder={placeholder} error={error} inputClass={inputClass} {...props} />}
            {inputType === "show" && <RHFShow id={id} value={value} {...props} />}
        </div>
    );
}

function RHFStore({ id, register, type, placeholder, error, inputClass, ...props }) {
    return (
        <>
            <input {...props} {...register(`${id}`)} id={id} type={type} placeholder={placeholder} className={inputClass + (error[id] ? " border-red-500 " : "")} />

            {error && (
                <div className="flex justify-end">
                    <p className="text-red-500 text-sm italic">{error[id]?.message}</p>
                </div>
            )}
        </>
    );
}

export function RHFShow({ id, value, ...props }) {
    const inputClass = "block w-full py-1.5 px-2.5 bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg";

    return (
        <>
            <input {...props} id={id} value={value} readOnly={true} className={inputClass}/>
        </>
    );
}

export function Label({ id, label, color, width, }) {
    return (
        <>
            <label htmlFor={id} className={"mb-2 text-sm " + fontColor[color] + fontWidth[width]}>
                {label}
            </label>
        </>
    );
}
