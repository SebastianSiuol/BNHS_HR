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
        $leave_types = [
            ['name' => 'Maternity Leave', 'days' => 105, 'for' => 'female'],
            ['name' => 'Maternity Leave (Miscarriage/Emergency Termination)', 'days' => 60, 'for' => 'female'],
            ['name' => 'Maternity Leave (Optional Extension)', 'days' => 30, 'for' => 'female'],
            ['name' => 'Magna Carta Special Leave for Women', 'days' => 60, 'for' => 'female'],
            ['name' => 'Battered Wife Leave', 'days' => 10, 'for' => 'female'],
            ['name' => 'Parental Leave (Adoptive Mothers)', 'days' => 28, 'for' => 'female'],
            ['name' => 'Paternity Leave', 'days' => 7, 'for' => 'male'],
            ['name' => 'Parental Leave for Adoptive Fathers', 'days' => 28, 'for' => 'male'],
            ['name' => 'Solo Parent Leave', 'days' => 7, 'for' => 'both'],
            ['name' => 'Special Leave Privileges', 'days' => 3, 'for' => 'both'],
            ['name' => 'VAWC Leave (If Victim)', 'days' => 10, 'for' => 'both'],
            ['name' => 'Rehabilitation Leave', 'days' => null, 'for' => 'both', 'is_service_credits'=>true],
            ['name' => 'Study Leave', 'days' => 365, 'for' => 'both'],
            ['name'=> 'Service Credit', 'days'=>null, 'for'=>'both', 'is_service_credits'=>true],
        ];

        foreach ($leave_types as $leave) {
            LeaveType::create($leave);
        }

    }
}
