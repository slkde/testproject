<?php

namespace App\Http\Controllers\Home;

use App\Model\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Topic;

// use App\Markdown\Markdown;


class QuestionListController extends Controller
{

    // protected $markdown;

    public function __construct()
    // public function __construct(Markdown $markdown)
    {
        // $this->markdown = $markdown;
        $this->middleware('auth',['only'=>['create','store','edit','update']]);
    }

    /**
     * 显示问题列表
     * @param 
     * @return questions问题列表；support最热
     */
    public function index()
    {
        $questions = Question::latest('created_at')->Paginate(6);
        $support = Question::latest('support')->Paginate(5);
        
   	// dd($questions);
        return view('question.index', compact('questions', 'support'));
    }

    /**
     * 显示添加问题页面
     *
     * @return topic话题列表
     */
    public function create()
    {
        //验证是否用昵称
        if(\Auth::user()->identty < 1){
            return redirect('/user/set')->withErrors(['error'=>'必须验证邮箱才能提问']);
        }
        //验证是否用昵称
        if(empty(\Auth::user()->nickname)){
            return redirect('/user/set');
        }
        //验证是否有用户名
        if(empty(\Auth::user()->username)){
            return redirect('/user/set');
        }
        //取话题列表
        $topic = Topic::get();
        return view('question.create', compact('topic'));
    }

    /**
     * 添加问题到数据库
     *
     * @param  $request->title标题；$request->content内容;
     * @return $dis->id 成功ID
     */
    public function store(\App\Http\Requests\PostRequest $request)
    // public function store(Request $request)
    {
        //
        // dd(\Auth::user());
        // return $request->input('title');
        //是否有昵称
        if(empty(\Auth::user()->nickname)){
            return redirect('/user/set');
        }
        //是否有用户名
        if(empty(\Auth::user()->username)){
            return redirect('/user/set');
        }
        
        // dd($request->all());
        //获取表单提交数据，添加用户ID
        $question = $request->all();
        $question['user_id'] = \Auth::user()->id;
        $question['title'] = strip_tags($question['title']);
        // dd($question);
        //添加到数据库
        $dis = Question::create($question);
        return $dis->id;
    }

    /**
     * 话题下问题
     *
     * @param  int  $id话题id; 
     * @return questions话题对象
     */
    public function show($id)
    {
        //
        $questions = Question::where('topic_id',$id)->latest('created_at')->Paginate(6);
        $support = Question::latest('support')->Paginate(5);
        $hot = Question::orderBy('support','desc')->Paginate(5);
        // dd($questions);
        // $questions = Question::findOrFail($id);
        // $info->content = $this->markdown->markdown($info->content);
        
        // $info->content = $this->markdown->markdown($question->content);

        // dd($info);

        // $info = Question::with('question_answer')->where('id', $id)->get()->toArray();

        return view('question.show', compact('questions','support','hot'));
    }

    /**
     * 显示编辑问题
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取话题
        $topic = Topic::get();
        //获取问题
        $question = Question::findOrFail($id);
        //如果问题user_id不是当前ID，返回
        if(\Auth::user()->id != $question->user_id){
            return back();
        }
        return view('question.edit', compact('question','topic'));
    }

    /**
     * 修改问题
     *
     * @param  
     * @param  int  $id当前问题ID
     * @return 成功返回当前问题，失败也返回当前问题
     */
    public function update(\App\Http\Requests\PostRequest $request, $id)
    {
        //获取当前问题对象
        $question = Question::findOrFail($id);
        //判断是不是自己的问题；
        if(\Auth::user()->id != $question->user_id){
            return $id;
        }
        $res = $request->all();
        $res['title'] = strip_tags($res['title']);
        //对象中更新问题
        $question->update($res);
        return $id;
    }

}
