<?php

use App\Models\Configuration\RPMSConfiguration;
use Database\Seeders\CivilServiceSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\DesignationSeeder;
use Database\Seeders\EmploymentStatusSeeder;
use Database\Seeders\FacultySeeder;
use Database\Seeders\LeaveTypeSeeder;
use Database\Seeders\PersonalInformationSeeders\CivilStatusSeeder;
use Database\Seeders\PersonalInformationSeeders\ContactPersonSeeder;
use Database\Seeders\PersonalInformationSeeders\NameExtensionSeeder;
use Database\Seeders\PersonalInformationSeeders\PersonalInformationSeeder;
use Database\Seeders\PersonalInformationSeeders\ReferenceMemberSeeder;
use Database\Seeders\PersonalInformationSeeders\AddressSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RPMSSeeder;
use Database\Seeders\SchoolPositionSeeder;
use Database\Seeders\ShiftSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /* NOTE:Faculty Seeders */
        $faculty_seeder = new FacultySeeder();
        $faculty_seeder->run();

        $role_seeder = new RoleSeeder();
        $role_seeder->run();

        $civil_status_seeder = new CivilStatusSeeder();
        $civil_status_seeder->run();

        $department_seeder = new DepartmentSeeder();
        $department_seeder->run();

        $designation_seeder = new DesignationSeeder();
        $designation_seeder->run();

        $shift_seeder = new ShiftSeeder();
        $shift_seeder->run();

        $leave_type_seeder = new LeaveTypeSeeder();
        $leave_type_seeder->run();

        $employment_status = new EmploymentStatusSeeder();
        $employment_status->run();

        $school_position_seeder = new SchoolPositionSeeder();
        $school_position_seeder->run();

        /* NOTE:Personal Information Seeders */
        $personal_info_seeder = new PersonalInformationSeeder();
        $personal_info_seeder->run();

        $address_seeder = new AddressSeeder();
        $address_seeder->run();

        $reference_member_seeder = new ReferenceMemberSeeder();
        $reference_member_seeder->run();

        $contact_psn = new ContactPersonSeeder();
        $contact_psn->run();

        $name_ext_seeder = new NameExtensionSeeder();
        $name_ext_seeder->run();

        $rpms_config_seeder = new RPMSSeeder();
        $rpms_config_seeder->run();

        $seeder = new CivilServiceSeeder();
        $seeder->run();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
