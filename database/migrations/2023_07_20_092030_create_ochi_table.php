<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOchiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ochi', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('tema');
            $table->string('kontes')->nullable();
            $table->string('nik_ochi_leader');
            $table->string('juara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ochi');
    }
}
