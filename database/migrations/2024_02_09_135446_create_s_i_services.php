<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('s_i_services', function (Blueprint $table) {
            $table->id();

            $table->string('file_name');
            $table->boolean('file_public')->default(true);
            $table->string('file_type');
            $table->string('file_name_path');
            $table->string('file_size');
            $table->string('file_format');
            $table->string('file_hash');
            $table->enum('file_device', [
                "mobile",
                "desktop",
                "tablet",
                "android",
                "undefined"
            ])->default('undefined');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_i_services');
    }
};