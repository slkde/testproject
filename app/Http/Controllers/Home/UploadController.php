<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;

class UploadController extends Controller
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
    public function upload(Request $request)
    {
        //
        // return 123;
        $file = $request->file('file');
        $photo_check = \Validator::make([ 'image'=>$file ], ['image' => 'image']);
        if($photo_check->fails()){
            return [
                'success' => false,
                'errors'   => $photo_check->getMessageBag()->toArray()
            ];
        }
        
        // dd($file);
        $uppath = 'uploads/post/' . date('Ym') .'/' ;
        $ext = $file->getClientOriginalExtension();
        $name = \Auth::user()->id . date('YmdHis'). '.' . $ext;
        $file->move($uppath, $name);
        Image::make($uppath.$name)->fit(300)->save();
        return $uppath . $name;
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
