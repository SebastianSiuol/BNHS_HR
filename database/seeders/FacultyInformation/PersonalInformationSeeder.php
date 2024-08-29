<?php

namespace Database\Seeders\FacultyInformation;

use App\Models\FacultyInformation\PersonalInformation;
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
            'name_extension' => '',
            'sex' => 'Male',
            'date_of_birth' => '1993-01-01',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);

        PersonalInformation::factory()->create([
            'first_name' => 'Adam',
            'middle_name' => '',
            'last_name' => 'Bakers',
            'name_extension' => '',
            'sex' => 'Male',
            'date_of_birth' => '1995-01-01',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);

        PersonalInformation::factory()->create([
            'first_name' => 'Ryan',
            'middle_name' => 'Deludo',
            'last_name' => 'Vasquez',
            'name_extension' => '',
            'sex' => 'Male',
            'date_of_birth' => '1997-01-01',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Romeo',
            'middle_name' => 'Juleite',
            'last_name' => 'Velazquez',
            'name_extension' => '',
            'sex' => 'Male',
            'date_of_birth' => '2003-01-01',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Davy',
            'middle_name' => 'Jonas',
            'last_name' => 'Dakito',
            'name_extension' => '',
            'sex' => 'Male',
            'date_of_birth' => '2002-01-01',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);
        PersonalInformation::factory()->create([
            'first_name' => 'Gabriel',
            'middle_name' => '',
            'last_name' => 'Gobota',
            'name_extension' => '',
            'sex' => 'Male',
            'date_of_birth' => '1996-01-01',
            'place_of_birth' => 'Quezon City',
            'telephone_no' => '',
            'contact_no' => '09987654321',
            'civil_status_id' => 1,
        ]);

        for ($i = 1; $i <= 6; $i++) {
            $personal_information = PersonalInformation::find($i);
            $personal_information->faculty_id = $i;
            $personal_information->save();
        }


    }
}
