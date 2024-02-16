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
        Schema::create('learning_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('learning_date');
            $table->decimal('learning_time', 5, 2);
            $table->timestamps();
        });
        Schema::create('learning_record_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_record_id')->constrained();
            $table->foreignId('content_id')->constrained('contents');
            $table->timestamps();
        });

        Schema::create('learning_record_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_record_id')->constrained();
            $table->foreignId('language_id')->constrained('languages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_record_contents');
        Schema::dropIfExists('learning_record_languages');
        Schema::dropIfExists('learning_records');
    }
};
