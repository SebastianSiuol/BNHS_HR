<?php

use App\Models\PersonalInformation\PersonalInformation;
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
        Schema::create('residential_addresses', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residential_addresses');
    }
};
