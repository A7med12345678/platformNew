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
        Schema::create('special_logs', function (Blueprint $table) {
            $table->id();
            $table->text('sender_id');
            $table->unsignedBigInteger('log_type');
            $table->text('sender_name');
            $table->longText('content');
            $table->index('sender_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_logs');
    }
};