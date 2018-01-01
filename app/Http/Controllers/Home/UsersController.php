<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\PasswordReset;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

use Session;

class UsersController extends Controller
{


//    public function __construct()
//    // public function __construct(Markdown $markdown)
//    {
//        // $this->markdown = $markdown;
//
//        $this->middleware('auth',['only'=>['store']]);
//    }

    // public function __construct()
    // // public function __construct(Markdown $markdown)
    // {
    //     // $this->markdown = $markdown;

    //     $this->middleware('auth',['only'=>['store']]);
    // }


    /**
     * 显示注册页面
     *
     * @return 
     */
    public function register()
    {
        //
        return view('users.register');
    }

    /**
     * 显示登陆页面
     *
     * @return 
     */
    public function login()
    {
        //

        return view('users.login');
    }

    /**
     * 实现登陆
     *
     * @return 
     */
    public function signin(\App\Http\Requests\UserLoginRequest $request)
    {
        //
        // $identty = User::where('email',$request->get('email'))->get();
        // if($identty[0]->identty == 3){
        //     return redirect()->back()->withInput()->withErrors(['password'=>'账户被禁用']);
        // }
        // 验证码
        if($request->vcode != Session::get('vcode')){
            return redirect()->back()->withInput()->withErrors(['password'=>'验证码错误']);
        }
        //验证用户名和密码
        if(\Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])){
            //如果用户名为空跳到用户设置
            if(empty(\Auth::user()->username)){
                return redirect('user/set');
            }
            //跳到首页
            return redirect('/');
        }
        //验证失败，跳回
        return back()->withInput()->withErrors(['password'=>'用户验证失败']);
    }

    /**
     * 添加用户
     *
     * @param  $request 邮箱 密码
     * @return 
     */
    public function store(\App\Http\Requests\UserRegisterRequest $request)
    {
        //
        // dd($request->all());
        User::create(array_merge($request->all(),['photo'=>'/uploads/defaultAvatar.png']));
        // $data = [
        //     'token' => str_random(48),
        //     'email' => $request->email
        // ];
        // // $date['token'] = str_random(48);
        // // $date['email'] = $request->email;
        // // dd($date);
        // PasswordReset::create($data);
        // $emailTitle = '激活你的账户';
        // $emailView = 'email.register';
        //调用邮件
        $this->sendTo($request->email);
        return redirect('/user/login');
    }

    /**
     * 登出
     *
     * @param  
     * @return 
     */
    public function logout()
    {
        //
        \Auth::logout();
        return redirect('/');
    }

    /**
     * 发送邮件
     *
     * @param  $email邮箱；
     * @return \Illuminate\Http\Response
     */
    public function sendTo($email)
    {
        //
        $data = [
            'token' => str_random(48),
            'email' => $email
        ];
        PasswordReset::create($data);
        $emailTitle = '激活你的账户';
        //准备视图
        $emailView = 'email.register';
        \Mail::queue($emailView,$data,function($message) use ($data,$emailTitle){
            $message->to($data['email'])->subject($emailTitle);
        });
    }

    /**
     * 检查邮箱
     *
     * @param  $confirm_code验证token
     * @return \Illuminate\Http\Response
     */
    public function checkEmail($confirm_code)
    {
        //checkEmail
        $user = PasswordReset::where('token',$confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }
        //验证成功，更改用户状态
        User::where('email',$user->email)->update(['identty'=>'1']);
        PasswordReset::where('token', $confirm_code)->delete();
        return redirect('/');
    }

    /**
     * 输出验证码
     *
     * @param  vcode存入session
     * @return 图片
     */
    public function vcode($tmp)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 35, $font = null);
        //获取验证码的内容
        $vcode = $builder->getPhrase();

        //把内容存入session
        Session::flash('vcode', $vcode);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

}
