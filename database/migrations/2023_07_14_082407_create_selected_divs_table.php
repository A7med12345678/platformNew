<?php
// database/migrations/{timestamp}_create_selected_divs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedDivsTable extends Migration
{
    public function up()
    {
        Schema::create('selected_divs', function (Blueprint $table) {
            $table->id();
            $table->integer('selected_week');
            $table->string('selected_section');
            $table->string('grade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('selected_divs');
    }
}
