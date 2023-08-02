<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qcc', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('tema');
            $table->string('kontes')->nullable();
            $table->string('nama_qcc');
            $table->string('juara_sai')->nullable();
            $table->string('juara_pasi')->nullable();
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
        Schema::dropIfExists('qcc');
    }
}
