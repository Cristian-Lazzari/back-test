<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();

            $table->smallInteger('reserved');

            $table->smallInteger('reserved_asporto');
            $table->smallInteger('reserved_domicilio');
            $table->smallInteger('year');
            $table->tinyInteger('month');
            $table->tinyInteger('day');
            $table->tinyInteger('day_w');
            $table->string('time');
            $table->string('date_slot');
            $table->boolean('visible_t');
            $table->boolean('visible_asporto');

            $table->boolean('visible_d');
            $table->smallInteger('max_res');
            $table->smallInteger('max_asporto');
 
            $table->smallInteger('max_domicilio');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dates');
    }
};
