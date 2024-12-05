// For React Hook Forms
export function LabeledInput ({  id, register, label, placeholder, color, width, error, ...props}) {

    const fontColor = {
        white: "text-white ",
        black: "text-black ",
    };

    const fontWidth = {
        normal: "font-normal ",
        bold: "font-bold ",
    };

    const inputClass =
        "w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-blue-600 focus:border-blue-600" ;


    return (
        <div className={"my-2"}>
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

            <input
                {...props}
                {...register(`${id}`)}
                id={id}
                type={"text"}
                placeholder={placeholder}
                className={inputClass + (error[id] ? ' border-red-500 ' : '')}
            />


            {error && (
                <div className="flex justify-end">
                    <p className="text-red-500 text-sm italic">{error[id]?.message}</p>
                </div>
            )}
        </div>
    );
}
