<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;

class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user/login')->with('msg','请登录');
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
        $user_reg = $request->except('_token');
        
        
        $rule = [
            'email'=>'required|email',
            'pass'=>'required|between:6,18'
        ];
        
        $msg =[
            'email.required'=>'必须输入邮箱地址',
            'email.email'=>'必须输入一个邮箱',
            'pass.required'=>'必须输入密码',
            'pass.between'=>'密码长度为6到16位',
        ];
        $this->validate($request, $rule, $msg);

        if(User::where('email', '=', $user_reg['email'])->where('password', '=', $user_reg['pass'])->first()){
            return redirect('user/center');
        }else{
            return view('user.login')->with('msg','邮箱或者密码错误');
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
