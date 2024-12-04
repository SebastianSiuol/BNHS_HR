<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//      NOTE: Production Data
        Role::factory()->create([
            'role_name' => 'hr_admin', // 1
        ]);

        Role::factory()->create([
            'role_name' => 'hr_manager', // 2
        ]);

        Role::factory()->create([
            'role_name' => 'hr_faculty', // 3
        ]);

        Role::factory()->create([
            'role_name' => 'sis_admin', // 4
        ]);

        Role::factory()->create([
            'role_name' => 'sis_registrar', // 5
        ]);

        Role::factory()->create([
            'role_name' => 'sis_faculty', // 6
        ]);

        Role::factory()->create([
            'role_name' => 'logi_admin', // 7
        ]);

        Role::factory()->create([
            'role_name' => 'logi_faculty', // 8
        ]);


        // 0001
        Faculty::find(1)->roles()->attach([1]); // hr_admin

        // 002
        Faculty::find(2)->roles()->attach([3]); // hr_faculty

        // 0003
        Faculty::find(3)->roles()->attach([1]); // hr_admin
        Faculty::find(3)->roles()->attach([4]); // sis_admin

        // 0004
        Faculty::find(4)->roles()->attach([4]); // sis_admin
        Faculty::find(4)->roles()->attach([7]); // logi_admin

        // 0005
        Faculty::find(5)->roles()->attach([1]); // hr_admin
        Faculty::find(5)->roles()->attach([4]); // sis_admin
        Faculty::find(5)->roles()->attach([7]); // logi_admin

        // 0006
        Faculty::find(6)->roles()->attach([4]); // sis_admin

        // 0007
        Faculty::find(7)->roles()->attach([7]); // logi_admin

        // 0008
        Faculty::find(8)->roles()->attach([6]); // sis_registrar

    }
}
