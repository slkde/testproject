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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('users/forget');
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
        $data = [
        'token' => str_random(48),
        'email' => $request->input('email')
        ];
        PasswordReset::create($data);
        $emailTitle = '激活你的账户';
        $emailView = 'email.forget';
        \Mail::queue($emailView,$data,function($message) use ($data,$emailTitle){
            $message->to($data['email'])->subject($emailTitle);
        });
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        //
        $email = PasswordReset::where('token',$token)->get();
        if(empty($email)){
            return redirect('/');
        }
        return view('users.change',compact('token'));
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
    public function update(Request $request, $token)
    {
        //
        $userEmail = $request->input('email');
        $password = \Hash::make($request->input('password'));
        $forget = PasswordReset::where('token',$token)->first();
        if(empty($forget)){
            return 123;
        }
        if($forget->email != $userEmail){
            return 111;
        }
        User::where('email',$forget->email)->update(['password'=>$password]);
        PasswordReset::where('token', $token)->delete();
        return redirect('/');
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
