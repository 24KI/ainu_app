<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ainu02_scores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("type");
            $table->integer("question1")->nullable();
            $table->integer("question2")->nullable();
            $table->integer("question3")->nullable();
            $table->integer("question4")->nullable();
            $table->integer("question5")->nullable();
            $table->integer("question6")->nullable();
            $table->integer("question7")->nullable();
            $table->integer("question8")->nullable();
            $table->integer("question9")->nullable();
            $table->integer("question10")->nullable();
            $table->integer("quiz_success_count")->nullable();

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
        Schema::dropIfExists('ainu02_scores');
    }
};
