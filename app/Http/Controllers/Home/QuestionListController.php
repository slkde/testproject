<?php

namespace App\Http\Controllers\Home;

use App\Model\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        
   	// dd($questions);
        return view('question.index', ['questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\PostRequest $request)
    {
        //
        // dd(\Auth::user());
        $data = [
            'user_id' => \Auth::user()->id
        ];
        $dis = Question::create(array_merge($request->all(),$data));
        return redirect()->action('Home\QuestionListController@show',['id'=>$dis->id]);
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
        $info = Question::findOrFail($id);
        // $info->content = $this->markdown->markdown($info->content);
        
        // $info->content = $this->markdown->markdown($question->content);

        // dd($info);

        // $info = Question::with('question_answer')->where('id', $id)->get()->toArray();

        return view('question.show', compact('info'));
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
        $question = Question::findOrFail($id);
        if(\Auth::user()->id != $question->user_id){
            return back();
        }
        return view('question.edit', compact('question'));
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
        $question->update($request->all());
        return redirect()->action('Home\QuestionListController@show',['id'=>$id]);
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
