import {
    Link,
    useForm as useInertiaForm,
    router,
    usePage,
} from "@inertiajs/react";
import { useForm } from "react-hook-form";
import { useState, useEffect } from "react";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";

import { SchoolLogo } from "@/Components/SchoolLogo.jsx";
import { FlashMessage } from "@/Components/FlashMessage";

export default function ForgotPassword() {
    const [email, setEmail] = useState("");
    const { flash, errors: validationError } = usePage().props;
    const [flashMessage, setFlashMessage] = useState(flash);
    const [emailSent, setEmailSent] = useState(false);
    const [isLoading, setIsLoading] = useState(false);

    const serverValidationError = validationError || null;
    const combinedErrors = Object.values(serverValidationError)
        .flat()
        .map((error) => error);

    useEffect(() => {
        setFlashMessage(flash);

        let flashTimer = setTimeout(() => {
            setFlashMessage(null);
        }, 5000);

        return () => {
            setFlashMessage(null), clearTimeout(flashTimer);
        };
    }, [flash]);

    useEffect(() => {
        if (Object.keys(validationError).length !== 0) {
            validationSwal(combinedErrors);
        }
    }, [validationError]);

    function handleSubmit(e) {
        e.preventDefault();
        setIsLoading(true);
        router.post(
            route("auth.forgot-password.store"),
            { email },
            {
                onSuccess: () => {
                    setEmailSent(true);
                    setIsLoading(false);
                },
                onError: () => {
                  setIsLoading(false);

                }
            }
        );
    }

    return (
        <div className="min-h-screen bg-[#f4f6f9] font-poppins">
            {/* Header */}
            <div className="flex py-2 px-16 justify-between bg-[#163172] text-white">
                <div className="flex space-x-2 items-center justify-center">
                    <SchoolLogo type={"sidebar"} />

                    <h3 className="font-bold text-xl">
                        Batasan Hills National Highschool
                    </h3>
                </div>
            </div>

            {/* Main Content */}
            <main className="flex flex-col mx-auto my-20 max-w-[1280px]">
                <div className="fixed">
                    {flashMessage && <FlashMessage flash={flashMessage} />}
                </div>
                {emailSent ? (
                    <EmailSent />
                ) : (
                    <PasswordForm
                        onHandleSubmit={handleSubmit}
                        value={email}
                        onChange={setEmail}
                        isLoading={isLoading}
                    />
                )}
            </main>
        </div>
    );
}

function EmailSent() {
    return (
        <>
            <h2 className="mb-6 font-bold text-2xl text-center text-gray-800">
                Link Sent
            </h2>

            {/* Form */}
            <div className="mx-auto bg-white p-4 border border-gray-400 rounded-xl shadow-lg">
                <form className="w-auto">
                    <div className="mt-4 w-[20vw] h-[20vh]">
                        <p className="block text-gray-900 text-md text-center font-semibold mb-2">
                            Reset link has been sent! <br />
                            If the email exists, confirm the password reset.
                        </p>
                    </div>
                </form>
            </div>
        </>
    );
}

function PasswordForm({ onHandleSubmit, value, onChange, isLoading }) {
  console.log(isLoading);
    return (
        <>
            <h2 className="mb-6 font-bold text-2xl text-center text-gray-800">
                Reset your Password
            </h2>

            {/* Form */}
            <div className="mx-auto bg-white p-4 border border-gray-400 rounded-xl shadow-lg">
                <form
                    onSubmit={onHandleSubmit}
                    className="w-auto">
                    <div className="mt-4">
                        <label
                            className="block text-gray-600 text-sm font-semibold mb-2"
                            htmlFor="email">
                            Faculty Email
                        </label>
                        <input
                            className={`w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 ${
                              isLoading ? "bg-gray-200 cursor-not-allowed" : "focus:ring-blue-400"
                          }`}
                            name="email"
                            id="email"
                            type="text"
                            required
                            placeholder="Faculty Email"
                            value={value}
                            onChange={(e) => onChange(e.target.value)}
                        />
                    </div>

                    <div className="my-8">
                        <button
                            id="submit-login-button"
                            type="submit"
                            disabled={isLoading}
                            className={`w-full block text-center py-2 rounded-lg focus:outline-none focus:ring-2 ${
                              isLoading
                                  ? "bg-gray-400 cursor-not-allowed"
                                  : "bg-blue-500 hover:bg-blue-600 text-white focus:ring-blue-400"
                          }`}>
                            {isLoading ? "Sending..." : "Send Code"}
                        </button>
                    </div>

                    <Link
                        href={route("login.create")}
                        className="block text-center text-blue-900 hover:text-blue-400">
                        Sign In Instead
                    </Link>
                </form>
            </div>
        </>
    );
}

function validationSwal(error) {
    const swalText = error.join(" <br/> ");

    withReactContent(Swal).fire({
        title: <p>Server Validation</p>,
        icon: "error",
        html: swalText,
        confirmButtonText: "Confirm",
        customClass: {
            container: "...",
            popup: "border rounded-3xl",
            header: "...",
            title: "text-gray-700",
            icon: "...",
            htmlContainer: "...",
            validationMessage: "...",
            actions: "...",
            confirmButton: "bg-blue-600",
        },
    });
}
