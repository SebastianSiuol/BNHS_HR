<?php

namespace Database\Seeders\FacultyInformation;

use App\Models\FacultyInformation\CivilStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CivilStatus::create([
            "civil_status" => "Single"
        ]);
        CivilStatus::create([
            "civil_status" => "Married"
        ]);
        CivilStatus::create([
            "civil_status" => "Widowed"
        ]);
        CivilStatus::create([
            "civil_status" => "Separated"
        ]);
    }
}
