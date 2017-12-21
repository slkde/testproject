<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	public function auth()
	{
		return view('errors.auth');
	}
    /**
     * 后台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function logout()
    {
        //清空和用户相关的所有session
        session()->flush();
        return redirect('admin/login');
    }
}
