<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Baoyang;

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
            'name' => 'required',
            'info' => 'required'
            //'img_name'=>'image|nullable'
            //'image|mimes:jpeg,bmp,png|size:2000'
        ]);
        
         // Handle File Upload
         
         if($request->hasFile('filename')){
            
            foreach ($request->file('filename') as $photo){
                // Get filename with the extension
                $filenameWithExt = $photo->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $photo->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $photo->storeAs('public/img_name', $fileNameToStore);
                //dd($path);
                
            }
        } else {
            $fileNameToStore = 'no-user.jpg';
        }
        $post = new Baoyang;
        
        $post->city = $request->input('city');
        $post->name = $request->input('name');
        $post->tel = $request->input('tel');
        $post->img= $fileNameToStore[0];
        $post->info = $request->input('info');
         //give 3 months free using?
        $post->expire_at = date('Y-m-d', strtotime(' + 3months'));
        $post->user_id = auth()->user()->id;
        $post->save();
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
        
        
        $baoyang= Baoyang::find($id);
        
        if(auth()->user()->id!=$baoyang->user_id){
            //need to confirm if '/posts'
            return redirect('/misss')->with('error','unathorized page');
        }
        
        return view('posts.baoyang_edit')->with('baoyang',$baoyang);
        
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
