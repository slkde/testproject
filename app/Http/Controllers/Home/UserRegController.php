<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;
use Mail;

use Illuminate\Support\Facades\Validator;

class UserRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user/reg');
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
        if(!$user_reg['password'] == $user_reg['repass']){
            // return redirect('/')->with('msg', '两次密码输入不一致');
            return '两次密码输入不一致';
        }
        if(User::where('email', '=', $user_reg['email'])->first()){
            return '邮箱已被使用';
        }

        $rule = [
            'email'=>'required|email',
            'password'=>'required|between:6,18'
        ];

        $msg =[
            'email.required'=>'必须输入邮箱地址',
            'email.email'=>'必须输入一个邮箱',
            'password.required'=>'必须输入密码',
            'username.between'=>'密码长度为6到16位',
        ];
        $this->validate($request, $rule, $msg);

        // $validator = Validator::make($user_reg, $rule,$msg);
        // //如果验证失败
        // if ($validator->fails()) {
        //     return redirect('reg')
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $user_reg = $request->except('_token','repass','vcode');
        if(User::create($user_reg)){
            return '注册成功';
        }else{
            return '注册失败';
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

    public function email()
    {


        Mail::raw('这里填写邮件的内容',function ($message){
             // 发件人（你自己的邮箱和名称）
            $message->from('114595028@qq.com', 'laravel');
            // 收件人的邮箱地址
            $message->to('114595028@qq.com');
            // 邮件主题
            $message->subject('测试');
        });

        // $data = ['email'=>$email,];
        // Mail::send('activemail', $data, function($message) use($data)
        // {
        //     $message->to($data['email'])->subject('欢迎注册我们的网站，请激活您的账号！');
        // });
    }
}
