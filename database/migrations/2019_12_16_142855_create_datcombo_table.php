<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatcomboTable extends Migration
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
            $table->unsignedBigInteger('id_lichchieu');
            $table->foreign('id_lichchieu')->references('id')->on('lichchieu')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_combo');
            $table->foreign('id_combo')->references('id')->on('combo')->onDelete('cascade');
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
