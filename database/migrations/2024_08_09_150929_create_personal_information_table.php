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
        Schema::create('civil_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('civil_status');
            $table->timestamps();
        });

        Schema::create('citizenships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('citizen_type');
            $table->string('country')->nullable();
            $table->timestamps();
        });

        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->foreignId('name_extension_id')->nullable();
            $table->string('sex');
            $table->string('date_of_birth');
            $table->string('place_of_birth');
            $table->string('telephone_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->foreignId('civil_status_id')->nullable();
            $table->foreignId('citizenship_id')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizenships');
        Schema::dropIfExists('civil_status');
        Schema::dropIfExists('personal_information');
    }
};
