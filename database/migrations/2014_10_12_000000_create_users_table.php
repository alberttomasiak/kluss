<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_pic')->default('/img/default_profilepic.png');
            $table->string('bio')->default("Vul me in!");
            $table->integer('user_rating')->default('0');
            $table->string('account_type')->default('normal');
            $table->integer('verified')->default('0');
            $table->integer('blocked')->default('0');
            $table->integer('activated')->default('0');
            $table->string('activation_code');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
