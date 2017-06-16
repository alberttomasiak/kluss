<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlussBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kluss_blocks', function(Blueprint $table){
            $table->increments('id');
            $table->integer('kluss_id')->unsigned();
            $table->foreign('kluss_id')->references('id')->on('kluss')->onDelete('cascade');
            $table->integer('blocker_id')->unsigned();
            $table->foreign('blocker_id')->references('id')->on('users');
            $table->string('block_reason');
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
