<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    use SoftDeletes;
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 4);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();            
            $table->string('password', 100);
            $table->string('fullname', 100);
            $table->string('image')->nullable();
            $table->date('birthday');
            $table->unsignedInteger('city_id');
            $table->foreign('city_id')->references('id')
                ->on('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->tinyInteger('is_active')->default(0)->comment="1: active; 0:not";
            $table->tinyInteger('role')->default(0)->comment="1: admin; 0:user";
            $table->string('access_token');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
