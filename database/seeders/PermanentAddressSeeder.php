<?php

namespace Database\Seeders;

use App\Models\FacultyInformation\PermanentAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermanentAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermanentAddress::factory(6)->create();

        $permanent_address = PermanentAddress::find(1);
        $permanent_address->personal_information_id = 1;
        $permanent_address->save();
        $permanent_address = PermanentAddress::find(2);
        $permanent_address->personal_information_id = 2;
        $permanent_address->save();
        $permanent_address = PermanentAddress::find(3);
        $permanent_address->personal_information_id = 3;
        $permanent_address->save();
        $permanent_address = PermanentAddress::find(4);
        $permanent_address->personal_information_id = 4;
        $permanent_address->save();
        $permanent_address = PermanentAddress::find(5);
        $permanent_address->personal_information_id = 5;
        $permanent_address->save();
        $permanent_address = PermanentAddress::find(6);
        $permanent_address->personal_information_id = 6;
        $permanent_address->save();
    }
}
