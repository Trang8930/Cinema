<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ve', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_lichchieu');
            $table->foreign('id_lichchieu')->references('id')->on('lichchieu')->onDelete('cascade');
            $table->unsignedBigInteger('id_ghe');
            $table->foreign('id_ghe')->references('id')->on('ghe')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ve');
    }
}
