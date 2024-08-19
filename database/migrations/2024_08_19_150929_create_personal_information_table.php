<?php

use App\Models\Faculty;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Models namespaces
use App\Models\FacultyInformation\Citizenship;
use App\Models\FacultyInformation\CivilStatus;

use Database\Seeders\FacultyInformation\PersonalInformationSeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citizenships', function (Blueprint $table) {
            $table->id();
            $table->string('citizen_type');
            $table->string('country')->nullable();
            $table->timestamps();
        });
        Schema::create('civil_status', function (Blueprint $table) {
            $table->id();
            $table->string('civil_status');
            $table->timestamps();
        });
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Faculty::class)->default(1);
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('name_extension')->nullable();
            $table->string('sex');
            $table->string('date_of_birth');
            $table->string('place_of_birth');
            $table->string('telephone_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->foreignIdFor(Citizenship::class)->default(1);
            $table->foreignIdFor(CivilStatus::class)->default(1);
            $table->timestamps();
        });


        $personal_info_seeder = new PersonalInformationSeeder();
        $personal_info_seeder->run();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizenships');
        Schema::dropIfExists('civil_status');
        Schema::dropIfExists('personal_information');
    }
};
