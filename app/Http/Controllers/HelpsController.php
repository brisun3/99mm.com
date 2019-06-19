<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
//use App\Mail\NewUserWelcome;
use App\Mail\EmailClass;
use Auth;

class HelpsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    public function email(Request $request){
        $subject=$request->input('subject');
        $topic=$request->input('message');
        $sender=$request->input('sender');
        $from=auth()->user()->email;
        $ename=auth()->user()->name;
        
        Mail::to('chinesedriver.com@gmail.com')->send(new EmailClass('contactus',$topic,$ename,$sender));
        //Mail::to(Auth::user()->email)->send(new EmailClass('contactus',auth()->user()->username));
        return redirect('/');

    }
}
