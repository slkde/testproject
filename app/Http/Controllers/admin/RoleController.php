<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\Permission;
use App\Model\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
/* use Illuminate\Support\Facades\DB; */
use DB;
class RoleController extends Controller
{
	//给角色授权的页面
	public function auth($id)
	{
		//1、根据id获取当前角色
		$role = Role::find($id);
		//2、获取所有的权限
		$permissions = Permission::all();
		//3、当前角色已经授予的权限
		$own_pers = DB::table('ask_role_permission')->where('role_id', $id)->get();
		//4、声明一个变量，存放已经授予的权限
		$own = [];
		foreach($own_pers as $v){
			$own[] = $v->permission_id;
		}
		return view('admin.role.auth', compact('role','permissions','own'));
	}
	//处理授权操作
	public function doAuth(Request $request)
	{
		// 1 获取表单提交数据
        $input = $request->except('_token');
        if(isset($input['permission_id'])){
            //        dd($input);
            DB::beginTransaction();
            try{
                //先删除掉已经授予的权限
                DB::table('ask_role_permission')->where('role_id',$input['role_id'])->delete();
                //        2 向角色权限表中添加授权记录
                foreach($input['permission_id'] as $v){
                    DB::table('ask_role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$v]);
                }
                DB::commit();

                return redirect('admin/role')->with('msg', '授权成功');


            }catch(Exception $e){
                DB::rollBack();
                return redirect()->back()
                    ->withErrors(['error' => $e->getMessage()]);
            }
        }else{
            DB::table('ask_role_permission')->where('role_id',$input['role_id'])->delete();
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
		//存搜索条件
		$where = [];
		$db = DB::table('ask_role');
		if($request->has('name')){
			$name = $request->input('name');
			$where['name'] = $name;
			$db->where('name', 'like', "%{$name}%");
		}
		if($request->has('description')){
			$description = $request->input('description');
			$where['description'] = $description;
			$db->where('description', 'like', "%{$description}%");
		}
		
		//获取所有的角色 
		$roles = $db->paginate(2);
        return view('admin.role.list', compact('roles', 'where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1、接受表单提交的数据
		$input = Input::except('_token');
		/* dd($input); */
		//2.对提交的数据进行验证
		$messages = [
            'name.required' => '角色名不能为空',
            'name.unique' => '角色名已存在',
            'name.between' => '角色名要在2到10个字之间',
            'description.between' => '角色描述要在0到50个字之间',
        ];
        $this->validate($request,[
            'name'=>'unique:ask_role|required|between:2,10',
            'description'=>'between:0,50',
        ], $messages);
		//3、提交到数据库
		$res = Role::create($input);
		if($res){
			return redirect('admin/role')->with('msg', '添加成功');
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
		$role = Role::find($id);
        return view('admin.role.edit', compact('role'));
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
		//验证修改的字段
        $messages = [
			'name.required' => '角色名不能为空',
            'name.unique' => '角色名已存在',
            'name.between' => '角色名要在2到10个字之间',
            'description.between' => '角色名要在2到10个字之间',		
		];
		$this->validate($request,[
			'name'=>'unique:ask_role|required|between:2,10',
			'description'=>'between:0,50',
		],$messages);
		//通过$request获取要修改的值
		$input = $request->except('_token','_method');
		//执行修改操作
		$role = Role::find($id);
		$res = $role->update(['name'=>$input['name'],'description'=>$input['description']]);
		if($res){
			return redirect('admin/role')->with('msg', '修改成功');
		}else{
			return back()->with('msg', '修改失败');
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
		//删除此角色
        $res1 = Role::where('id', $id)->delete();
		//删除角色和权限表中所有的关于此id的角色id
		$res2 = DB::table('ask_role_permission')->where('role_id','=',$id)->delete();
		if($res1 && $res2){
			return redirect('admin/role') -> with('msg', '删除成功');
		}else{
			return back() -> with('msg', '修改失败');
		}
    }
}














