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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_types_id')->nullable();
            $table->foreignId('faculty_id')->nullable();
            $table->string('start_date');
            $table->string('leave_date');
            $table->string('document');
            $table->string('reason');
            $table->enum('status', ['pending', 'approved', 'rejected', 'ongoing', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
