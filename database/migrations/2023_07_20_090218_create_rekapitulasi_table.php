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
            $table->string('nik');
            $table->string('SD');
            $table->string('S');
            $table->string('I');
            $table->string('A');
            $table->string('ITD');
            $table->string('ICP');
            $table->string('TD');
            $table->string('CP');
            $table->string('OCHI');
            $table->string('QCC');
            $table->string('OCHI_leader');
            $table->string('Juara_OCHI');
            $table->string('Juara_QCC');
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
