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
            $table->string('kluss_image');
            $table->double('price');
            $table->dateTime('date');
            $table->decimal('latitude');
            $table->decimal('longitude');
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
