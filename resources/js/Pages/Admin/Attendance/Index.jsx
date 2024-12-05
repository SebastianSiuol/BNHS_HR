import { AuthenticatedAdminLayout } from '@/Layouts/AuthenticatedAdminLayout.jsx';
import { PageHeaders } from '@/Components/Admin/PageHeaders.jsx';

export default function Index() {
  return (
    <>
      <AuthenticatedAdminLayout>
        <PageHeaders>Daily Attendance</PageHeaders>

      </AuthenticatedAdminLayout>
    </>
  )
}
