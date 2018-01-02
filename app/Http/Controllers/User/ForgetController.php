<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\PasswordReset;
use App\Model\User;

class ForgetController extends Controller
{
    /**
     * 忘记密码页面
     *
     * @return 
     */
    public function index()
    {
        //
        return view('users/forget');
    }


    /**
     * 找回账户
     *
     * @param  $email用户email
     * @return 
     */
    public function store(\App\Http\Requests\Forget $request)
    {
        //保存token用来验证邮箱
        $data = [
        'token' => str_random(48),
        'email' => $request->input('email')
        ];
        PasswordReset::create($data);
        $emailTitle = '激活你的账户';
        //忘记密码邮件
        $emailView = 'email.forget';
        \Mail::queue($emailView,$data,function($message) use ($data,$emailTitle){
            $message->to($data['email'])->subject($emailTitle);
        });
        return redirect()->back();
    }

    /**
     * 验证邮箱
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        //验证邮箱和token
        $email = PasswordReset::where('token',$token)->get();
        if(empty($email)){
            return redirect('/');
        }
        return view('users.change',compact('token'));
    }



    /**
     * 更新密码
     *
     * @param  token；email;password
     * @param
     * @return 
     */
    public function update(\App\Http\Requests\ChangeRequest $request, $token)
    {
        //
        $userEmail = $request->input('email');
        $password = \Hash::make($request->input('password'));
        $forget = PasswordReset::where('token',$token)->first();
        if(empty($forget)){
            return back()->withinput()->withErrors(['msg'=>'验证错误']);
        }
        if($forget->email != $userEmail){
            return back()->withinput()->withErrors(['msg'=>'请填写正确的邮箱']);
        }
        User::where('email',$forget->email)->update(['password'=>$password]);
        PasswordReset::where('token', $token)->delete();
        return redirect('/');
    }

}
