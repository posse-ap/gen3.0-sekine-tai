<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('study_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')->constrained('study_records');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->timestamps();
        });

        Schema::create('study_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')->constrained('study_records');
            $table->unsignedBigInteger('content_id')->nullable();
            $table->foreign('content_id')->references('id')->on('contents');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('study_languages');
        Schema::dropIfExists('study_contents');
    }
};
