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
        Schema::create('learning_and_developments', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->foreignId('personal_information_id');
            $table->string('title');
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->integer('hours')->nullable();
            $table->string('type')->nullable();
            $table->string('conducted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_and_developments');
    }
};
