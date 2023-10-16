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
        Schema::create('transparency', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cod_transparency_folders_fk');

            $table->string('filename');
            $table->string('hash');
            

            $table->timestamps();

            $table->foreign('cod_transparency_folders_fk')->references('id')->on('transparency_folders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparency');
    }
};
