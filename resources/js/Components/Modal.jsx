import { Description, Dialog, DialogPanel, DialogTitle, DialogBackdrop } from "@headlessui/react";

export default function Modal({ state, onToggle, title, children }) {
    return (
        <>
            <Dialog open={state} onClose={onToggle} transition className="relative bg-gray-600 z-50 transition duration-200 ease-out data-[closed]:opacity-0">
                <DialogBackdrop className="fixed inset-0 bg-black/30" />
                <div className="fixed inset-0 w-screen overflow-y-auto p-4">
                    <div className="flex min-h-full items-center justify-center">
                        <DialogPanel className="max-w-[80vw] space-y-4 border rounded-3xl bg-white">


                            {children}
                        </DialogPanel>
                    </div>
                </div>
            </Dialog>
        </>
    );
}
