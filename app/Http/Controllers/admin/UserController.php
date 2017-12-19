<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
//验证提交的表单需要
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $db = DB::table('ask_user');
        if($request->has('username')){
            $name = $request->input('username');
            $where['username'] = $name;
            $db->where('username','like',"%{$name}%");
        }
        if($request->has('sex')){
            $sex = $request->input('sex');
            $where['sex'] = $sex;
            $db->where('sex',"{$sex}");
        }

        $user = $db->paginate(3);
        return view("admin.user.list", ['user'=>$user], ['where'=>$where]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.user.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1、获取用户提交的数据
        $input = $request->except('_token');
//        dd($input);
        //2.对提交表单验证
        $rule = [
            'username'=>'unique:ask_user|required|between:4,18|alpha_dash',
            'sex' => 'required',
            'identty' => 'required',
            'password'=>'required|alpha_num|between:4,18',
            //'password_confirmation'=>'alpha_num|between:4,18'
        ];
        $mess = [
            'username.required' => '用户名不能为空',
            'username.unique' => '用户名已被占用，请更换一个用户名',
            'username.between' => '用户名必须在4-18位之间',
            'username.alpha_dash' => '用户名只能由数字、字母或下划线组成',
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在4-18位之间',
            'password.alpha_num' => '密码可以是字母和数字的组合',
//            'password.confirmed' => '密码需要相同，请您确认',
            'sex.required' => '性别不能为空哦',
            'identty.required' => '权限不能为空哦',
        ];
        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/user/create')
                ->withErrors($validator)
                ->withInput();
        }
//        dd(11111);
        //3.添加到数据库
        $user = new User();
        $user->username = $input['username'];
        $user->password = Crypt::encrypt($input['password']);
        $user->sex = $input['sex'];
        $user->identty = $input['identty'];
        $res = $user->save();
        //4.如果添加成功，跳转到列表页；失败，跳转回添加页面
        if($res){
            return redirect('admin/user')->with('msg', '添加成功');
        }else{
            return back()->with('msg', '添加失败');
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
        $user = User::find($id);
        //对密码解密
        $user['password'] = Crypt::decrypt($user['password']);
//        dd($user);
        return view('admin.user.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        //把密码解密后传入页面
        $user['password'] = Crypt::decrypt($user['password']);
//        dd($user);
        return view('admin.user.edit',compact('user'));
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
        //通过$request获取要修改的值
        $input = $request->except('_token', '_method');

//        dd($input);
        //2.对提交表单验证
        $rule = [
            'username'=>'required|between:4,18|alpha_dash',
            'identty' => 'required',
            'password'=>'required|alpha_num|between:4,18',
            //'password_confirmation'=>'alpha_num|between:4,18'
        ];
        $mess = [
            'username.required' => '用户名不能为空',
            // 'username.unique' => '用户名已被占用，请更换一个用户名',
            'username.between' => '用户名必须在4-18位之间',
            'username.alpha_dash' => '用户名只能由数字、字母或下划线组成',
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在4-18位之间',
            'password.alpha_num' => '密码可以是字母和数字的组合',
        //            'password.confirmed' => '密码需要相同，请您确认',
            'identty.required' => '权限不能为空哦',
        ];
        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return redirect("admin/user/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }
        //执行修改操作
        $user = User::find($id);
        $res = $user->update(['username'=>$input['username'],'password'=>Crypt::encrypt($input['password']),'identty'=>$input['identty']]);
        if($res){
            return redirect('admin/user') -> with('msg', '修改成功');
        }else{
            return back() -> with('msg', '修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = User::find($id)->delete();
        if($res){
            $data = [
                'status' => 0,
                'msg' => '删除成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败',
            ];
        }
        //返回json格式的数据
        return $data;
    }
}
