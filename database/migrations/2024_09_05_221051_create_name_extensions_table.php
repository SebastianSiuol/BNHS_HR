<?php

use Database\Seeders\NameExtensionSeeder;
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
        Schema::create('name_extensions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        $name_ext_seeder = new NameExtensionSeeder();
        $name_ext_seeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_extensions');
    }
};
