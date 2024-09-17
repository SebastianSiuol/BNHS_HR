<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PersonalInformation\PersonalInformation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phil_id_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PersonalInformation::class);
            $table->string('gsis_id_no');
            $table->string('pag_ibig_id_no');
            $table->string('philhealth_no');
            $table->string('sss_no');
            $table->string('tin_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phil_id_cards');
    }
};
