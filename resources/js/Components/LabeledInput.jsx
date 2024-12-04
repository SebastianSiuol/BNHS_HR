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
        "w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 " ;


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
                className={inputClass + (error[id] ? 'border-red-200' : '')}
            />


            {error && (
                <div className="flex justify-end">
                    <p className="text-red-500 text-sm italic">{error[id]?.message}</p>
                </div>
            )}
        </div>
    );
}
