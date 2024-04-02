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
        Schema::table('transparency_folders', function (Blueprint $table) {
            $table->dropUnique('transparency_folders_folders_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transparency_folders', function (Blueprint $table) {
            $table->string('folders')->unique()->change();
        });
    }
};