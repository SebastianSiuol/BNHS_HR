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
            'name' => 'Master Teacher I'
        ]);
        Designation::create([
            'name' => 'Master Teacher II'
        ]);
        Designation::create([
            'name' => 'Master Teacher III'
        ]);
        Designation::create([
            'name' => 'Master Teacher IV'
        ]);
        Designation::create([
            'name' => 'Teacher I'
        ]);
        Designation::create([
            'name' => 'Teacher II'
        ]);
        Designation::create([
            'name' => 'Teacher III'
        ]);
        Designation::create([
            'name' => 'Teacher IV'
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
