<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
   
    protected $table = 'posts';
    //not sure, need delete
    //protected $guard = 'miss';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }

}
