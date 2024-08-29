<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'department_name' => 'Mathematics'
        ]);
        Department::create([
            'department_name' => 'Science'
        ]);
        Department::create([
            'department_name' => 'English'
        ]);
        Department::create([
            'department_name' => 'Social Studies'
        ]);
        Department::create([
            'department_name' => 'Technology and Livelihood Education'
        ]);
        Department::create([
            'department_name' => 'Music, Arts, Physical Education, and Health'
        ]);
        Department::create([
            'department_name' => 'Values Education'
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
