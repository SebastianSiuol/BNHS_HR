<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//      NOTE: Production Data
        $shift = new Shift();
        $shift->name = 'Morning';
        $shift->time = '06:00 AM - 12:00 PM';
        $shift->save();

        $shift = new Shift();
        $shift->name = 'Afternoon';
        $shift->time = '12:30 AM - 05:30 PM';
        $shift->save();


        $faculty = Faculty::find(1);
        $faculty->shift_id = 1;
        $faculty->save();
        $faculty = Faculty::find(2);
        $faculty->shift_id =2;
        $faculty->save();
        $faculty = Faculty::find(3);
        $faculty->shift_id = 1;
        $faculty->save();
        $faculty = Faculty::find(4);
        $faculty->shift_id = 1;
        $faculty->save();
        $faculty = Faculty::find(5);
        $faculty->shift_id = 2;
        $faculty->save();
        $faculty = Faculty::find(6);
        $faculty->shift_id = 2;
        $faculty->save();
    }
}
