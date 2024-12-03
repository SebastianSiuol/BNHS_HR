import {GuestLayout} from "@/Layouts/GuestLayout.jsx";

import {CoverPhoto} from '@/Components/Auth/CoverPhoto';
import {LoginForm} from "@/Components/Auth/LoginForm.jsx";
import {LoginFormContainer} from "@/Components/Auth/LoginFormContainer.jsx";
import {SchoolLogo} from "@/Components/SchoolLogo.jsx";

export default function Login() {

    return (
        <GuestLayout>
            <CoverPhoto/>
            <LoginFormContainer>
                <SchoolLogo type={"welcome"} />
                <LoginForm />
            </LoginFormContainer>
        </GuestLayout>
    )
}
