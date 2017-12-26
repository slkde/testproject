<?php

namespace App\Http\Middleware;
use App\Model\User;
use Closure;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//1、获取用户当前请求的路由对应的控制器
		$route = \Route::currentRouteName();
		//dd($route);
		//2、获取当前用户的权限列表
		$id = session('user')->id;
		$user = User::find($id);
		//获取当前用户的角色
		$roles = $user->roles;
		//dd($roles);
		$arr = [];
		foreach ($roles as $k=>$v){
			$pers = $v->permissions;
			foreach($pers as $m=>$n){
				$arr[] = $n->path;
			}
		}
		
		$arr = array_unique($arr);
		if(in_array($route, $arr)){
			return $next($request);
		}else{
			return redirect('admin/auth');
		}
        
    }
}
























