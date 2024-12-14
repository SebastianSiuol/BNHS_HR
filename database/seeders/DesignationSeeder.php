<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\FacultyAccountInformation\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//      NOTE: Production Data
        Designation::create([
            'name' => 'Math Department Head',
            'department_id' => 1,
        ]);
        Designation::create([
            'name' => 'Mathematics Instructor',
            'department_id' => 1,
        ]);

        Designation::create([
            'name' => 'Science Coordinator',
            'department_id' => 2,
        ]);
        Designation::create([
            'name' => 'Biology Teacher',
            'department_id' => 2,
        ]);

        Designation::create([
            'name' => 'English Head',
            'department_id' => 3,
        ]);
        Designation::create([
            'name' => 'Literature Instructor',
            'department_id' => 3,
        ]);

        Designation::create([
            'name' => 'Social Studies Chair',
            'department_id' => 4,
        ]);
        Designation::create([
            'name' => 'History Instructor',
            'department_id' => 4,
        ]);

        Designation::create([
            'name' => 'TLE Department Head',
            'department_id' => 5,
        ]);
        Designation::create([
            'name' => 'Home Economics Instructor',
            'department_id' => 5,
        ]);

        Designation::create([
            'name' => 'MAPEH Coordinator',
            'department_id' => 6,
        ]);
        Designation::create([
            'name' => 'Physical Education Teacher',
            'department_id' => 6,
        ]);

        Designation::create([
            'name' => 'Values Education Coordinator',
            'department_id' => 7,
        ]);
        Designation::create([
            'name' => 'Guidance Counselor',
            'department_id' => 7,
        ]);

        $faculty = Faculty::find(1);
        $faculty->designation_id = 1;
        $faculty->save();

        $faculty = Faculty::find(2);
        $faculty->designation_id = 9;
        $faculty->save();

        $faculty = Faculty::find(3);
        $faculty->designation_id = 6;
        $faculty->save();

        $faculty = Faculty::find(4);
        $faculty->designation_id = 7;
        $faculty->save();

        $faculty = Faculty::find(5);
        $faculty->designation_id = 10;
        $faculty->save();

        $faculty = Faculty::find(6);
        $faculty->designation_id = 11;
        $faculty->save();

        $faculty = Faculty::find(7);
        $faculty->designation_id = 5;
        $faculty->save();

        $faculty = Faculty::find(8);
        $faculty->designation_id = 4;
        $faculty->save();

        $faculty = Faculty::find(9);
        $faculty->designation_id = 2;
        $faculty->save();

        $faculty = Faculty::find(10);
        $faculty->designation_id = 9;
        $faculty->save();

    }
}
