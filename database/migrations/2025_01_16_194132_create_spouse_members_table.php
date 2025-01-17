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
        Schema::create('spouse_members', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->foreignId('personal_information_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->foreignId('name_extension_id')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer_business_name')->nullable();
            $table->string('business_address')->nullable();
            $table->string('telephone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spouse_members');
    }
};
