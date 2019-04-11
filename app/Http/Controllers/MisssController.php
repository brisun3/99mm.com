<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use DB;
use App\Miss;
use App\Status;
//for email
use Mail;
use App\Mail\EmailClass;


class MisssController extends Controller
{
    //need to confirm if constructor adopted
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::where('status','free')->get();
        $posts = Miss::orderBy('uname','asc')->get();
        //$posts = Post::orderBy('name','asc')->get();

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_type=Auth::user()->utype;
        $ucountry=Auth::user()->ucountry;
        $uname=Auth::user()->username;

            switch($user_type){
                case('miss'):
                    return view('posts/create')->with('ucountry',$ucountry)->with('uname',$uname);
                case('massage'):
                    return view('posts/massage_create');
                case('parttime'):
                    return view('posts/parttime_create');
                case('baoyang'):
                    return view('posts/baoyang_create');
                case('commercial'):
                    return view('posts/comercial_create');
                case('holiday'):
                    return view('posts/holiday_create');

            }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'city' => 'required',
            'tel' => 'required',
            'intro' => 'required'
            //'img_name'=>'image|nullable'
            //'image|mimes:jpeg,bmp,png|size:2000'
        ]);

        $uname=auth()->user()->username;

        $status = new Status;
        $status_uname=Status::where('uname', '=', $uname)->first();
        if ($status_uname===null) {
            // user found


            $miss = new Miss;
            //$miss -> setTable(Auth::user()->ucountry.'_miss_tbl');
            $miss->city = $request->input('city');
            $miss->uname = $uname;
            $miss->tel = $request->input('tel');
            $miss->addr1 = $request->input('addr1');
            $miss->addr2 = $request->input('addr2');

            // Handle File Upload
            $i=0;
            if($request->hasFile('filename')){

                foreach ($request->file('filename') as $photo){
                    // Get filename with the extension
                    $filenameWithExt = $photo->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $photo->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore[$i]= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $miss->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $miss->img0=$fileNameToStore;
            }

            // Create Post

            //$miss->img_name = $fileNameToStore[0];
            //if($i>0)
            //need to modify, there is error if only 1 file to upload
            //$img1= $fileNameToStore[1];


            //$miss->img1=$img1;


            //$miss->user_id = $request->input('user_id');
            $miss->intro = $request->input('intro');
            $miss->age = $request->input('age');
            $miss->national = $request->input('national');
            $miss->shape= $request->input('shape');
            $miss->skin = $request->input('skin');
            $miss->height = $request->input('height');
            $miss->chest= $request->input('chest');
            $miss->waist = $request->input('waist');
            $miss->weight= $request->input('weight');
            $miss->lan1 = $request->input('lan1');
            $miss->lan2 = $request->input('lan2');
            $miss->lan_des= $request->input('lan_des');
            $miss->price30 = $request->input('price30');
            $miss->price1h = $request->input('price1h');
            $miss->price_out = $request->input('price_out');
            $miss->price_note= $request->input('price_note');
            $miss->service_des = $request->input('service_des');
            $miss->special_serv = $request->input('special_serv');
            $miss->western_serv = $request->has('western_serv');



           
            //$miss->type = $request->type;

            //give 2 months free using
            //$miss->expire_at = date('Y-m-d', strtotime(' + 2months'));
            //$post->cover_image = $fileNameToStore;
            $miss->user_id = auth()->user()->id;

            $miss->save();


            //store data to status tbl

            //$miss -> setTable(Auth::user()->ucountry.'_miss_tbl');
            $status->user_id = auth()->user()->id;
            $status->uname = $uname;
            $status->utype = auth()->user()->utype;
            $status->ucountry = auth()->user()->ucountry;
            $status->verified= 0;

            $status->status= 'free';
            $status->expire_at = date('Y-m-d', strtotime(' + 2months'));
            $status->last_update=date("Y-m-d");
            $status->save();



            //email to miss


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.missReg',$uname));


       //////
        return redirect('/')->with('success', '上传成功！');
        }else{
            return redirect('/')->with('error', '你的资料已经传过了！');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function email()
    { Mail::to(Auth::user()->email)->send(new EmailClass('regConf.missReg'));}

    public function show($user_id)
    {
        $miss=new Miss;
        $miss -> setTable('爱尔兰_miss_tbl');
        $post= $miss->find($user_id);
       //$data=
       return view('misss.miss_show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ucountry=Auth::user()->ucountry;

        $miss=new Miss;

        $miss -> setTable('爱尔兰_miss_tbl');
        $miss= $miss->find($id);
       // $miss= Miss::find($id);
       // if(auth()->user()->id!=$miss->user_id){

        if(auth()->user()->id!=$miss->user_id){
            //need to confirm if '/posts'
            return redirect('/posts')->with('error','unathorized page');
        }

        return view('misss.miss_edit')->with('miss',$miss)->with('ucountry',$ucountry);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'city' => 'required',
            'tel' => 'required',
            'intro' => 'required'
            //'img_name'=>'image|nullable'
            //'image|mimes:jpeg,bmp,png|size:2000'
        ]);

        $uname=auth()->user()->username;

        $status = Status::find($id);
        $status_uname=Status::where('uname', '=', $uname)->first();
        if ($status_uname!=null) {
            // user found


            $miss = Miss::find($id);
            //$miss -> setTable(Auth::user()->ucountry.'_miss_tbl');
            $miss->city = $request->input('city');
            $miss->uname = $uname;
            $miss->tel = $request->input('tel');
            $miss->addr1 = $request->input('addr1');
            $miss->addr2 = $request->input('addr2');

            // Handle File Upload
            $i=0;
            if($request->hasFile('filename')){

                foreach ($request->file('filename') as $photo){
                    // Get filename with the extension
                    $filenameWithExt = $photo->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $photo->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore[$i]= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $miss->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            }
            /*
            else {
                $fileNameToStore = 'no-user.jpg';
                $miss->img0=$fileNameToStore;
            }
            */

            // Create Post

            //$miss->img_name = $fileNameToStore[0];
            //if($i>0)
            //need to modify, there is error if only 1 file to upload
            //$img1= $fileNameToStore[1];


            //$miss->img1=$img1;


            //$miss->user_id = $request->input('user_id');
            $miss->intro = $request->input('intro');
            $miss->type = $request->type;

            //give 2 months free using
            //$miss->expire_at = date('Y-m-d', strtotime(' + 2months'));
            //$post->cover_image = $fileNameToStore;
            $miss->user_id = auth()->user()->id;

            $miss->save();


            //store data to status tbl

            //$miss -> setTable(Auth::user()->ucountry.'_miss_tbl');
            $status->user_id = Auth::user()->id;
            $status->uname = $uname;


            $status->verified= 0;



            $status->last_update=date("Y-m-d");
            $status->save();




        return redirect('/')->with('success', 'Post updated');
        }else{
            return redirect('/posts')->with('fail', 'U have post already');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
