<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Massage;
use App\Status;
//for email
use Mail;
use App\Mail\regEmailClass;


class MassagesController extends Controller
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
        if($user_type=='massage'){
            return view('massages/massage_create')->with('ucountry',$ucountry)->with('uname',$uname);
                    
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
            'uname' => 'required|string|unique|max:30',
            'city' => 'required|string|max:30',
            'tel' => 'required|string|max:40',
            'intro' => 'required|string|max:700',
            'addr1'=>'required|string|max:60',
            'addr2'=>'required|string|max:60',
            'age'=>'required|numeric|max:99',
            'national'=>'string|max:15|nullable',
            'shape'=>'string|max:8|nullable',
            'skin'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'chest'=>'numeric|max:100|nullable',
            'waist'=>'numeric|max:100|nullable',
            'weight'=>'numeric|max:300|nullable',
            'lan1'=>'string|max:15|nullable',
            'lan2'=>'string|max:15|nullable',
            'lan_des'=>'string|max:45|nullable',
            'price30'=>'numeric|max:99999|nullable',
            'price1h'=>'numeric|max:99999|nullable',
            'price_out'=>'numeric|max:9999999|nullable',
            'price_note'=>'string|max:45|nullable',
            'service_des'=>'string|max:100|nullable',
            'special_serv'=>'string|max:100|nullable',
            'western_serv'=>'in:1|nullable',
            'img0'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img3'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img4'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img5'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img6'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img7'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img8'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img9'=>'image|mimes:jpeg,bmp,png|size:2000|nullable'
            
        ]);

        $uname=$request->input('uname');

        $status = new Status;
        $status_uname=Status::where('uname', '=', $uname)->first();
        $massage = new Massage;
        $massage_uname=Massage::where('uname', '=', $uname)->first();
        
            // user found

        if($massage_uname===null){
            
            //$massage -> setTable(Auth::user()->ucountry.'_massage_tbl');
            $massage->city = $request->input('city');
            $massage->uname = $uname;
            $massage->tel = $request->input('tel');
            $massage->addr1 = $request->input('addr1');
            $massage->addr2 = $request->input('addr2');

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
                    $massage->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $massage->img0=$fileNameToStore;
            }

            // Create Post

            //$massage->img_name = $fileNameToStore[0];
            //if($i>0)
            //need to modify, there is error if only 1 file to upload
            //$img1= $fileNameToStore[1];


            //$massage->img1=$img1;


            //$massage->user_id = $request->input('user_id');
            $massage->intro = $request->input('intro');
            $massage->age = $request->input('age');
            $massage->national = $request->input('national');
            $massage->shape= $request->input('shape');
            $massage->skin = $request->input('skin');
            $massage->height = $request->input('height');
            $massage->chest= $request->input('chest');
            $massage->waist = $request->input('waist');
            $massage->weight= $request->input('weight');
            $massage->lan1 = $request->input('lan1');
            $massage->lan2 = $request->input('lan2');
            $massage->lan_des= $request->input('lan_des');
            $massage->price30 = $request->input('price30');
            $massage->price1h = $request->input('price1h');
            $massage->price_out = $request->input('price_out');
            $massage->price_note= $request->input('price_note');
            $massage->service_des = $request->input('service_des');
            $massage->special_serv = $request->input('special_serv');
            $massage->western_serv = $request->has('western_serv');



           
            //$massage->type = $request->type;

            //give 2 months free using
            //$massage->expire_at = date('Y-m-d', strtotime(' + 2months'));
            //$post->cover_image = $fileNameToStore;
            $massage->user_id = auth()->user()->id;

            $massage->save();
        
            if($status_uname===null){

                //store data to status tbl

                //$massage -> setTable(Auth::user()->ucountry.'_massage_tbl');
                $status->user_id = auth()->user()->id;
                $status->uname = $uname;
                $status->utype = auth()->user()->utype;
                $status->ucountry = auth()->user()->ucountry;
                $status->verified= 0;

                $status->status= 'free';
                $expire=date('Y-m-d', strtotime(' + 2months'));
                $status->expire_at = $expire;
                $status->discount_to = date('Y-m-d', strtotime($expire.'+ 28days'));
                $status->last_update=date("Y-m-d");
                $status->save();

            }

            //email to massage


            Mail::to(Auth::user()->email)->send(new regEmailClass('massageReg',$uname));


       //////
        return redirect('/massage')->with('success', '上传成功！');
        }else{
            return redirect('/massage')->with('error', '你的资料已经传过了,你可以在账户管理中进行修改。');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function show($user_id)
    {
        $massage=new Massage;
        $massage -> setTable('爱尔兰_massage_tbl');
        $post= $massage->find($user_id);
       //$data=
       return view('massages.massage_show')->with('post',$post);
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

        $massage=new Massage;

        $massage -> setTable('爱尔兰_massage_tbl');
        $massagep= $massage->find($id);
       // $massage= massage::find($id);
       // if(auth()->user()->id!=$massage->user_id){
        //dd($massagep->uname);
        if(auth()->user()->id!=$massagep->user_id){
            //need to confirm if '/posts'
            return redirect('/')->with('error','unathorized');
        }

        return view('massages.massage_edit')->with('massage',$massagep)->with('ucountry',$ucountry);

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
            'uname' => 'required|string|unique|max:30',
            'city' => 'required|string|max:30',
            'tel' => 'required|string|max:40',
            'intro' => 'required|string|max:700',
            'addr1'=>'required|string|max:60',
            'addr2'=>'required|string|max:60',
            'age'=>'required|numeric|max:99',
            'national'=>'string|max:15|nullable',
            'shape'=>'string|max:8|nullable',
            'skin'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'chest'=>'numeric|max:100|nullable',
            'waist'=>'numeric|max:100|nullable',
            'weight'=>'numeric|max:300|nullable',
            'lan1'=>'string|max:15|nullable',
            'lan2'=>'string|max:15|nullable',
            'lan_des'=>'string|max:60|nullable',
            'price30'=>'numeric|max:99999|nullable',
            'price1h'=>'numeric|max:99999|nullable',
            'price_out'=>'numeric|max:9999999|nullable',
            'price_note'=>'string|max:45|nullable',
            'service_des'=>'string|max:100|nullable',
            'special_serv'=>'string|max:100|nullable',
            'western_serv'=>'in:1|nullable',
            'img0'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img3'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img4'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img5'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img6'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img7'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img8'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img9'=>'image|mimes:jpeg,bmp,png|size:2000|nullable'
        ]);

        $uname=auth()->user()->username;
        
        // $status = Status::find($id);
        // $status_uname=Status::where('uname', '=', $uname)->first();
        
            // user found

        $massage = Massage::find($id);
        //$massage -> setTable(Auth::user()->ucountry.'_massage_tbl');
        if ($massage->uname!=null) {

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
                    $massage->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            }
           

            $massage->city = $request->input('city');
            //$massage->uname = $uname;
            $massage->tel = $request->input('tel');
            $massage->addr1 = $request->input('addr1');
            $massage->addr2 = $request->input('addr2');
            $massage->intro = $request->input('intro');
            $massage->age = $request->input('age');
            $massage->national = $request->input('national');
            $massage->shape= $request->input('shape');
            $massage->skin = $request->input('skin');
            $massage->height = $request->input('height');
            $massage->chest= $request->input('chest');
            $massage->waist = $request->input('waist');
            $massage->weight= $request->input('weight');
            $massage->lan1 = $request->input('lan1');
            $massage->lan2 = $request->input('lan2');
            $massage->lan_des= $request->input('lan_des');
            $massage->price30 = $request->input('price30');
            $massage->price1h = $request->input('price1h');
            $massage->price_out = $request->input('price_out');
            $massage->price_note= $request->input('price_note');
            $massage->service_des = $request->input('service_des');
            $massage->special_serv = $request->input('special_serv');
            $massage->western_serv = $request->has('western_serv');
            //$massage->user_id = auth()->user()->id;

            $massage->save();


            //store data to status tbl

            //$massage -> setTable(Auth::user()->ucountry.'_massage_tbl');
            /*
            $status->user_id = Auth::user()->id;
            $status->uname = $uname;
            $status->verified= 0;
            $status->last_update=date("Y-m-d");
            $status->save();
            */
        return redirect('/massages/'.$massage->id)->with('success', '资料修改成功！');
        }else{
            return redirect('/massage')->with('fail', '你已上传过了！');
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
        $post= Massage::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/massage')->with('error','you are unathorized！');
        }
        $post->delete();
        return redirect('/massage')->with('success', '你的资料已成功删除！');
    }
}
