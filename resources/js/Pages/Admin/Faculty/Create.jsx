// Components
import {AuthenticatedAdminLayout} from "@/Layouts/AuthenticatedAdminLayout.jsx";
import {PageHeaders} from "@/Components/Admin/PageHeaders.jsx";

function Create({auth}) {
    return (
        <>
            <AuthenticatedAdminLayout auth={auth}>
                <PageHeaders>Create a Faculty Account</PageHeaders>
            </AuthenticatedAdminLayout>
        </>
    );
}

export default Create;
