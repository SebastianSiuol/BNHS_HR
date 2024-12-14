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

        $roles = [
            [
                'role_name' => 'sis_admin', // 1
                'type' => 'sis',
                'description' => 'Admin SIS',
            ],
            [
                'role_name' => 'sis_registrar', // 2
                'type' => 'sis',
                'description' => 'Registrar SIS',
            ],
            [
                'role_name' => 'sis_faculty', // 3
                'type' => 'sis',
                'description' => 'Faculty SIS',
            ],
            // [
            //     'role_name' => 'sis_admin_dashboard',
            //     'type' => 'sis',
            //     'description' => 'Admin Dashboard SIS',
            // ],
            [
                'role_name' => 'hr_admin', // 4
                'type' => 'hr',
                'description' => 'Super Admin HR',
            ],
            // [
            //     'role_name' => 'hr_manager',
            //     'type' => 'hr',
            //     'description' => 'Manager HR',
            // ],
            [
                'role_name' => 'hr_faculty', //5
                'type' => 'hr',
                'description' => 'Faculty HR',
            ],
            // [
            //     'role_name' => 'hr_admin_dashboard',
            //     'type' => 'hr',
            //     'description' => 'Super Admin Dashboard HR',
            // ],
            [
                'role_name' => 'logi_admin', // 6
                'type' => 'logi',
                'description' => 'Property Custodian LS',
            ],
            [
                'role_name' => 'logi_faculty', // 7
                'type' => 'logi',
                'description' => 'Faculty LS',
            ],
            // [
            //     'role_name' => 'logi_admin_dashboard',
            //     'type' => 'logi',
            //     'description' => 'Property Custodian Dashboard LS',
            // ]
        ];

        foreach($roles as $role){
            Role::factory()->create($role);
        }

        // 0001
        Faculty::find(1)->roles()->attach([4]); // hr_admin

        // 002
        Faculty::find(2)->roles()->attach([5]); // hr_faculty

        // 0003
        Faculty::find(3)->roles()->attach([4]); // hr_admin
        Faculty::find(3)->roles()->attach([1]); // sis_faculty

        // 0004
        Faculty::find(4)->roles()->attach([1]); // sis_admin
        Faculty::find(4)->roles()->attach([6]); // logi_admin

        // 0005
        Faculty::find(5)->roles()->attach([1]); // sis_admin
        Faculty::find(5)->roles()->attach([4]); // hr_admin
        Faculty::find(5)->roles()->attach([6]); // logi_admin

        // 0006
        Faculty::find(6)->roles()->attach([1]); // sis_admin

        // 0007
        Faculty::find(7)->roles()->attach([6]); // logi_admin

        // 0008
        Faculty::find(8)->roles()->attach([3]); // sis_faculty

        // 0009
        Faculty::find(9)->roles()->attach([1]); // sis_admin
        Faculty::find(9)->roles()->attach([2]); // sis_registrar
        Faculty::find(9)->roles()->attach([3]); // sis_faculty

        // 0010
        Faculty::find(10)->roles()->attach([2]); // sis_registrar


    }
}
