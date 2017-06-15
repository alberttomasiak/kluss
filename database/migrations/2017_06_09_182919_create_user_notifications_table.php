<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function(Blueprint $table){
            $table->increments('id');
            $table->integer('about_user')->unsigned();
            $table->foreign('about_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('for_user')->unsigned();
            $table->foreign('for_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('message');
            $table->string('url')->nullable();
            $table->integer('read')->default('0');
            $table->dateTime('date');
            $table->string('channel');
            $table->string('type');
            $table->integer('kluss_id')->nullable()->unsigned();
            $table->foreign('kluss_id')->references('id')->on('kluss')->onDelete('cascade');
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
