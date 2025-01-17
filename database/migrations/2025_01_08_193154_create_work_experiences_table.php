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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->foreignId('personal_information_id');
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('position_title')->nullable();
            $table->string('department')->nullable();
            $table->decimal('monthly_salary', 15, 2)->nullable();
            $table->string('salary_grade')->nullable();
            $table->string('status_of_appointment')->nullable();
            $table->enum('gov_service', ['yes', 'no'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
