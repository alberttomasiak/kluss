<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlussTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('kluss', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('kluss_image')->default("/img/klussjes/geen-image.png");
            $table->double('price');
            $table->dateTime('date');
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('accepted')->default('0');
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
        //
        Schema::dropIfExists('kluss');
    }
}