<?php

use Database\Seeders\ReferenceMemberSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FacultyInformation\PersonalInformation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reference_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_information_id')->nullable();
            $table->string('name');
            $table->string('contact_number');
            $table->string('address');
            $table->string('reference_number');
            $table->timestamps();
        });

        $reference_member_seeder = new ReferenceMemberSeeder();
        $reference_member_seeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_members');
    }
};
