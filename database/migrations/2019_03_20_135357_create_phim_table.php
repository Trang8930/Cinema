<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phim', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->string('tenphim');
            $table->string('tentienganh');
            $table->string('image');
            $table->string('nsx');
            $table->string('theloai');
            $table->string('quocgia');
            $table->string('daodien');
            $table->string('dienvien');
            $table->integer('thoiluong');
            $table->date('ngaykhoichieu');
            $table->enum('trangthai',[0,1]);
            $table->text('trailer');
            $table->text('noidung');
            $table->integer('giave');
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
        Schema::dropIfExists('phim');
    }
}
