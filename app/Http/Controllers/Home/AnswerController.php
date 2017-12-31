<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Answer;

use App\Model\Question;

class AnswerController extends Controller
{
    public function __construct()
    // public function __construct(Markdown $markdown)
    {
        // $this->markdown = $markdown;
        //中间件验证登陆用户才可以访问
        $this->middleware('auth',['only'=>['store','edit','update']]);
    }

    /**
     * 添加回答
     *
     * @param  nickname 昵称;username用户名;
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\AnswerRequest $request)
    {
        //
        // dd(\Auth::user()->id);
        if(empty(\Auth::user()->nickname)){
            return redirect('/user/set');
        }
        if(empty(\Auth::user()->username)){
            return redirect('/user/set');
        }
        Answer::create(array_merge($request->all(),['user_id' => \Auth::user()->id]));
        return 1;
    }

    /**
     * 查看问题回复
     *
     * @param  $id问题id;
     * @return info问题对象；data最新回复；hot最热问题
     */
    public function show($id)
    {
        //
        $info = Question::findOrFail($id);
        // $info->content = $this->markdown->markdown($info->content);
        
        // $info->content = $this->markdown->markdown($question->content);

        // dd($info);

        // $info = Question::with('question_answer')->where('id', $id)->get()->toArray();
        $hot = Question::orderBy('support','desc')->Paginate(5);
		$data = Answer::where('question_id', $id)->orderBy('created_at', 'desc')->Paginate(5);
        return view('answer.show', compact('info', 'data','hot'));
    }

    /**
     * 删除回答
     *
     * @param  int  $id回答id；
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //判断昵称是否为空
        if(empty(\Auth::user()->nickname)){
            //跳到个人设置
            return redirect('/user/set');
        }
        //判断用户名是否为空
        if(empty(\Auth::user()->username)){
            return redirect('/user/set');
        }
        //判断删除回复是否为自己的回复
        $ans = Answer::findOrFail($id);
        if(\Auth::user()->id != $ans->user_id){
            return '只能删自己的回复';
        }
        $ans->delete();
        return 1;
    }
}
