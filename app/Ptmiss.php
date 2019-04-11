<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ptmiss extends Model
{
    //replace the function below, save fuction call
    function __construct()
    {
        parent::__construct();
        if(Auth::check()){
            $country=Auth::user()->ucountry;
        }else
        {
            //shall be update with login ip address in production stage.
            $country='irland';
            
        }
        $this->setTable($country.'_ptmiss_tbl');
    }
    /*
    public function setTable($table)
    {
    $this->table = $table;
    return $this;
    }
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
