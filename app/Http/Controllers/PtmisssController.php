<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Ptmiss;
use App\Status;
use Mail;
use App\Mail\EmailClass;


class PtmisssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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


            $ptmiss = new Ptmiss;
            $ptmiss->user_id = auth()->user()->id;
            //$ptmisss -> setTable(Auth::user()->ucountry.'_ptmisss_tbl');
            $ptmiss->city = $request->input('city');
            $ptmiss->uname = $uname;
            $ptmiss->tel = $request->input('tel');
            $ptmiss->addr = $request->input('addr');
            $ptmiss->venue = $request->has('venue');
            $ptmiss->intro = $request->input('intro');
            $ptmiss->age = $request->input('age');
            $ptmiss->national = $request->input('national');
            $ptmiss->lan = $request->input('lan');
            $ptmiss->lan_des= $request->input('lan_des');
            $ptmiss->price = $request->input('price');
            $ptmiss->price_out = $request->input('price_out');
            $ptmiss->price_note= $request->input('price_note');
            $ptmiss->service_des = $request->input('service_des');
            $ptmiss->serv_start = $request->input('serv_start');
            $ptmiss->serv_end = $request->input('serv_end');
            $ptmiss->msg = $request->input('msg');
            
            




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
                    $ptmiss->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $ptmiss->img0=$fileNameToStore;
            }

          
            $ptmiss->save();


            //store data to status tbl

            
            $status->user_id = auth()->user()->id;
            $status->uname = $uname;
            $status->utype = auth()->user()->utype;
            $status->ucountry = auth()->user()->ucountry;
            $status->verified= 0;

            $status->status= 'free';
            $status->expire_at = date('Y-m-d', strtotime(' + 2months'));
            $status->last_update=date("Y-m-d");
            $status->save();



            //email to ptmisss


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.ptmisssReg',$uname));


       
        return redirect('/ptmiss')->with('success', '上传成功!');
        }else{
            return redirect('/ptmiss')->with('error', '你的资料已上传过了!');
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
        //
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
        //
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
