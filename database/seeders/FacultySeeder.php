<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\FacultyInformation\PersonalInformation;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::factory()->create([
            'email' => 'john@example.com',
            'password' => 'Password123',
        ]);
        Faculty::factory()->create([
            'email' => 'adambakers07@example.com',
            'password' => 'Password123',
        ]);
        Faculty::factory()->create([
            'email' => 'rv043098@example.com',
            'password' => 'Password123',
        ]);
        Faculty::factory()->create([
            'email' => 'romeovelasquez08@example.com',
            'password' => 'Password123',
        ]);
        Faculty::factory()->create([
            'email' => 'dabdaki@example.com',
            'password' => 'Password123',
        ]);
        Faculty::factory()->create([
            'email' => 'gabogabian@example.com',
            'password' => 'Password123',
        ]);
    }
}
