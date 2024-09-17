<?php

namespace Database\Seeders\PersonalInformationSeeders;

use App\Models\PersonalInformation\ResidentialAddress;
use Illuminate\Database\Seeder;

class ResidentialAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResidentialAddress::factory(6)->create();

        $residential_address = ResidentialAddress::find(1);
        $residential_address->personal_information_id = 1;
        $residential_address->save();
        $residential_address = ResidentialAddress::find(2);
        $residential_address->personal_information_id = 2;
        $residential_address->save();
        $residential_address = ResidentialAddress::find(3);
        $residential_address->personal_information_id = 3;
        $residential_address->save();
        $residential_address = ResidentialAddress::find(4);
        $residential_address->personal_information_id = 4;
        $residential_address->save();
        $residential_address = ResidentialAddress::find(5);
        $residential_address->personal_information_id = 5;
        $residential_address->save();
        $residential_address = ResidentialAddress::find(6);
        $residential_address->personal_information_id = 6;
        $residential_address->save();
    }
}
