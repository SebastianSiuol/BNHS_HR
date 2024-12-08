import { Transition } from "@headlessui/react";

export function FlashMessage({ flash }) {
    const getFlashMessage = () => {
        if (flash?.success) {
            return { message: flash.success, type: "success" };
        } else if (flash?.message) {
            return { message: flash.message, type: "message" };
        } else if (flash?.error) {
            return { message: flash.error, type: "error" };
        }
        return null;
    };

    const flashData = getFlashMessage();

    if (!flashData) return null;

    const statusMessage = {
        success: "bg-green-600",
        error: "bg-red-600",
        message: "bg-blue-600",
    };

    return (
        <>
                <div
                    className={
                        "fixed right-[5vh] top-[10vh] font-bold text-lg text-white p-2 rounded-2xl shadow drop-shadow-md z-[1000] " +
                        `${statusMessage[flashData?.type]}`
                    }
                >
                    {flashData?.message}
                </div>
        </>
    );
}
