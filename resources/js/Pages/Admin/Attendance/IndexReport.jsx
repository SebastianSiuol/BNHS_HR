import { AuthenticatedAdminLayout } from '@/Layouts/AuthenticatedAdminLayout.jsx';
import { PageHeaders } from '@/Components/Admin/PageHeaders.jsx';

export default function IndexReport() {
  return (
    <>
      <AuthenticatedAdminLayout>
        <PageHeaders>Atendance Report</PageHeaders>

      </AuthenticatedAdminLayout>
    </>
  )
}
