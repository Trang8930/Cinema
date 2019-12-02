<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->bigInteger('id_phim')->unsigned();
            $table->foreign('id_phim')->references('id')->on('phim');
            $table->bigInteger('id_rap')->unsigned();
            $table->foreign('id_rap')->references('id')->on('rap');
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
