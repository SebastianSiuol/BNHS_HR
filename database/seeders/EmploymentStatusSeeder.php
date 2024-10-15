<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\FacultyAccountInformation\EmploymentStatus;
use App\Models\SchoolPosition;
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
        $seeder->name = 'active';
        $seeder->save();

        $seeder = new EmploymentStatus([]);
        $seeder->name = 'on-leave';
        $seeder->save();

        $seeder = new EmploymentStatus([]);
        $seeder->name = 'dismissed';
        $seeder->save();

        $seeder = new EmploymentStatus([]);
        $seeder->name = 'transferred';
        $seeder->save();

        $count = Faculty::all()->count();

        for ($i = 1; $i < $count+1; $i++) {
            $faculty = Faculty::find($i);
            $faculty->employment_status_id = 1;
            $faculty->save();
        }
    }
}
