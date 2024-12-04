<?php

namespace Database\Seeders\PersonalInformationSeeders;

use App\Models\PersonalInformation\PermanentAddress;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Database\Seeder;

class PermanentAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = PersonalInformation::count();

        PermanentAddress::factory($count)->create();


        for($i = 1; $i <= $count; $i++) {
            $residential_address = PermanentAddress::find($count);
            $residential_address->personal_information_id = $count;
            $residential_address->save();
        }

    }
}
