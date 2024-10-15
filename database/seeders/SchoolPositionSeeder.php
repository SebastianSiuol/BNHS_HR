<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\SchoolPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = new SchoolPosition();
        $seeder->name = 'Teacher I';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Teacher II';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Teacher III';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Head Teacher I';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Head Teacher II';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Head Teacher III';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'School Principal I';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'School Principal II';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'School Principal III';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Assistant School Principal I';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Assistant School Principal II';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->name = 'Assistant School Principal III';
        $seeder->save();

        $count = Faculty::all()->count();
        $position_count = SchoolPosition::all()->count();

        for ($i = 1; $i < $count+1; $i++) {
            $faculty = Faculty::find($i);
            $faculty->school_position_id = rand(1, $position_count);
            $faculty->save();
        }
    }
}
