<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ucountry');
            $table->string('uname');
            
            $table->integer('user_id');
            $table->text('topic');
            $table->text('info');
            $table->string('tel');
            $table->string('email');
            $table->string('visa');
            $table->string('city');
            $table->string('national');
            $table->string('gender');
            $table->string('age');
            $table->string('mstatus');
            $table->string('look');
            $table->string('price');
            $table->string('img0');
            $table->string('img1');
            $table->string('img2');
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
        Schema::dropIfExists('contracts');
    }
}
