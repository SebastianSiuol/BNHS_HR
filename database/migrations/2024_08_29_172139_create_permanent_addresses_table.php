<?php

use App\Models\FacultyInformation\PersonalInformation;
use Database\Seeders\PermanentAddressSeeder;
use Database\Seeders\ResidentialAddressSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permanent_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PersonalInformation::class)->nullable();
            $table->string('house_block_no');
            $table->string('street');
            $table->string('subdivision_village');
            $table->string('barangay');
            $table->string('city_municipality');
            $table->string('province');
            $table->string('zip_code');
            $table->timestamps();
        });

        $residential_seeder = new ResidentialAddressSeeder();
        $residential_seeder->run();

        $permanent_seeder = new PermanentAddressSeeder();
        $permanent_seeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permanent_addresses');
    }
};
