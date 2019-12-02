<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDatve extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datve', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_lichchieu')->unsigned();
            $table->foreign('id_lichchieu')->references('id')->on('lichchieu');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->bigInteger('id_combo')->unsigned();
            $table->foreign('id_combo')->references('id')->on('combo');
            $table->boolean('active');
            $table->integer('tongtien');
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
        Schema::dropIfExists('datve');
    }
}
