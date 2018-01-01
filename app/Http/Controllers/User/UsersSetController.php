<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;

use App\Model\PasswordReset;

use App\Http\Controllers\Home\UsersController;

class UsersSetController extends Controller
{
    public function __construct()
    // public function __construct(Markdown $markdown)
    {
        // $this->markdown = $markdown;

        $this->middleware('auth',['only'=>['index','store','sendTo']]);
    }
    /**
     * 显示用户设置页面
     *
     * @return 
     */
    public function index()
    {
        //
        $userinfo = User::find(\Auth::user()->id);
        return view('users/set',compact('userinfo'));
    }


    /**
     * 修改个人资料
     *
     * @param  password;username;nickname;phone
     * @return 
     */
    public function store(\App\Http\Requests\SetRequest $request)
    {
        //
        $input = $request->except('_token','password_confirmation');
        foreach($input as $k=>$v){
            if(empty($input[$k])){
                unset($input[$k]);
            }
            
        }
        if(!empty($input['password'])){
            $input['password'] = \Hash::make($input['password']);
        }
        if(!empty($input['email'])){
            $data = [
                'token' => str_random(48),
                'email' => $request->email
            ];
            PasswordReset::create($data);
            $emailTitle = '激活你的账户';
            $emailView = 'email.register';
            $this->sendTo($emailTitle,$emailView,$data);
        }

        // dd($input);
        $user = User::where('id',\Auth::user()->id)->update($input);
        return ['msg'=>'修改成功'];
    }

    /**
     * 发送邮件
     *
     * @param  $emailtitle邮件标题；$emailview邮件视图；$data用户邮箱地址
     * @return 
     */
    public function sendTo($emailTitle,$emailView,$data)
    {
        //
        \Mail::queue($emailView,$data,function($message) use ($data,$emailTitle){
            $message->to($data['email'])->subject($emailTitle);
        });
    }
}
