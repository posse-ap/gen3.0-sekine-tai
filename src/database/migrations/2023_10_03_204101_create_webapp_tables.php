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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('language', 255)->comment('学習言語');
            $table->string('color', 255)->comment('色');
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('content', 255)->comment('コンテンツ');
            $table->string('color', 255)->comment('色');
            $table->timestamps();
        });

        Schema::create('hours', function (Blueprint $table) {
            $table->id();
            $table->integer('hour')->comment('学習時間');
            $table->dateTime('date')->comment('日時');
            $table->timestamps();
        });

        Schema::create('hours_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id')->comment('学習コンテンツID');
            $table->unsignedBigInteger('hour_id')->comment('学習時間ID');
            $table->foreign('content_id')->references('id')->on('contents');
            $table->foreign('hour_id')->references('id')->on('hours');
            $table->timestamps();
        });

        Schema::create('hours_languages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id')->comment('学習言語ID');
            $table->unsignedBigInteger('hour_id')->comment('学習時間ID');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('hour_id')->references('id')->on('hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hours_languages');
        Schema::dropIfExists('hours_contents');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('hours');
    }
};
