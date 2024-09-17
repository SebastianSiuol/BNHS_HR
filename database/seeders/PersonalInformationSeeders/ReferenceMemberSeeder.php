<?php

namespace Database\Seeders\PersonalInformationSeeders;

use App\Models\PersonalInformation\PersonalInformation;
use App\Models\PersonalInformation\ReferenceMember;
use Illuminate\Database\Seeder;

class ReferenceMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ref_member = new ReferenceMember();
        $ref_member->name = 'John Doe';
        $ref_member->contact_number = '09987654321';
        $ref_member->address = 'Quezon City';
        $ref_member->reference_number = '1';
        $ref_member->personal_information_id = PersonalInformation::find(1)->id;
        $ref_member->save();

        $ref_member = new ReferenceMember();
        $ref_member->name = 'Jane Doe';
        $ref_member->contact_number = '09987654321';
        $ref_member->address = 'Quezon City';
        $ref_member->reference_number = '1';
        $ref_member->personal_information_id = PersonalInformation::find(2)->id;
        $ref_member->save();

        $ref_member = new ReferenceMember();
        $ref_member->name = 'Mike Doe';
        $ref_member->contact_number = '09987654321';
        $ref_member->address = 'Quezon City';
        $ref_member->reference_number = '1';
        $ref_member->personal_information_id = PersonalInformation::find(3)->id;
        $ref_member->save();

        $ref_member = new ReferenceMember();
        $ref_member->name = 'Ellis Doe';
        $ref_member->contact_number = '09987654321';
        $ref_member->address = 'Quezon City';
        $ref_member->reference_number = '1';
        $ref_member->personal_information_id = PersonalInformation::find(4)->id;
        $ref_member->save();

        $ref_member = new ReferenceMember();
        $ref_member->name = 'Tupac Doe';
        $ref_member->contact_number = '09987654321';
        $ref_member->address = 'Quezon City';
        $ref_member->reference_number = '1';
        $ref_member->personal_information_id = PersonalInformation::find(5)->id;
        $ref_member->save();

        $ref_member = new ReferenceMember();
        $ref_member->name = 'Treepac Doe';
        $ref_member->contact_number = '09987654321';
        $ref_member->address = 'Quezon City';
        $ref_member->reference_number = '1';
        $ref_member->personal_information_id = PersonalInformation::find(6)->id;
        $ref_member->save();

    }
}
