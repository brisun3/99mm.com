<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Miss;
use Auth;
use App\CreateTbl;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->createTbl();
        $user_id=auth()->user()->id;
        $utype=auth()->user()->utype;
        $user=User::find($user_id);
        //create a tbl with interupt a view, practical but not confirmed
        switch($utype){
            case 'miss':
                return view('dashboard')->with('posts',$user->misss)->with('utype',$utype);
                
            case 'ptmiss':
                return view('dashboard')->with('posts',$user->ptmisss);
            case 'massage':
                return view('dashboard')->with('posts',$user->massages);
            case 'baoyang':
                return view('dashboard')->with('posts',$user->baoyangs);


        }
        
    }
    public function createTbl(){ 
        $ucountry=auth()->user()->ucountry;
        //$ucountry=Auth::user()->ucountry;
        $utype=auth()->user()->utype;
        //$utype=Auth::user()->utype;
        $a=new createTbl();
        //the way of use model function
        
        switch($utype){
            case 'miss':
                return $a->create_miss_tbl($ucountry);
            case 'massage':
                return $a->create_mass_tbl($ucountry,$utype);
            case 'ptmiss':
            return $a->create_ptmiss_tbl($ucountry);
            case 'baoyang':
                

        }


        
    }
}

//thinking and check: if not using facade/auth, Auth namespace can't b used, I have 
// to use auth() in app/user, does it mean facade could be avoid in this case