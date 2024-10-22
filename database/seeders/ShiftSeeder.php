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
        $shift->name = 'morning';
        $shift->from = '06:00';
        $shift->to = '12:00';
        $shift->description = 'Morning Shift';
        $shift->save();

        $shift = new Shift();
        $shift->name = 'afternoon';
        $shift->from = '12:30';
        $shift->to = '17:30';
        $shift->description = 'Afternoon Shift';
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
