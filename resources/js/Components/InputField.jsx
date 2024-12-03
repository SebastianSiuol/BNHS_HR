import {useState} from 'react';

export function InputField({ id, state, onChange, inputType = "text", children}) {
    const [showPassword, setShowPassword] = useState(false);

    function handleTextType() {
        setShowPassword((sP) => !sP);
    }

    return <>
        <div className={'relative'}>
            <input id={id}
                   className={'w-full my-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400'}
                   value={state}
                   onChange={onChange}
                   type={inputType === "password"
                       ? !showPassword
                           ? "password"
                           : "text"
                       : "text"}
                   placeholder={children}
            />

            {inputType === "password" && (
                <span className={'absolute inset-y-1/2 -translate-y-3 right-2 cursor-pointer'} onClick={handleTextType}>
                    {showPassword
                        ? <img src={'/icons/close.svg'} alt={'Hide Password'} />
                        : <img src={'/icons/show.svg'} alt={'Show Password'}/>
                    }
                </span>
            )}
        </div>
    </>
}
