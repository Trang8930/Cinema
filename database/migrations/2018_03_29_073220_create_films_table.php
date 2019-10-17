<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('price');
            $table->year('year',4);
            $table->text('author');
            $table->text('actor');
            $table->string('genre');
            $table->integer('time_limit');
            $table->string('kind', 100);
            $table->float('avg_rating');
            $table->integer('total_rating');            
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('films');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
