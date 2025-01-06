<?php

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
        Schema::create('civil_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_information_id');
            $table->string('career_service');
            $table->string('rating');
            $table->date('date_of_examination');
            $table->string('place_of_examination');
            $table->string('license_number');
            $table->date('date_of_validity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civil_services');
    }
};
