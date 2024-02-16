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
        Schema::dropIfExists('study_languages');
        Schema::dropIfExists('study_contents');
        Schema::dropIfExists('learning_records');
    }

    public function down()
    {
        // rollback 時の処理は特に指定しない
    }
};
