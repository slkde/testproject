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

//验证提交的表单需要
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use DB;
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
		
		   
		
		$where = [];
        $db = DB::table('ask_question');
        if($request->has('title')){
            $title = $request->input('title');
            $where['title'] = $title;
            $db->where('title','like',"%{$title}%");
        }
		if($request->has('content')){
            $content = $request->input('content');
            $where['content'] = $content;
            $db->where('content','like',"%{$content}%");
        }
		//这个作者待解决
		/* if($request->has('title')){
            $title = $request->input('title');
            $where['title'] = $title;
            $db->where('username','like',"%{$title}%");
        }  */  
		//获取提问列表数据
		/* $data = Question::get()->paginate(5);   */
        $data = $db->paginate(3); 
		/* dd($data); */
		 $arr = User::with('user')->get()->toArray();
        return view("admin.question.list", compact('data','where','arr'));
        //return view("admin.question.list", ['data'=>$data],['where'=>$where],['arr'=>$arr]);
		
        
		
	
		/* $data = $data->user->username;
		// $username = $data->user->username; 
		dd($data); */
		/* return view('admin.question.list', compact('data')); */
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
		//1、获取用户提交的数据
		$input = $request->except(htmlspecialchars_decode('_token'));
		//2.对提交表单验证
        $rule = [
            'content'=>'required|between:10,1000',
            'title' => 'required|unique:ask_question|between:10,30',
        ];
        $mess = [
            'title.required' => '提问标题不能为空',
            'title.unique' => '提问已被占用，请更换一个问题',
            'title.between' => '问题标题必须在10-30位之间',         
            'content.required' => '提问内容不能为空',
            'content.between' => '高质量的提问内容不能少于10个字',
        ];
        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/question/create')
                ->withErrors($validator)
                ->withInput();
        }
		
		$res = Question::create($input);
		if($res){
            return redirect('admin/question')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
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
		$topic = Topic::get();
		$question = Question::find($id);
        return view('admin.question.edit',compact('question', 'topic'));
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
		//1、修改了提问之后的验证
		$messages = [
            'title.required' => '提问不能为空',
            // 'title.unique' => '提问标题已存在',
            'title.between' => '提问标题要在10到30个字之间',
			'content.required' => '提问内容不能为空',
            'content.between' => '高质量的提问内容不能少于10个字',
        ];
        $this->validate($request,[
			'content'=>'required|between:10,1000',
            'title'=>'required|between:10,30',
        ], $messages);
		//2、通过$request获取要修改的值
        $input = $request->except('_token', '_method');
        //dd($input);
		//3、执行修改操作
        $question = Question::find($id);
		$res = $question->update(['title'=>$input['title'],'content'=>$input['content'],'photo'=>$input['photo']]);
		/* dd($res); */
        if($res){
           return redirect('admin/question') -> with('msg', '修改成功');
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
         $res = Question::find($id)->delete();
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
