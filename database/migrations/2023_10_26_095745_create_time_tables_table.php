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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sender_id');
            $table->text('for_course');
            $table->text('lecture_day')->nullable();
            $table->text('lecture_time')->nullable();
            $table->text('lecture_time_end')->nullable();
            $table->text('exam_day')->nullable();
            $table->text('exam_time')->nullable();
            $table->text('exam_time_end')->nullable();

            $table->index('sender_id');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tables');
    }
};
