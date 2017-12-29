<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\PasswordReset;

class UsersController extends Controller
{

//    public function __construct()
//    // public function __construct(Markdown $markdown)
//    {
//        // $this->markdown = $markdown;
//
//        $this->middleware('auth',['only'=>['store']]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        //
        return view('users.register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        //
        return view('users.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signin(\App\Http\Requests\UserLoginRequest $request)
    {
        //
        // dd($request);
        if(\Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])){
            return redirect('/');
        }
        return back()->withInput()->with('msg','用户验证失败');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        $this->sendTo($request->email);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        //
        \Auth::logout();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
        $emailView = 'email.register';
        \Mail::queue($emailView,$data,function($message) use ($data,$emailTitle){
            $message->to($data['email'])->subject($emailTitle);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkEmail($confirm_code)
    {
        //checkEmail
        $user = PasswordReset::where('token',$confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }
        User::where('email',$user->email)->update(['identty'=>'1']);
        PasswordReset::where('token', $confirm_code)->delete();
        return redirect('/');
    }

}
