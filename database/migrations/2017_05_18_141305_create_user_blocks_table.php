<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_blocks', function(Blueprint $table){
            $table->increments('id');
            $table->integer('blocker_id')->unsigned();
            $table->foreign('blocker_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('blocked_id')->unsigned();
            $table->foreign('blocked_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('block_category')->unsigned();
            $table->foreign('block_category')->references('id')->on('block_reasons')->onDelete('cascade');
            $table->text('block_reason');
            $table->integer('archived')->default('0');
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
        Schema::dropIfExists('user_blocks');
    }
}
