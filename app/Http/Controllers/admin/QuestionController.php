<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Topic;
use App\Model\User;
use App\Model\Question;
//引用阿里云的服务配置
use App\Services\OSS;
//引用七牛云的服务配置
use Illuminate\Support\Facades\Storage;
class QuestionController extends Controller
{
    //文件上传的方法
    public function upload(Request $request){
        //获取文件上传对象
        $input = $request->file('file_upload');
        /* dd($input); */
		//获取上传文件的后缀名
		$ext = $input->getClientOriginalExtension();
		//生成新文件名
		$fileName = md5(time().rand(1000,9999).uniqid()).'.'.$ext;
		//将文件上传对象移动到指定的位置,上传到阿里云或者七牛云时千万不要移动！！！！！！！！！这是个大坑！！
		//$input->move(public_path().'/upload/', $fileName);
		
		       //上传到七牛云
//        参数一 上到到七牛云后的路径和文件名
//        参数二 要上传的文件
       $res = Storage::disk('qiniu')->writeStream($fileName, fopen($input->getRealPath(), 'r'));
		//七牛云上这样写
		//return $fileName;
		 //阿里云上传到oss  参数1：新文件的名字 参数2：原文件的路径
		//$res = OSS::upload('upload/'.$fileName,$input->getRealPath());
		//阿里云上这样写
		//return 'upload/'.$fileName;
        /* dd($res); */
		
		return $fileName;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取提问列表数据
		$data = Question::get();
		
		/* Question::where('user_id', $user_id)->select(User::get('username'));
		/* //根据usr_id得到username
	 	$username = User::where('id', $id)->select('username');
		dd($username); */  
		return view('admin.question.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topic = Topic::get();
        // dd($topic);
        return view('admin.question.add', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
