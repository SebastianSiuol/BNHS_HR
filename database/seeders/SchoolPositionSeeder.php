<?php

namespace Database\Seeders;

use App\Models\Configuration\SchoolPosition;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class SchoolPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = new SchoolPosition();
        $seeder->title = 'Head Teacher';
        $seeder->level = 'leadership';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Teacher I';
        $seeder->level = 'entry';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Teacher II';
        $seeder->level = 'mid';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Teacher III';
        $seeder->level = 'mid';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Master Teacher I';
        $seeder->level = 'senior';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Master Teacher II';
        $seeder->level = 'senior';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Master Teacher III';
        $seeder->level = 'senior';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Master Teacher IV';
        $seeder->level = 'senior';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Principal';
        $seeder->level = 'leadership';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Assistant Principal';
        $seeder->level = 'leadership';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Administrative Officer';
        $seeder->level = 'mid';
        $seeder->save();

        $seeder = new SchoolPosition();
        $seeder->title = 'Administrative Assistant';
        $seeder->level = 'support';
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
