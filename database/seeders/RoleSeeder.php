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
            'role_name' => 'hr_admin',
        ]);

        Role::factory()->create([
            'role_name' => 'hr_manager',
        ]);

        Role::factory()->create([
            'role_name' => 'hr_faculty',
        ]);

        Role::factory()->create([
            'role_name' => 'sis_admin',
        ]);

        Role::factory()->create([
            'role_name' => 'sis_registrar',
        ]);

        Role::factory()->create([
            'role_name' => 'sis_faculty',
        ]);

        Role::factory()->create([
            'role_name' => 'logi_admin',
        ]);

        Role::factory()->create([
            'role_name' => 'logi_faculty',
        ]);


        Faculty::find(1)->roles()->attach([1]);
        Faculty::find(2)->roles()->attach([3]);

        Faculty::find(3)->roles()->attach([2]);

        Faculty::find(4)->roles()->attach([4]);
        Faculty::find(4)->roles()->attach([5]);
        Faculty::find(4)->roles()->attach([6]);

        Faculty::find(5)->roles()->attach([5]);
        Faculty::find(6)->roles()->attach([6]);

        Faculty::find(7)->roles()->attach([7]);

        Faculty::find(8)->roles()->attach([8]);
    }
}
