<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichchieuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichchieu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_phim');
            $table->foreign('id_phim')->references('id')->on('phim')->onDelete('cascade');
            $table->unsignedBigInteger('id_phong');
            //$table->foreign('id_phong')->references('id')->on('phong')->onDelete('cascade');
            $table->unsignedBigInteger('id_rap');
            //$table->foreign('id_rap')->references('id')->on('rap')->onDelete('cascade');
            $table->date('ngay');
            $table->timestamp('time');
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
        Schema::dropIfExists('lichchieu');
    }
}
