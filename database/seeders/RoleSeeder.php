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
        Role::factory()->create([
            'role_name' => 'Admin',
        ]);
        Role::factory()->create([
            'role_name' => 'Staff',
        ]);

        Faculty::find(1)->roles()->attach([1]);
        Faculty::find(2)->roles()->attach([2]);
        Faculty::find(3)->roles()->attach([2]);
        Faculty::find(4)->roles()->attach([1]);
        Faculty::find(5)->roles()->attach([2]);
        Faculty::find(6)->roles()->attach([2]);
    }
}
