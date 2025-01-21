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
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->foreignId('personal_information_id');
            $table->string('name_of_school')->nullable();
            $table->string('basic_education_degree_course')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('highest_level_earned')->nullable();
            $table->string('year_graduated')->nullable();
            $table->string('scholarships_academic_honors');
            $table->enum('education_level', ['elementary', 'secondary', 'vocational', 'college', 'graduate']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_backgrounds');
    }
};
