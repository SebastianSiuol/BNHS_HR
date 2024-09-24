<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Faculty;
use App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->foreign('employment_status_id')->references('id')->on('employment_statuses');
        });

        Schema::table('designations', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::table('personal_information', function (Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->foreign('civil_status_id')->references('id')->on('civil_status');
            $table->foreign('citizenship_id')->references('id')->on('citizenships');
            $table->foreign('name_extension_id')->references('id')->on('name_extensions');
        });

        Schema::table('reference_members', function (Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('contact_people', function (Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('leaves', function(Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->foreign('leave_type_id')->references('id')->on('leave_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
