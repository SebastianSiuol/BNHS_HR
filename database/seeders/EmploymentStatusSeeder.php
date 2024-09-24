<?php

namespace Database\Seeders;

use App\Models\FacultyAccountInformation\EmploymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = new EmploymentStatus([]);
        $seeder->name = 'Active';
        $seeder->save();

        $seeder = new EmploymentStatus([]);
        $seeder->name = 'On-Leave';
        $seeder->save();

        $seeder = new EmploymentStatus([]);
        $seeder->name = 'Dismissed';
        $seeder->save();

        $seeder = new EmploymentStatus([]);
        $seeder->name = 'Transferred';
        $seeder->save();
    }
}
