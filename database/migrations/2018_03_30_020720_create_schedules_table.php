<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')
                ->on('rooms')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('film_id')->unsigned();
            $table->foreign('film_id')->references('id')
                ->on('films')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->time('time_start');
            $table->time('time_finish');
            $table->date('date');
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
        Schema::dropIfExists('schedules');
    }
}
