import React from 'react';
import {AuthenticatedAdminLayout} from "@/Layouts/AuthenticatedAdminLayout.jsx";

export default function Dashboard({auth}) {
    const {email} = auth;


    return (
        <>
            <AuthenticatedAdminLayout>

                <h1>Hey Dashboard 1~!</h1>
            </AuthenticatedAdminLayout>
        </>
    );
}
