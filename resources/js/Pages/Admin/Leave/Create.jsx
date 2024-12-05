import { AuthenticatedAdminLayout } from '@/Layouts/AuthenticatedAdminLayout.jsx';
import { PageHeaders } from '@/Components/Admin/PageHeaders.jsx';

export default function Create() {
  return (
    <>
      <AuthenticatedAdminLayout>
        <PageHeaders>Request Leave</PageHeaders>

      </AuthenticatedAdminLayout>
    </>
  )
}
