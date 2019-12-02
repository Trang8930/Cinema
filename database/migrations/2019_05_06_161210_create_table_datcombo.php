<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDatcombo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datcombo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_lichchieu')->unsigned();
            $table->foreign('id_lichchieu')->references('id')->on('lichchieu');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->bigInteger('id_combo')->unsigned();
            $table->foreign('id_combo')->references('id')->on('combo');
            $table->integer('soluong');
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
        Schema::dropIfExists('datcombo');
    }
}
