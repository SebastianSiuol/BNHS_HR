<?php

namespace Database\Seeders\PersonalInformationSeeders;

use App\Models\PersonalInformation\ContactPerson;
use Illuminate\Database\Seeder;

class ContactPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cont_psn = new ContactPerson();
        $cont_psn->name = 'John Miguel';
        $cont_psn->contact_no = '09876543321';
        $cont_psn->personal_information_id = 1;
        $cont_psn->save();

        $cont_psn = new ContactPerson();
        $cont_psn->name = 'John Santiago';
        $cont_psn->contact_no = '09876543321';
        $cont_psn->personal_information_id = 2;
        $cont_psn->save();

        $cont_psn = new ContactPerson();
        $cont_psn->name = 'Mikaela Bumaga';
        $cont_psn->contact_no = '09876543321';
        $cont_psn->personal_information_id = 3;
        $cont_psn->save();

        $cont_psn = new ContactPerson();
        $cont_psn->name = 'Tree Swam';
        $cont_psn->contact_no = '09876543321';
        $cont_psn->personal_information_id = 4;
        $cont_psn->save();

        $cont_psn = new ContactPerson();
        $cont_psn->name = 'Mike Tyson';
        $cont_psn->contact_no = '09876543321';
        $cont_psn->personal_information_id = 5;
        $cont_psn->save();

        $cont_psn = new ContactPerson();
        $cont_psn->name = 'Krime Pai';
        $cont_psn->contact_no = '09876543321';
        $cont_psn->personal_information_id = 6;
        $cont_psn->save();
    }
}
