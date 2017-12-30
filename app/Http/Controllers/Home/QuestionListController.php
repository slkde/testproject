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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::latest('created_at')->Paginate(6);
        $support = Question::latest('support')->Paginate(5);
        
   	// dd($questions);
        return view('question.index', compact('questions', 'support'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(empty(\Auth::user()->nickname)){
            return redirect('/user/set');
        }
        $topic = Topic::get();
        return view('question.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\PostRequest $request)
    // public function store(Request $request)
    {
        //
        // dd(\Auth::user());
        // return $request->input('title');
        $data = [
            'user_id' => \Auth::user()->id
        ];
        // dd($request->all());
        $dis = Question::create(array_merge($request->all(),$data));
        return $dis->id;
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
        $questions = Question::where('topic_id',$id)->latest('created_at')->Paginate(6);
        // dd($questions);
        // $questions = Question::findOrFail($id);
        // $info->content = $this->markdown->markdown($info->content);
        
        // $info->content = $this->markdown->markdown($question->content);

        // dd($info);

        // $info = Question::with('question_answer')->where('id', $id)->get()->toArray();

        return view('question.show', compact('questions'));
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
        $topic = Topic::get();
        $question = Question::findOrFail($id);
        if(\Auth::user()->id != $question->user_id){
            return back();
        }
        return view('question.edit', compact('question','topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\PostRequest $request, $id)
    {
        //
        $question = Question::findOrFail($id);
        if(\Auth::user()->id != $question->user_id){
            return $id;
        }
        $question->update($request->all());
        return $id;
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
