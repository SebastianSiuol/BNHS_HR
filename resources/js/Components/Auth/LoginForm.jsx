import {Link, useForm} from "@inertiajs/react";

import {InputContainer} from "@/Components/InputContainer.jsx";
import {InputField} from "@/Components/InputField.jsx";
import {InputLabel} from "@/Components/InputLabel.jsx";

export function LoginForm({error}) {
    const {data, setData, post, processing, errors, reset} = useForm({
        'faculty_code': '',
        'password': '',
    })

    function handleSubmit(event) {
        event.preventDefault();
        post(route('login.store'), {
            preserveScroll: true,
            onSuccess: () => reset('password'),

        });
    }

    console.log(errors);

    return <>
        <div className={'mb-6 font-bold text-2xl text-center text-white'}>Log-In to your Account</div>
        <form className={'flex flex-col w-full'} onSubmit={handleSubmit}>
            <InputContainer>
                <InputLabel labelFor="faculty_code" color={'white'}>Faculty Code</InputLabel>
                <InputField id={"faculty_code"}
                            state={data.faculty_code}
                            onChange={(e) => setData("faculty_code", e.target.value)}>
                    Faculty Code
                </InputField>
            </InputContainer>

            <InputContainer>
                <InputLabel labelFor="password" color={'white'}>Password</InputLabel>
                <InputField id={"password"}
                            state={data.password}
                            onChange={(e) => setData("password", e.target.value)}
                            inputType="password">
                    Password
                </InputField>
            </InputContainer>

            <Link href={route('/')} className={'ml-auto text-white text-sm hover:underline'}>Forgot Password?</Link>

            { error && <div>{error.message}</div>}

            <button
                className={'w-full my-5 py-2 text-center bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400'}>Log-In
            </button>
        </form>

        <p className="text-white text-center text-sm mt-4">
            By using this service, you understand and agree to the Terms and Conditions of the system.
        </p>
    </>;
}
