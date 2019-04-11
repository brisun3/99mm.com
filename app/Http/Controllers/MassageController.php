<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Massage;
class MassageController extends Controller
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
        //
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
            'name' => 'required',
            'intro' => 'required'
            //'img_name'=>'image|nullable'
            //'image|mimes:jpeg,bmp,png|size:2000'
        ]);
        
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
                $i++;
            }
        } else {
            $fileNameToStore = 'no-user.jpg';
        }
           // Create Post
        $massage = new Massage;
        $massage->country = Auth::user()->ucountry;
        $massage->city = $request->input('city');
        $massage->name = $request->input('name');
        $massage->tel = $request->input('tel');
        $massage->addr1 = $request->input('addr1');
        $massage->addr2 = $request->input('addr2');
        $massage->img_name = $fileNameToStore[0];
        if($i>0)
        //need to modify, there is error if only 1 file to upload
        $massage->img1= $fileNameToStore[1];
        $massage->user_id = $request->input('user_id');
        $massage->intro = $request->input('intro');
        $massage->price = $request->input('price');
        $massage->price_des = $request->input('price_des');
        
        $massage->status = 'free';
        //give 2 months free using
        $massage->expire_at = date('Y-m-d', strtotime(' + 2months'));
        //$post->cover_image = $fileNameToStore;
        $massage->user_id = auth()->user()->id;
        $massage->save();
        return redirect('/posts')->with('success', 'Post Created');
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
