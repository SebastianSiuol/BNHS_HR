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
  const {token, email} = usePage().props
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const { flash, errors: validationError } = usePage().props;
  const [flashMessage, setFlashMessage] = useState(flash);

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
      const payload = {
        'token' : token,
        'email' : email,
        'password' : password,
        'password_confirmation' : passwordConfirmation
      }
      router.post(route("auth.reset-password.store"), payload);
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

              <h2 className="mb-6 font-bold text-2xl text-center text-gray-800">
                  Change your password
              </h2>

              {/* Form */}
              <div className="mx-auto bg-white p-4 border border-gray-400 rounded-xl shadow-lg">
                  <form
                      onSubmit={handleSubmit}
                      className="w-auto">
                      <div className="mt-4">
                          <label
                              className="block text-gray-600 text-sm font-semibold mb-2"
                              htmlFor="password">
                              Password
                              <input
                                  className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                  name="password"
                                  id="password"
                                  type="text"
                                  required
                                  placeholder="Password"
                                  value={password}
                                  onChange={(e) => setPassword(e.target.value)}
                              />
                          </label>
                          <label
                              className="block text-gray-600 text-sm font-semibold mb-2"
                              htmlFor="password_confirmation">
                              Password Confirmation
                              <input
                                  className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                  name="password_confirmation"
                                  id="password_confirmation"
                                  type="text"
                                  required
                                  placeholder="Password"
                                  value={passwordConfirmation}
                                  onChange={(e) => setPasswordConfirmation(e.target.value)}
                              />
                          </label>
                      </div>

                      <div className="my-8">
                          <button
                              id="submit-login-button"
                              type="submit"
                              className="w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                              Reset Password
                          </button>
                      </div>
                  </form>
              </div>
          </main>
      </div>
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
