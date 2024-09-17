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
        $leave_types->name = 'Active';
        $leave_types->save();

        $leave_types = new LeaveType();
        $leave_types->name = 'Dismissed';
        $leave_types->save();

        $leave_types = new LeaveType();
        $leave_types->name = 'On-Leave';
        $leave_types->save();

        $leave_types = new LeaveType();
        $leave_types->name = 'Transferred';
        $leave_types->save();

    }
}
