<?php

namespace Database\Seeders\PersonalInformationSeeders;

use App\Models\Faculty;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalInformation::factory()->create([
            'first_name' => 'John',
            'middle_name' => 'Merlin',
            'last_name' => 'Santiago',
            'sex' => 'Male',
            'date_of_birth' => '01-01-1993',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);

        PersonalInformation::factory()->create([
            'first_name' => 'Adam',
            'middle_name' => '',
            'last_name' => 'Bakers',
            'sex' => 'Male',
            'date_of_birth' => '01-01-1995',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);

        PersonalInformation::factory()->create([
            'first_name' => 'Ryan',
            'middle_name' => 'Deludo',
            'last_name' => 'Vasquez',
            'sex' => 'Male',
            'date_of_birth' => '01-01-1997',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Romeo',
            'middle_name' => 'Juleite',
            'last_name' => 'Velazquez',
            'sex' => 'Male',
            'date_of_birth' => '01-01-2000',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Davy',
            'middle_name' => 'Jonas',
            'last_name' => 'Dakito',
            'sex' => 'Male',
            'date_of_birth' => '01-01-2000',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Gabriel',
            'middle_name' => '',
            'last_name' => 'Gobota',
            'sex' => 'Male',
            'date_of_birth' => '01-01-1996',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Robert',
            'middle_name' => '',
            'last_name' => 'Badong',
            'sex' => 'Male',
            'date_of_birth' => '01-01-1986',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Poppy',
            'middle_name' => 'Orlando',
            'last_name' => 'Pola',
            'sex' => 'Male',
            'date_of_birth' => '01-01-1976',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);

        $faculty_count = Faculty::count();

        for ($i = 1; $i <= $faculty_count; $i++) {
            $personal_information = PersonalInformation::find($i);
            $personal_information->faculty_id = $i;
            $personal_information->save();
        }


    }
}
