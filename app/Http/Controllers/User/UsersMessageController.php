<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\Message;

class UsersMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userid = \Auth::user()->id;
        // dd($userid);
        // $messages = Message::where('to_user_id', '40');
        $messages = Message::where('to_user_id', \Auth::user()->id)->paginate(5);
        // var_dump($messages);
        // dd($messages);
        return view('users/message', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users/sendmsg');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\MessageRequest $request)
    {
        $date = [];
        User::where('nickname',$request->user_name);
        $date['to_user_id'] = User::where('nickname',$request->user_name)->first()->id;
        $date['user_id'] = \Auth::user()->id;
        Message::create(array_merge($request->except('user_name'),$date));
        return ['msg' => '发送成功'];
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
        $user = Message::select('to_user_id')->where('id', $id)->first();
        if(!$user['to_user_id'] == \Auth::user()->id){
            return '只能删除自己的站内信';
        }
        Message::where('id',$id)->delete();
        return '删除成功';
    }
}
