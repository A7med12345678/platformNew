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
        Schema::create('exam', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('user_name');
            $table->string('user_grade');
            for ($week = 1; $week <= 90; $week++) {
                $columnName = "week{$week}sec4";
                $table->string($columnName, 11)->default('#');
                $table->timestamp("{$columnName}Time")->nullable(); // Add created_at timestamp columns.
            }
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam');
    }
};