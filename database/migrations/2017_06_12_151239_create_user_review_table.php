<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reviews', function(Blueprint $table){
            $table->increments('id');
            $table->integer('maker_id')->unsigned();
            $table->foreign('maker_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('fixer_id')->unsigned();
            $table->foreign('fixer_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('kluss_id')->unsigned();
            $table->foreign('kluss_id')->references('id')->on('kluss')->onDelete('cascade');
            $table->integer('writer')->unsigned();
            $table->foreign('writer')->references('id')->on('users')->onDelete('cascade');
            $table->string('review');
            $table->integer('score');
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
    }
}
