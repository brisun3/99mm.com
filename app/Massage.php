<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Massage extends Model
{
    function __construct()
    {
        parent::__construct();
        if(Auth::check()){
            $country=Auth::user()->ucountry;
        }else
        {
            $country='爱尔兰';
            
        }
        $this->setTable($country.'_massage_tbl');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
