<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDatghe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datghe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_lichchieu')->unsigned();
            $table->foreign('id_lichchieu')->references('id')->on('lichchieu');
            $table->bigInteger('id_ghe')->unsigned();
            $table->foreign('id_ghe')->references('id')->on('ghe');
            $table->bigInteger('id_datve')->unsigned();
            $table->foreign('id_datve')->references('id')->on('datve');
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
        Schema::dropIfExists('datghe');
    }
}
