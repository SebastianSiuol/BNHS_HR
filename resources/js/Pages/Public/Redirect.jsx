import * as DropdownMenu from "@radix-ui/react-dropdown-menu";
import { useState, useEffect } from "react";
import { Link, usePage, router } from "@inertiajs/react";
import { SchoolLogo } from "@/Components/SchoolLogo.jsx";

import { IoIosArrowDown, IoIosArrowUp } from "react-icons/io";


export default function Redirect() {
    const [userContextMenu, setUserContextMenu] = useState(false);
    const { auth, role : userRoles } = usePage().props;

    return (
        <div className="min-h-screen bg-[#f4f6f9] font-poppins">
            {/* Header */}
            <div className="py-2 px-16 max-w-full bg-[#163172] text-white">
                <div className={"flex justify-between"}>
                        <div className="flex space-x-2 items-center justify-center">
                            <SchoolLogo type={"sidebar"} />

                            <h3 className="font-bold text-xl md:block hidden">Batasan Hills National Highschool</h3>
                        </div>

                    <DropdownMenu.Root
                        open={userContextMenu}
                        onOpenChange={() => {
                            setUserContextMenu((value) => !value);
                        }}
                    >
                        <div className="flex items-center justify-center w-min-[30vh] w-max-[50vh]">
                            <DropdownMenu.Trigger className="items-center space-x-4 flex">
                                <div className={"md:block hidden"}>
                                    <h6 className="font-bold">{auth.email}</h6>
                                    <p className="text-normal text-end">{ userRoles.includes('hr_admin') && ('Admin | ') }Faculty</p>
                                </div>
                                {userContextMenu ? <IoIosArrowUp className={"text-2xl"} /> : <IoIosArrowDown className={"text-2xl"} />}
                            </DropdownMenu.Trigger>

                            <DropdownMenu.Content className="z-50 w-min-[30vh] w-max-[50vh] text-base bg-white divide-gray-100 rounded shadow">
                                {userRoles.includes('hr_admin') && (<Link
                                    href={route('admin.dashboard')}
                                    className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                                >
                                    Switch to Admin
                                </Link>)}
                                <DropdownMenu.Item>
                                    <button onClick={()=>{router.post(route('session.destroy'))}} className="block px-4 py-2 text-sm text-red-700 w-full text-left hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </DropdownMenu.Item>
                            </DropdownMenu.Content>
                        </div>
                    </DropdownMenu.Root>
                </div>
            </div>

            {/* Main Content */}
            <main className="flex flex-col mx-auto my-20 max-w-[1280px]">
                <SystemOptions />
            </main>
        </div>
    );
}

function SystemOptions() {
    return (
        <>
            <h2 className="mb-6 font-bold text-2xl text-center text-gray-800">
                System Options:
            </h2>

            <div className="mx-auto bg-white p-4 border border-gray-400 rounded-xl shadow-lg">
                <div className="p-4 w-full space-y-6">
                    <div>
                        <Link className={"text-2xl text-blue-900 font-bold"}>
                            <div className="text-center border-4 border-blue-800 bg-blue-400 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                Student Information System
                            </div>
                        </Link>
                    </div>
                    <div>
                        <Link className={"text-2xl text-red-200 font-bold"}>
                            <div className="text-center border-4 border-red-500 bg-[#981111] px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                Human Resource
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </>
    );
}
