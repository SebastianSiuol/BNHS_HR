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
        Schema::create('school_positions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('level', ['leadership', 'entry', 'mid', 'senior', 'support', 'it'])->default('entry');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_positions');
    }
};
