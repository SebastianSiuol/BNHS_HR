<?php

namespace Database\Seeders;

use App\Models\Faculty;
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
            'date_of_joining' => '01-02-2008',
            'date_of_leaving' => '01-02-2035',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'adambakers07@example.com',
            'password' => 'Password123',
            'date_of_joining' => '01-02-2008',
            'date_of_leaving' => '01-02-2035',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'rv043098@example.com',
            'password' => 'Password123',
            'date_of_joining' => '01-02-2008',
            'date_of_leaving' => '01-02-2035',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'romeovelasquez08@example.com',
            'password' => 'Password123',
            'date_of_joining' => '01-02-2008',
            'date_of_leaving' => '01-02-2035',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'dabdaki@example.com',
            'password' => 'Password123',
            'date_of_joining' => '01-02-2008',
            'date_of_leaving' => '01-02-2035',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'gabogabian@example.com',
            'password' => 'Password123',
            'date_of_joining' => '01-02-2008',
            'date_of_leaving' => '01-02-2035',
            'service_credit' => 8,
        ]);
    }
}
