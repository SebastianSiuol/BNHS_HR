import React from 'react';
import {AuthenticatedAdminLayout} from "@/Layouts/AuthenticatedAdminLayout.jsx";

export default function Dashboard({auth}) {
    const {email} = auth;


    return (
        <>
            <AuthenticatedAdminLayout>
                <h1>Hey!</h1>
            </AuthenticatedAdminLayout>
        </>
    );
}
