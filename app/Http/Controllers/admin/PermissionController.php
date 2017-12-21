<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\Permission;
use App\Model\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //存搜索条件
		$where = [];
		$db = DB::table('ask_permission');
		if($request->has('name')){
			$name = $request->input('name');
			$where['name'] = $name;
			$db->where('name', 'like', "%{$name}%");
		}
		if($request->has('path')){
			$path = $request->input('path');
			$where['path'] = $path;
			$db->where('path', 'like', "%{$path}%");
		}
		
		//获取所有的权限 
		$permissions = $db->paginate(2);
        return view('admin.permission.list', compact('permissions', 'where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.add');
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
            'name.required' => '权限名不能为空',
            'name.unique' => '权限名已存在',
            'name.between' => '权限名要在2到10个字之间',
            'path.between' => '权限路径要在2到50个字之间',
            'path.required' => '权限路径不能为空',
        ];
        $this->validate($request,[
            'name'=>'unique:ask_permission|required|between:2,10',
            'path'=>'between:2,50|required',
        ], $messages);
		//3、提交到数据库
		$res = Permission::create($input);
		if($res){
			return redirect('admin/permission')->with('msg', '添加成功');
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
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
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
            'name.required' => '权限名不能为空',
            'name.unique' => '权限名已存在',
            'name.between' => '权限名要在2到10个字之间',
            'path.between' => '权限路径要在2到50个字之间',
            'path.required' => '权限路径不能为空',
        ];
        $this->validate($request,[
            'name'=>'unique:ask_permission|required|between:2,10',
            'path'=>'between:2,50|required',
        ], $messages);
		//通过$request获取要修改的值
		$input = $request->except('_token','_method');
		//执行修改操作
		$permission = Permission::find($id);
		$res = $permission->update(['name'=>$input['name'],'path'=>$input['path']]);
		if($res){
			return redirect('admin/permission')->with('msg', '修改成功');
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
        //删除此权限
        $res1 = Permission::where('id', $id)->delete();
		//删除角色和权限表中所有的关于此id的权限id
		$res2 = DB::table('ask_role_permission')->where('permission_id','=',$id)->delete();
		if($res1 && $res2){
			return redirect('admin/permission') -> with('msg', '删除成功');
		}else{
			return back() -> with('msg', '修改失败');
		}
    }
}
