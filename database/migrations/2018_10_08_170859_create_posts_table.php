<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('user_id');
            $table->string('name');
            $table->string('tel');
            $table->text('addr1');
            $table->string('img0');
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->string('img4');
            $table->string('img5');
            $table->string('img6');
            $table->string('img7');
            $table->string('img8');
            $table->string('img9');
            $table->text('addr2');
            $table->text('intro');
            
            $table->string('age');
            $table->string('national');
            $table->string('shape');
            $table->text('skin');
            $table->text('height');
            $table->string('chest');
            $table->string('waist');
            $table->string('weight');
                        
            $table->string('status');
            //$table->date('expire_at');
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
        Schema::dropIfExists('posts');
    }
}
