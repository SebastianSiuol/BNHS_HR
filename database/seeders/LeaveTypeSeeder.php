<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leave_types = new LeaveType();
        $leave_types->name = 'Paternal Leave';
        $leave_types->days = '7';
        $leave_types->save();

        $leave_types = new LeaveType();
        $leave_types->name = 'Maternal Leave';
        $leave_types->days = '120';
        $leave_types->save();

        $leave_types = new LeaveType();
        $leave_types->name = 'Service Credit';
        $leave_types->days = null;
        $leave_types->save();

    }
}
