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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cod_user_fk');
            $table->unsignedBigInteger('cod_category_fk');

            $table->string('news_post_title');
            $table->longText('news_post_content');
            $table->string('news_post_slug');
            $table->string('news_post_summary')->nullable(true);
            $table->string('news_post_tags')->nullable(true);
            $table->integer('news_post_views')->default(0);
            $table->boolean('news_post_status')->default(true);
            $table->boolean('news_post_active_comments')->default(true);
            $table->timestamps();

            $table->foreign('cod_user_fk')->references('id')->on('users');
            $table->foreign('cod_category_fk')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
