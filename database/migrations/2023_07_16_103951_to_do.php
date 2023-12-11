<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('todo', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('sender_id');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('todo');
    }
};