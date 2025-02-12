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
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('restrict');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('restrict');;
            $table->foreign('employment_status_id')->references('id')->on('employment_statuses')->onDelete('restrict');
            $table->foreign('school_position_id')->references('id')->on('school_positions')->onDelete('restrict');
            $table->foreign('department_head_id')->references('id')->on('faculties')->onDelete('restrict');

        });

        Schema::table('designations', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
            $table->foreign('leave_types_id')->references('id')->on('leave_types');
        });

        Schema::table('r_p_m_s', function(Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });

        Schema::table('attendances', function(Blueprint $table) {
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });

        Schema::table('civil_services', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('work_experiences', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('voluntary_works', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('learning_and_developments', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('other_information', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('parent_members', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
            $table->foreign('name_extension_id')->references('id')->on('name_extensions');
        });

        Schema::table('spouse_members', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
            $table->foreign('name_extension_id')->references('id')->on('name_extensions');
        });

        Schema::table('children_members', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
        });

        Schema::table('educational_backgrounds', function(Blueprint $table) {
            $table->foreign('personal_information_id')->references('id')->on('personal_information')->onDelete('cascade');
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
