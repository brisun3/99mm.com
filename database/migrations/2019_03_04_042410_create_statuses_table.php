<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    const CREATED_AT = null;
    const UPDATED_AT = 'last_update';
            /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
    
        Schema::create('statuses', function (Blueprint $table) {
            
            $table->increments('sid');
            $table->integer('user_id');
            $table->string('uname');
            $table->string('utype');
            $table->string('ucountry');
            $table->boolean('verified');
            $table->integer('paidamt');
            $table->boolean('status');
            $table->date('effect_start');
            $table->date('expire_at');
            $table->text('note');
            $table->dateTime('last_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
