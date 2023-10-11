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
            $table->string('SD')->nullable();
            $table->string('S')->nullable();
            $table->string('I')->nullable();
            $table->string('A')->nullable();
            $table->string('ITD')->nullable();
            $table->string('ICP')->nullable();
            $table->string('TD')->nullable();
            $table->string('CP')->nullable();
            $table->string('OCHI')->nullable();
            $table->string('QCC')->nullable();
            $table->string('OCHI_leader')->nullable();
            $table->string('fasilitator_qcc')->nullable();
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
