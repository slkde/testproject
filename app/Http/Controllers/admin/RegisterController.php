<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller
{
    //忘记密码
	public function forget()
	{
		return view('admin.register.forget');
	}
	
	//发送找回密码的邮箱
	public function doForget(Request $request)
	{
		//1、接收表单提交的数据
		$email = $request['email'];
		//dd($email);
		//2、根据邮箱查找用户
		$user = User::where('email', $email)->first();
		//dd($user);
		 if($user){
		Mail::send('admin.email.forget',['user' => $user],function ($m)use ($user){
			$m->to($user->email,$user->username)->subject('重置密码！');
		});
			return redirect('admin/login')->with("errors","重置密码申请成功，去邮箱查看");
		 }else{
			 return back()->with("errors","请输入有效的邮箱");
		 }
	}
	//一个重置密码界面
	public function reset(Request $request)
	{
		//1.根据id获取当前重置密码的用户
		$uid = $request['uid'];
		$user = User::find($uid);
		//dd($user);
		//dd($request['identty']);
		//2、验证链接的有效性，根据传过来的identty跟数据库中查到的当前记录的identty对比
		if($request['identty'] != 1){
			return '您的链接是无效的链接，请您登录邮箱激活邮件！';
		}
		$email = $request['email'];
		return view('admin.email.reset', compact('email', 'uid'));
	}
	
	//确认修改密码的操作
	public function doReset(Request $request)
	{
		//1、获取表单提交的数据(要重置的密码的用户id，要重置的密码)
		$data = $request->except('_token');
		//dd($data);
		//2、验证密码和确认密码是否一致，表单验证
		$messages = [
			'password_confirmation.alpha_num' => '密码只能是数字和字母',
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在4-18位之间',
            'password_confirmation.between' => '密码必须在4-18位之间',
            'password.alpha_num' => '密码只能是数字和字母',
            'password_confirmation.same' => '密码需要相同，请您确认',
            
        ];
        $this->validate($request,[
            'password'=>'required|alpha_num|between:4,18',
            'password_confirmation'=>'alpha_num|between:4,18|same:password'
        ], $messages);
		$pass = Crypt::encrypt($request['password']);
		//3、修改数据库
		$uid = $request['uid'];
		$user = User::find($uid);
		$res = $user->update(['password'=>$pass]);
		if($res){
			return redirect('admin/login')->with('errors', '修改密码成功');
		}else{
			return back()->with('errors', '密码修改失败，请重试');
		}
		
	}
}
























