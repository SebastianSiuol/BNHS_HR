<?php

namespace Database\Seeders;

use App\Models\Designation;
use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'department_designation' => 'Master Teacher I'
        ]);
        Designation::create([
            'department_designation' => 'Master Teacher II'
        ]);
        Designation::create([
            'department_designation' => 'Master Teacher III'
        ]);
        Designation::create([
            'department_designation' => 'Master Teacher IV'
        ]);
        Designation::create([
            'department_designation' => 'Teacher I'
        ]);
        Designation::create([
            'department_designation' => 'Teacher II'
        ]);
        Designation::create([
            'department_designation' => 'Teacher III'
        ]);
        Designation::create([
            'department_designation' => 'Teacher IV'
        ]);

        $faculty = Faculty::find(1);
        $faculty->designation_id = 1;
        $faculty->save();
        $faculty = Faculty::find(2);
        $faculty->designation_id = 5;
        $faculty->save();
        $faculty = Faculty::find(3);
        $faculty->designation_id = 6;
        $faculty->save();
        $faculty = Faculty::find(4);
        $faculty->designation_id = 7;
        $faculty->save();
        $faculty = Faculty::find(5);
        $faculty->designation_id = 6;
        $faculty->save();
        $faculty = Faculty::find(6);
        $faculty->designation_id = 5;
        $faculty->save();
    }
}
