<?php

namespace Database\Seeders\PersonalInformationSeeders;

use App\Models\PersonalInformation\PermanentAddress;
use App\Models\PersonalInformation\PersonalInformation;
use App\Models\PersonalInformation\ResidentialAddress;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = PersonalInformation::count();

        ResidentialAddress::factory($count)->create();
        PermanentAddress::factory($count)->create();

        for($i = 1; $i <= $count; $i++) {
            $residential_address = ResidentialAddress::find($i);
            $residential_address->personal_information_id = $i;
            $residential_address->save();

            $permanent_address = PermanentAddress::find($i);
            $permanent_address->personal_information_id = $i;
            $permanent_address->save();
        }

    }
}
