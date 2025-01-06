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
            'faculty_code' => 'BHNHS-2024-0001',
            'email' => 'john@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0002',
            'email' => 'adambakers07@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0003',
            'email' => 'rv043098@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0004',
            'email' => 'romeovelasquez08@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0005',
            'email' => 'dabdaki@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0006',
            'email' => 'gabogabian@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-04',
            'service_credit' => 8,
        ]);

        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0007',
            'email' => 'roberto@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2008-01-06',
            'service_credit' => 8,
        ]);

        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0008',
            'email' => 'poppy@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2002-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0009',
            'email' => 'tuffin@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2002-01-02',
            'service_credit' => 8,
        ]);
        Faculty::factory()->create([
            'faculty_code' => 'BHNHS-2024-0010',
            'email' => 'rijel@example.com',
            'password' => 'Password123',
            'date_of_joining' => '2002-01-02',
            'service_credit' => 8,
        ]);
    }
}
