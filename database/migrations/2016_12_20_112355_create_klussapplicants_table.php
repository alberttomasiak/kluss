<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlussapplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('kluss_applicants', function(Blueprint $table){
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->integer('kluss_id')->unsigned();
            $table->foreign('kluss_id')->references('id')->on('kluss')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('accepted')->default('0');
            $table->timestamps();
        });

        Schema::table('kluss', function(Blueprint $table){
            $table->foreign('accepted_applicant_id')->references('user_id')->on('kluss_applicants')->onDelete('cascade');
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
        Schema::dropIfExists('kluss_applicants');
    }
}
