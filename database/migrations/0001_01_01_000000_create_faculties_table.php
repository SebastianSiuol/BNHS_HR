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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->string('faculty_code')->unique(); // For the formatted ID
            $table->string('email')->unique();
            $table->string('password');
            $table->string('date_of_joining')->nullable();
            $table->string('date_of_leaving')->nullable();
            $table->string('service_credit')->nullable()->default(0);
            $table->string('photo')->nullable()->default('example/emp_photo.png');
            $table->foreignId('designation_id')->nullable();
            $table->foreignId('shift_id')->nullable();
            $table->foreignId('employment_status_id')->nullable();
            $table->foreignId('school_position_id')->nullable();
            $table->foreignId('department_head_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
