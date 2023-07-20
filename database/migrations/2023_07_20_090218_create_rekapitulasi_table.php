<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapitulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapitulasi', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->integer('SD');
            $table->integer('S');
            $table->integer('I');
            $table->integer('A');
            $table->integer('ITD');
            $table->integer('ICP');
            $table->integer('TD');
            $table->integer('CP');
            $table->integer('OCHI');
            $table->integer('QCC');
            $table->integer('OCHI_leader');
            $table->integer('Juara_OCHI');
            $table->integer('Juara_QCC');
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
        Schema::dropIfExists('rekapitulasi');
    }
}
