<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Answer;
use App\Model\Question;
use App\Model\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
//验证提交的表单需要
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
	//给用户授予角色的页面
	public function auth($id)
	{
		//1、根据id获取当前用户
		$user = User::find($id);
		//2、获取所有的角色
		$roles = Role::all();
		//3、当前用户已经授予的角色
		$own_roles = DB::table('ask_user_role')->where('user_id', $id)->get();
		//4、声明一个变量，存放已经授予的角色
		$own = [];
		foreach($own_roles as $v){
			$own[] = $v->role_id;
		}
		return view('admin.user.auth', compact('user', 'roles', 'own'));
	}
	
	//处理授权操作
	public function doAuth(Request $request)
	{
		//1.获取表单提交数据
		$input = $request->except('_token');
		//dd($input);
		if(isset($input['role_id'])){
		 DB::beginTransaction();
        try{
            //先删除掉已经授予的权限
            DB::table('ask_user_role')->where('user_id',$input['id'])->delete();
            //        2 向角色权限表中添加授权记录
            foreach($input['role_id'] as $v){
                DB::table('ask_user_role')->insert(['user_id'=>$input['id'],'role_id'=>$v]);
            }
            DB::commit();
            return redirect('admin/user')->with('msg', '授权成功');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
		}else{
            DB::table('ask_user_role')->where('role_id',$input['id'])->delete();
            return back();
        }
	}
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
		 $list = User::get()->toArray();
		/*$uname = $request->uname;
		if($uname){
			if(in_array($uname,$input)){
				$data = 'y';
			}else{
				$data = 'n';
			}
		} */
		
        return view("admin.user.add",compact('list'));
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
            'password_confirmation'=>'alpha_num|between:4,18|same:password'
        ];
        $mess = [
            'username.required' => '用户名不能为空',
            'username.unique' => '用户名已被占用，请更换一个用户名',
            'username.between' => '用户名必须在4-18位之间',
            'username.alpha_dash' => '用户名只能由数字、字母或下划线组成',
            'password_confirmation.alpha_num' => '密码只能是数字和字母',
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在4-18位之间',
            'password_confirmation.between' => '密码必须在4-18位之间',
            'password.alpha_num' => '密码只能是数字和字母',
            'password_confirmation.same' => '密码需要相同，请您确认',
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
        // $user = new User();
        // $user->username = $input['username'];
        // $user->password = Crypt::encrypt($input['password']);
        // $user->sex = $input['sex'];
        // $user->identty = $input['identty'];
        // $res = $user->save();
        // dd($input);
        $res = User::create(array_merge($input,['photo'=>'/uploads/defaultAvatar.png']));

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
        // $user['password'] = Crypt::decrypt($user['password']);
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

        //$user['password'] = Crypt::decrypt($user['password']);

        // $user['password'] = Crypt::decrypt($user['password']);

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

		foreach($input as $k => $v){
			if(empty($input[$k])){
				unset($input[$k]);
			}
		}
		if(!empty($input['passwork'])){
		$input['passwork'] = \Hash::make($input['password']);
		}
//        dd($input);
        //2.对提交表单验证
        $rule = [
            //'username'=>'required|between:4,18|alpha_dash',
            //'identty' => 'required',
            'password'=>'alpha_num|between:4,18',
            'email'=>'email|unique:ask_user,email',
            'password_confirmation'=>'alpha_num|between:4,18|same:password',
        ];
        $mess = [
           // 'username.required' => '用户名不能为空',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱不符合格式',
            'email.unique' => '邮箱已存在',
            // 'username.unique' => '用户名已被占用，请更换一个用户名',
           // 'username.between' => '用户名必须在4-18位之间',
            //'username.alpha_dash' => '用户名只能由数字、字母或下划线组成',
            'password.required' => '密码不能为空',
            'password.between' => '密码必须在4-18位之间',
            'password_confirmation.between' => '确认密码必须在4-18位之间',
            'password.alpha_num' => '密码可以是字母和数字的组合',
			'password_confirmation.alpha_num' => '密码只能是数字和字母',
			'password_confirmation.same' => '密码需要相同，请您确认',
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

        $res = User::where('id',$id)->update($input);
        // $user = User::find($id);
        // $res = $user->update(['username'=>$input['username'],'password'=>Crypt::encrypt($input['password']),'identty'=>$input['identty'],'email'=>$input['email']]);
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
		//得到问题的id
		$res1 = Answer::where( 'user_id', '=',$id)->delete();
		$res2 = Question::where('user_id', '=', $id)->delete();		
        $res = User::find($id)->delete();		
        if($res && $res1 && $res2){
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
