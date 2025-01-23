function mergedClass(...classes) {
    return classes.filter(Boolean).join(" ");
}

// For React Hook Forms
const fontColor = {
    white: "text-white ",
    black: "text-black ",
};

const fontWidth = {
    normal: "font-normal ",
    bold: "font-bold ",
};

export function LabelInput({
    id,
    label,
    register,
    placeholder,
    color = "black",
    width = "normal",
    error,
    disabled = false,
    ...props
}) {
    return (
        <>
            <label
                className={
                    "my-2 text-sm space-y-2 " +
                    fontColor[color] +
                    fontWidth[width]
                }
            >
                <span>{label}</span>
                <Input
                    id={id}
                    register={register}
                    placeholder={placeholder ?? label}
                    error={error}
                    disabled={disabled}
                    {...props}
                />
            </label>
        </>
    );
}

function Input({ id, register, type, placeholder, disabled, error, ...props }) {
    const inputClass =
        "w-full p-2.5 text-gray-900 text-sm bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-600 focus:border-blue-600";

    return (
        <>
            <input
                {...register(`${id}`)}
                type={"text"}
                placeholder={placeholder}
                disabled={disabled}
                className={mergedClass(
                    inputClass,
                    error?.[id] && "border-red-500",
                    disabled && " bg-gray-500/20 cursor-not-allowed "
                )}
                {...props}
            />

            {error && (
                <div className="flex justify-end">
                    <p className="text-red-500 text-sm italic">
                        {error?.[id]?.message}
                    </p>
                </div>
            )}
        </>
    );
}
