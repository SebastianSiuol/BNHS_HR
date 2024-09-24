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

        $faculty = Faculty::find(1);
        $faculty->department_id = 1;
        $faculty->save();
        $faculty = Faculty::find(2);
        $faculty->department_id = 5;
        $faculty->save();
        $faculty = Faculty::find(3);
        $faculty->department_id = 6;
        $faculty->save();
        $faculty = Faculty::find(4);
        $faculty->department_id = 7;
        $faculty->save();
        $faculty = Faculty::find(5);
        $faculty->department_id = 6;
        $faculty->save();
        $faculty = Faculty::find(6);
        $faculty->department_id = 5;
        $faculty->save();

    }
}
