<?php

use Database\Seeders\ContactPersonSeeder;
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
        Schema::create('contact_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_information_id')->nullable();
            $table->string('name');
            $table->string('contact_no');
            $table->timestamps();
        });

        $contact_psn = new ContactPersonSeeder();
        $contact_psn->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_people');
    }
};
