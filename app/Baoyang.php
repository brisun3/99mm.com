<?php

namespace App;

//auth must be cited to get user type in create function
//use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Baoyang extends Model
{
    
    // Table Name
    
    
    //protected $country=Auth::ucountry
    
    //protected $table = $country.'posts';
    
    
    public $primaryKey = 'id';
    
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
