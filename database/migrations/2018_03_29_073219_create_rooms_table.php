<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id', 2);
            $table->integer('cinema_id')->unsigned();
            $table->foreign('cinema_id')->references('id')
                ->on('cinemas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->integer('seats_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('rooms');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
