// Libraries and Dependencies
import * as DropdownMenu from "@radix-ui/react-dropdown-menu";
import { Link, usePage, router } from "@inertiajs/react";
import { useState, useEffect } from "react";
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'

// ReactIcons
import { IoIosArrowDown, IoIosArrowUp } from "react-icons/io";

// Components
import { SchoolLogo } from "@/Components/SchoolLogo";
import { FlashMessage } from "@/Components/FlashMessage";

export default function AuthenticatedFacultyLayout({ children }) {
    return (
        <div>
            <Header>
                <NavBar>
                    <MainContentContainer>{children}</MainContentContainer>
                </NavBar>
            </Header>
        </div>
    );
}

function Header({ children }) {
    const [userContextMenu, setUserContextMenu] = useState(false);
    const { auth, role : userRoles } = usePage().props;

    return (
        <>
            {/* Header */}
            <div className="py-2 px-16 max-w-full bg-[#163172] text-white">
                <div className={"flex justify-between"}>
                    <Link href={route("faculty.dashboard")}>
                        <div className="flex space-x-2 items-center justify-center">
                            <SchoolLogo type={"sidebar"} />

                            <h3 className="font-bold text-xl md:block hidden">Batasan Hills National Highschool</h3>
                        </div>
                    </Link>

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

            {children}
        </>
    );
}

function NavBar({ children }) {
    const { role : userRoles } = usePage().props;
    const [sisMenu, setSISMenu] = useState(false);

    const sisRoles = ["sis_admin", "sis_registrar", "sis_faculty"]; // Roles that can see the dropdown


    return (
        <>
            <div className={"flex py-4 justify-center bg-[#d6e4f0]"}>
                <nav className={"text-lg items-center space-x-16"}>
                    <NavBarLink href={route("faculty.dashboard")} active={route().current("faculty.dashboard")}>Home</NavBarLink>
                    <NavBarLink href={route("faculty.leaves.index")} active={route().current("faculty.leaves.create") || route().current("faculty.leaves.index")}>Leave Request</NavBarLink>
                    <NavBarLink href={route('faculty.rpms.index')} active={route().current("faculty.rpms.index")}>RPMS</NavBarLink>
                    <NavBarLink href={route('faculty.attendance.index')} active={route().current("faculty.attendance.index")}>Attendance</NavBarLink>
                    <NavBarLink href={route('faculty.personal-details.index')} active={route().current("faculty.personal-details.index")}>Personal Detail</NavBarLink>
                    {userRoles.some((role) => sisRoles.includes(role)) && (
                    <DropdownMenu.Root
                        open={sisMenu}
                        onOpenChange={() => {
                            setSISMenu((value) => !value);
                        }}>
                            <DropdownMenu.Trigger className="transition-all duration-200 hover:font-bold hover:border-b-gray-900 hover:border-b-4">
                                <div className={'flex'}>
                                    <span>SIS</span>
                                    {sisMenu
                                        ? <IoIosArrowUp className={"text-2xl"} />
                                        : <IoIosArrowDown className={"text-2xl"} />
                                    }
                                </div>
                            </DropdownMenu.Trigger>

                            <DropdownMenu.Content className="z-50 w-min-[30vh] w-max-[50vh] text-base bg-white divide-gray-100 rounded shadow">
                                <DropdownMenu.Item>
                                    {userRoles.includes("sis_admin") && (<Link
                                    className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                                    href={route('sis.admin.redirect')}>SIS Admin</Link>)}
                                </DropdownMenu.Item>
                                <DropdownMenu.Item>
                                    {userRoles.includes("sis_registrar") && (<Link
                                    className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                                    href={route('sis.admin.redirect')}>SIS Registrar</Link>)}
                                </DropdownMenu.Item>
                                <DropdownMenu.Item>

                                    {userRoles.includes("sis_faculty") && (<Link
                                    className="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100"
                                    href={route('sis.faculty.redirect')}>SIS Faculty</Link>)}
                                </DropdownMenu.Item>
                            </DropdownMenu.Content>
                    </DropdownMenu.Root>)}
                    {userRoles.includes("logi_admin") && (<NavBarLink href={route('logistics.admin.redirect')}>Logistics</NavBarLink>)}
                </nav>
            </div>

            {children}
        </>
    );
}

function MainContentContainer({ children }) {
    const { flash, errors: validationError } = usePage().props;
    const [ flashMessage, setFlashMessage ] = useState(flash);

    const serverValidationError = validationError || null;
    const combinedErrors = Object.values(serverValidationError).flat().map((error) => error);

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
        if(Object.keys(validationError). length !== 0){

            validationSwal(combinedErrors);
        }
    }, [validationError]);

    return (
        <>
            <div className="fixed">{flashMessage && <FlashMessage flash={flashMessage} />}</div>
            <main className={"flex mx-auto max-w-[1280px] my-16 justify-center"}>{children}</main>;
        </>
    );
}

function NavBarLink({ active = false, children, ...props }) {
    const isActiveClasses = {
        true: "font-bold border border-b-gray-900 border-b-4 hover:text-gray-800 hover:border-b-gray-800 ",
        false: "hover:font-bold hover:border-b-gray-900 hover:border-b-4 ",
    };

    return (
        <Link {...props} className={"transition-all duration-200 " + isActiveClasses[active]}>
            {children}
        </Link>
    );
}

function validationSwal( error ) {

    const swalText = error.join(' <br/> ');

    withReactContent(Swal).fire({
        title: <p>Server Validation</p>,
        icon: 'error',
        html: swalText,
        confirmButtonText: 'Confirm',
        customClass: {
            container: '...',
            popup: 'border rounded-3xl',
            header: '...',
            title: 'text-gray-700',
            icon: '...',
            htmlContainer: '...',
            validationMessage: '...',
            actions: '...',
            confirmButton: 'bg-blue-600',
          }
    });
}