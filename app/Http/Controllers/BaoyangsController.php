<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Baoyang;
use App\Status;
use Mail;
use App\Mail\EmailClass;
use Image;


class BaoyangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
                
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
            'city' => 'required|string|max:30',
            'tel' => 'required|string|max:40',
            'topic' => 'required|string|max:60',
            'info' => 'required|string|max:700',
            'age'=>'required|numeric|max:99',
            'national'=>'string|max:15|nullable',
            'look'=>'string|max:8|nullable',
            'shape'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'hobby'=>'string|max:25|nullable',
            'price'=>'string|max:15|nullable',
            'period'=>'string|max:8|nullable',
            'img0'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:10000|nullable'
                      
        ]);

        $uname=auth()->user()->username;

        $status = new Status;
        $status_uname=Status::where('uname', '=', $uname)->first();
        
            // user found


        $baoyang = new Baoyang;
        if ($baoyang_uname===null) {
            $baoyang->user_id = auth()->user()->id;
            //$baoyangs -> setTable(Auth::user()->ucountry.'_baoyangs_tbl');
            $baoyang->ucountry = auth()->user()->ucountry;
            $baoyang->city = $request->input('city');
            $baoyang->uname = $uname;
            $baoyang->tel = $request->input('tel');
            $baoyang->email = auth()->user()->email;
            $baoyang->topic = $request->input('topic');
            $baoyang->info = $request->input('info');
            $baoyang->age = $request->input('age');
            $baoyang->national = $request->input('national');
            $baoyang->look = $request->input('look');
            $baoyang->shape = $request->input('shape');
            $baoyang->height = $request->input('height');
            $baoyang->hobby = $request->input('hobby');
            $baoyang->price = $request->input('price');
            $baoyang->period = $request->input('period');
          
            //  Handle File Upload
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
                    $img[$i]=Image::make($photo)->resize(null,300)->save(public_path().'/storage/img_name/'.$fileNameToStore[$i]);
                    // Upload Image
                    //$path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $baoyang->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $baoyang->img0=$fileNameToStore;
            }

          
            $baoyang->save();


            //store data to status tbl
            if ($status_uname===null) {
            
                $status->user_id = auth()->user()->id;
                $status->uname = $uname;
                $status->utype = auth()->user()->utype;
                $status->ucountry = auth()->user()->ucountry;
                $status->verified= 0;

                $status->status= 'free';
                $status->expire_at = date('Y-m-d', strtotime(' + 4months'));
                $status->last_update=date("Y-m-d");
                $status->save();
            }


            //email to baoyangs


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.baoyangsReg',$uname));


       
        return redirect('/baoyang')->with('success', '上传成功!');
        }else{
            return redirect('/baoyang')->with('error', '你的资料已上传过了。如须更改，请按修改按钮!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        $baoyang= Baoyang::find($id);
        
        if(auth()->user()->id!=$baoyang->user_id){
            //need to confirm if '/posts'
            return redirect('/baoyangs')->with('error','unathorized page');
        }
        
        return view('baoyangs.baoyang_edit')->with('baoyang',$baoyang);
        
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
            'city' => 'required|string|max:30',
            'tel' => 'required|string|max:40',
            'topic' => 'required|string|max:60',
            'info' => 'required|string|max:700',
            'age'=>'required|numeric|max:99',
            'national'=>'string|max:15|nullable',
            'look'=>'string|max:8|nullable',
            'shape'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'hobby'=>'string|max:25|nullable',
            'price'=>'string|max:15|nullable',
            'period'=>'string|max:8|nullable',
            'img0'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:10000|nullable'
                      
        ]);

        $uname=auth()->user()->username;
        // user found
        $baoyang= Baoyang::find($id);
        
        if ($baoyang->uname==$uname) {
            //$baoyang->user_id = auth()->user()->id;
            //$baoyangs -> setTable(Auth::user()->ucountry.'_baoyangs_tbl');
            $baoyang->ucountry = auth()->user()->ucountry;
            $baoyang->city = $request->input('city');
            $baoyang->uname = $uname;
            $baoyang->tel = $request->input('tel');
            $baoyang->email = auth()->user()->email;
            $baoyang->topic = $request->input('topic');
            $baoyang->info = $request->input('info');
            $baoyang->age = $request->input('age');
            $baoyang->national = $request->input('national');
            $baoyang->look = $request->input('look');
            $baoyang->shape = $request->input('shape');
            $baoyang->height = $request->input('height');
            $baoyang->hobby = $request->input('hobby');
            $baoyang->price = $request->input('price');
            $baoyang->period = $request->input('period');
          
            //  Handle File Upload
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
                    $img[$i]=Image::make($photo)->resize(null,300)->save(public_path().'/storage/img_name/'.$fileNameToStore[$i]);
                    // Upload Image
                    //$path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $baoyang->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $baoyang->img0=$fileNameToStore;
            }

          
            $baoyang->save();


            //store data to status tbl
            


            //email to baoyangs


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.baoyangsReg',$uname));


       
        return redirect('/more')->with('success', '上传成功!');
        }else{
            return redirect('/more')->with('error', '你的资料已上传过了。如须更改，请按修改按钮!');
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
        $post= Baoyang::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/more')->with('error','you are unathorized！');
        }
        $post->delete();
        return redirect('/more')->with('success', '你的资料已成功删除！');
    }
}
