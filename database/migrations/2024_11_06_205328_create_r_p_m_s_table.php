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
        Schema::create('r_p_m_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id');
            $table->string('file_path');
            $table->string('filename')->nullable();
            $table->enum('upload_period', ['mid_year', 'end_year']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_p_m_s');
    }
};
