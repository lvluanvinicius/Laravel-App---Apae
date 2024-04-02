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
        Schema::create('transparency_folders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cod_transparency_year_fk');
            $table->string('folders');
            $table->string('hash')->unique();

            $table->timestamps();

            $table->foreign('cod_transparency_year_fk')->references('id')->on('transparency_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparency_folders');
    }
};