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
        Schema::table('photo_gallery', function (Blueprint $table) {
            $table->string('gallery_hash');
            $table->string('gallery_size');
            $table->string('gallery_image');
            $table->string('gallery_format');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_gallery', function (Blueprint $table) {
            $table->dropColumn('gallery_hash');
            $table->dropColumn('gallery_size');
            $table->dropColumn('gallery_format');
        });
    }
};
