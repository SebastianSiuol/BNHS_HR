import { createPortal } from "react-dom";

export default function Modal({ toggle, onToggle, children }) {
    if (!toggle) return null;

    function handleOnClick(e) {
        e.stopPropagation();
        onToggle();
    }

    return createPortal(
        <>
            <div className="fixed flex justify-center items-center bg-darken overflow-y-auto overflow-x-hidden inset-0 z-50">
                <div className={"h-full"}>
                    <div className={"relative bg-gray-100 rounded-xl p-4 shadow transition-all"}>
                        <button onClick={handleOnClick} className={"absolute top-2 right-2 p-1 text-xl rounded-lg text-gray-800 hover:bg-gray-300/20 hover:text-gray-600 transition"}>
                            &times;
                        </button>

                        <div>{children}</div>
                    </div>
                </div>
            </div>
        </>,
        document.getElementById("portal")
    );
}
