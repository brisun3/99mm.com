<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class createTbl extends Model
{
    public function create_miss_tbl($ucountry){
        if (!Schema::hasTable($ucountry.'_miss_tbl')){
            Schema::create($ucountry.'_miss_tbl', function($table)
            {

                $table->increments('id');

                $table->string('uname');
                $table->integer('user_id');
                $table->string('city');
                    
                $table->string('tel');
                
                $table->text('addr1');
                $table->string('img0')->nullable();
                $table->string('img1')->nullable();
                $table->string('img2')->nullable();
                $table->string('img3')->nullable();
                $table->string('img4')->nullable();
                $table->string('img5')->nullable();
                $table->string('img6')->nullable();
                $table->string('img7')->nullable();
                $table->string('img8')->nullable();
                $table->string('img9')->nullable();
                $table->text('addr2')->nullable();

                $table->text('intro');
                $table->string('age');
                $table->string('national')->nullable();
                $table->string('shape')->nullable();
                $table->text('skin')->nullable();
                $table->text('height')->nullable();
                $table->string('chest')->nullable();
                $table->string('waist')->nullable();
                $table->string('weight')->nullable();
                $table->string('lan1')->nullable();
                $table->string('lan2')->nullable();
                $table->string('lan_des')->nullable();
                $table->integer('price30')->nullable();
                $table->integer('price1h')->nullable();
                $table->integer('price_out')->nullable();
                $table->text('price_note')->nullable();
                $table->text('service_des')->nullable();
                $table->text('special_serv')->nullable();
                $table->boolean('western_serv');
                $table->timestamps();

            });
        }

    }

    public function create_ptmiss_tbl($ucountry){
        if (!Schema::hasTable($ucountry.'_ptmiss_tbl')){
            Schema::create($ucountry.'_ptmiss_tbl', function($table)
            {
                
                $table->increments('id');

                $table->string('uname');
                $table->integer('user_id');
                $table->string('tel');
                $table->string('city');
                $table->text('addr');
                $table->boolean('venue');
                $table->text('intro');
                $table->string('age')->nullable();
                $table->string('national')->nullable();
                $table->string('lan')->nullable();
                $table->string('lan_des')->nullable();
                $table->integer('price')->nullable();
                $table->integer('price_out')->nullable();
                $table->text('price_note')->nullable();
                $table->text('service_des')->nullable();
                //need time format
                $table->text('serv_start')->nullable();
                $table->text('serv_end')->nullable();
                $table->text('msg')->nullable();
                $table->string('img0')->nullable();
                $table->string('img1')->nullable();
                $table->string('img2')->nullable();
                
                $table->timestamps();

                

            });
        }

    }
    public function create_mass_tbl($ucountry){
        if (!Schema::hasTable($ucountry.'_massage_tbl')){
            Schema::create($ucountry.'_massage_tbl', function($table)
            {

                $table->increments('id');
                $table->string('type');

                $table->string('name');
                $table->text('addr1');
                $table->string('img_name');
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
                $table->text('');

                $table->string('status');
                $table->date('expire_at');
                $table->timestamps();
                $table->integer('user_id');
            });
        }

    }

}
