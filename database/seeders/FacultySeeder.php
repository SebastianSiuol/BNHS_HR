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
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'adambakers07@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'rv043098@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'romeovelasquez08@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'dabdaki@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'gabogabian@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-04',
            'service_credit' => 8,
        ]);

        Faculty::factory()->create([
            'email' => 'roberto@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-06',
            'service_credit' => 8,
        ]);

        Faculty::factory()->create([
            'email' => 'poppy@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2002-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'tuffin@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2002-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'email' => 'rijel@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2002-01-02',
            'service_credit' => 8,
        ]);
    }
}
