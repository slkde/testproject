<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;

use Image;
use Validator;

class UsersCenterController extends Controller
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
    public function photo()
    {
        //
        return view('users.photo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uPhoto(Request $request)
    {
        //
        // dd($request);
        $file = $request->file('photo');
        $photo_check = Validator::make([ 'image'=>$file ], ['image' => 'image']);
        if($photo_check->fails()){
            return [
                'success' => false,
                'errors'   => $photo_check->getMessageBag()->toArray()
            ];
        }
        
        // dd($file);
        $uppath = 'uploads/' . date('Ym') .'/' ;
        $ext = $file->getClientOriginalExtension();
        $name = \Auth::user()->id . date('YmdHis'). '.' . $ext;
        $file->move($uppath, $name);
        Image::make($uppath.$name)->fit(150)->save();
        $user = User::find(\Auth::user()->id);
        $oldfile = $user->photo;
        $user->photo = $uppath . $name;
        if(!$user->save()){
            return [
            'success' => false,
            'errors' => ['头像更新失败']
        ];
        }
        if(is_file($oldfile) && is_file($uppath . $name))
        unlink($oldfile);

        return [
            'success' => true,
            'photo' => asset($uppath . $name)
        ];
        // return redirect('user/photo');
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
