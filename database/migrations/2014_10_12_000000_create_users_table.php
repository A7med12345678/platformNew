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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('center_code');
            $table->string('role')->default('studnt');
            $table->string('password');

            $table->string('start_from')->default('[]');
            $table->string('student_end')->default('[]');

            $table->string('phone', 11)->unique();
            $table->string('parent_phone', 11);
            $table->string('whatsapp', 11);

            $table->string('grade', 1);
            $table->string('group');
            $table->string('avilable_grades')->default('[]');
            $table->longText('exams_attemps')->default(json_encode(array_fill(0, 90, 0)));
            $table->longText('hw_attemps')->default(json_encode(array_fill(0, 90, 0)));
            $table->string('learn_type')->default('عام');

            $table->string('force_stop')->default('0');
            $table->string('pay')->default('0');

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo', 2048)->nullable();
            $table->string('session_id')->nullable();
            $table->string('develop_mode')->default('0');

            $table->timestamps();
            $table->softDeletes();
            // $table->string('last_seen')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};