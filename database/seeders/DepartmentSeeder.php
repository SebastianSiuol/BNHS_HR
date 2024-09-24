<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\FacultyAccountInformation\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//      NOTE: Production Data
        Department::create([
            'name' => 'Mathematics'
        ]);
        Department::create([
            'name' => 'Science'
        ]);
        Department::create([
            'name' => 'English'
        ]);
        Department::create([
            'name' => 'Social Studies'
        ]);
        Department::create([
            'name' => 'Technology and Livelihood Education'
        ]);
        Department::create([
            'name' => 'Music, Arts, Physical Education, and Health'
        ]);
        Department::create([
            'name' => 'Values Education'
        ]);



    }
}
