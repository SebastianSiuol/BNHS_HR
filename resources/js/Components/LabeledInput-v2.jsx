// For Value and onChange

export function LabeledInput({ id, label, color, width, value, onChange, required, placeholder, error}) {
    const fontColor = {
        white: "text-white ",
        black: "text-black ",
    };

    const fontWidth = {
        normal: "font-normal ",
        bold: "font-bold ",
    };

    return (
        <div className={"my-2"}>
            {/* Label El */}
            {label && (
                <label
                    htmlFor={id}
                    className={
                        "mb-2 text-sm " + fontColor[color] + fontWidth[width]
                    }
                >
                    {label}
                </label>
            )}

            {/* Input El */}
            <input
                id={id}
                className={
                    "w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                }
                value={value}
                onChange={onChange}
                type={"text"}
                placeholder={placeholder}
                required={required}
            />

            {error && (
            <div className="flex justify-end">
                <p className="text-red-500 text-sm italic">{error}</p>
            </div>)}
        </div>
    );
}
