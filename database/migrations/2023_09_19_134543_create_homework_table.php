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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_grade'); // You have two 'user_grade' columns; consider renaming one of them.
            
            for ($week = 1; $week <= 90; $week++) {
                $columnName = "week{$week}sec3h";
                $table->string($columnName, 11)->default('#');
                $table->timestamp("{$columnName}Time")->nullable(); // Add timestamp columns for each week.
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
        Schema::dropIfExists('homework');
    }
};
