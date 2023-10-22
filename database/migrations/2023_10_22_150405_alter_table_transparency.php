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
        Schema::table('transparency', function (Blueprint $table) {
            $table->string('type_file');
            $table->string('size_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transparency', function (Blueprint $table) {
            $table->dropColumn('type_file');
            $table->dropColumn('size_file');
        });
    }
};
