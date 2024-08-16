<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::factory()->create([
            'first_name' => 'John',
            'middle_name' => 'Merlin',
            'last_name' => 'Santiago',
            'email' => 'john@example.com',
            'password' => 'Password123',
        ]);
        Faculty::factory()->create([
            'first_name' => 'Adam',
            'middle_name' => '',
            'last_name' => 'Bakers',
            'email' => 'adambakers07@example.com',
            'password' => 'Password123',
        ]);
        Faculty::factory()->create([
            'first_name' => 'Ryan',
            'middle_name' => 'Deludo',
            'last_name' => 'Vasquez',
            'email' => 'rv043098@example.com',
            'password' => 'Password123',
        ]);
    }
}
