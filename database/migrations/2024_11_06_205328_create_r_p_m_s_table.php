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
            $table->string('file_name');
            $table->string('date_submitted');
            $table->boolean('mid_year')->default(false);
            $table->boolean('year_end')->default(false);
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
