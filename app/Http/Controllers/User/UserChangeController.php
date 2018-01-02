<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = \Auth::user()->id;
        $user = User::find($id);
        return view('users.userchange', compact('user'));
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
        //取session,找用户
        // $id = session()->get('id');
        $id = \Auth::user()->id;
        //表单验证
        $message = [
            'nickname.required'=> '昵称必填',
            'nickname.max'=> '昵称最大长度为10',
            'nickname.alpha_num'=> '昵称只能字母或者数字',

            'password_confirmation.required'=> '密码必填',
            'password1_confirmation.max'=> '密码最大长度为10',
            'password1_confirmation.alpha_num'=> '密码只能字母或者数字',

            'password.required'=> '确认密码必填',
            'password.max'=> '密码最大长度为10',
            'password.alpha_num'=> '密码只能字母或者数字',
            'password.confirmed'=> '请确保两次输入密码一致',

            'phone.required'=> '手机号必填',
            'phone.digits'=> '手机号长度为11',
            'phone.numeric'=> '手机号码只能是数字',
            'phone.unique'=> '手机号码已经存在',

            'email.required'=> '邮箱必填',

            'job.required'=> '职业必填',
        ];
        $this->validate($request, [
            'nickname' => 'required|max:10|alpha_num',
            'password_confirmation' => 'required|max:10|alpha_num',
            'password' => 'required|max:10|alpha_num|confirmed',
            'phone' => 'required|digits:11|numeric|unique:ask_user',
            'email' => 'required',
            'job' => 'required',
        ],$message);
        //判断验证码是否正确   strcasecmp   相同为0  
        if(strcasecmp($request->input('code'), session()->get('code')) == 0)
        {
            //验证码正确，则除去表单的令牌
            $user = $request->except('_token', 'password_confirmation', 'code', 'file_upload');
            //密码加密
            $pwd = (int)$user['password'];
            $user['password'] = md5($pwd);
            //写入数据库
            $res = User::where('id', '=', $id)->update($user);
            if($res)
            {
                return back()->with('msg', '修改成功');
            }else{
                return back()->with('msg', '修改失败');
            }
        }else{
            return back()->with('msg', '验证码错误');
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
        return 'show';
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
        return 'edit';
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
        return 'update';
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
        return 'delete';
    }
}
