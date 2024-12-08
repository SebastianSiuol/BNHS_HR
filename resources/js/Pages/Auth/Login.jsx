import { Link, useForm as useInertiaForm, router } from "@inertiajs/react";
import { useForm } from 'react-hook-form'
import { useState } from 'react';

import { GuestLayout } from "@/Layouts/GuestLayout.jsx";

import { CoverPhoto } from "@/Components/Auth/CoverPhoto";
import { SchoolLogo } from "@/Components/SchoolLogo.jsx";
import { LabeledInput } from "@/Components/LabeledInput";
import { InputContainer } from "@/Components/InputContainer.jsx";
import { InputField } from "@/Components/InputField.jsx";
import { InputLabel } from "@/Components/InputLabel.jsx";

import styles from "./Login.module.css";

export default function Login() {
    return (
        <GuestLayout>
            <CoverPhoto />
            <LoginFormContainer>
                <SchoolLogo type={"welcome"} />
                <LoginForm />
            </LoginFormContainer>
        </GuestLayout>
    );
}

function LoginForm() {
    const { data, setData, post, processing, reset } = useInertiaForm({});

    const [showPassword, setShowPassword] = useState(false);

    function handleTextType() {
        setShowPassword((sP) => !sP);
    }

    function submitForm(data){
        router.post(route("login.store"), data, {
            preserveScroll: true,
            onSuccess: () => reset("password"),
        });
    }

    const { register, handleSubmit, formState: { errors }, control} = useForm({});

    return (
        <>
            <div className={"mb-6 font-bold text-2xl text-center text-white"}>Log-In to your Account</div>
            <form className={"flex flex-col w-full"} onSubmit={handleSubmit(submitForm)}>
                <LabeledInput id={"faculty_code"} register={register} label={"Faculty Code"} placeholder={"Faculty Code"} error={errors} color={"white"} width={"bold"} />

                <InputContainer>
                    <InputLabel labelFor="password" color={"white"}>
                        Password
                    </InputLabel>

                    <div className="relative">
                        <input id={"password"} className={"w-full my-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"} {...register("password")} type={!showPassword ? "password" : "text"} placeholder="Password"/>

                        <span className={"absolute inset-y-1/2 -translate-y-3 right-2 cursor-pointer"} onClick={handleTextType}>
                            {showPassword ? <img src={"/icons/close.svg"} alt={"Hide Password"} /> : <img src={"/icons/show.svg"} alt={"Show Password"} />}
                        </span>
                    </div>

                </InputContainer>

                <Link href={route("/")} className={"ml-auto text-white text-sm hover:underline"}>
                    Forgot Password?
                </Link>

                <button className={"w-full my-5 py-2 text-center bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"}>Log-In</button>
            </form>

            <p className="text-white text-center text-sm mt-4">By using this service, you understand and agree to the Terms and Conditions of the system.</p>
        </>
    );
}

function LoginFormContainer({ children }) {
    return (
        <div
            className={`${styles.div} fixed right-0 flex flex-col h-full p-8 items-center max-w-[100%]`}
        >
            {children}
        </div>
    );
}
