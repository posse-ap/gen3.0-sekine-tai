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
        Schema::create('study_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('study_date');
            $table->time('study_time');
            $table->timestamps();
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('language_name');
            $table->string('color_code');
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('content_name');
            $table->string('color_code');
            $table->timestamps();
        });

        Schema::create('study_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')->constrained('study_records');
            $table->unsignedBigInteger('language_id')->nullable(); // NULL を許容する
            $table->foreign('language_id')->references('id')->on('languages');
            $table->timestamps();
        });

        Schema::create('study_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')->constrained('study_records');
            $table->unsignedBigInteger('content_id')->nullable(); // NULL を許容する
            $table->foreign('content_id')->references('id')->on('contents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_records');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('study_languages');
        Schema::dropIfExists('study_contents');
    }
};