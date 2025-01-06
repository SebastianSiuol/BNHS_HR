<?php

namespace Database\Seeders;

use App\Models\Configuration\RPMSConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RPMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = date('Y');

        RPMSConfiguration::create([
            'mid_year_date' => new Carbon("$currentYear-05-30"),
            'end_year_date' => new Carbon("$currentYear-12-20"),
            'year' => $currentYear,
        ]);
    }
}
