<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateDetailBookingFilmsTable extends Migration
{
    use SoftDeletes;
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_booking_films', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrowing_id')->unsigned();
            $table->foreign('borrowing_id')->references('id')
                ->on('borrowings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('seat_id')->unsigned();
            $table->foreign('seat_id')->references('id')
                ->on('seats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('price');
            $table->tinyInteger('is_finish');
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
        Schema::dropIfExists('detail_booking_films');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
