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

        $this->middleware('auth',['only'=>['store','edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        return 123;;
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
		$data = Answer::where('question_id', $id)->orderBy('created_at', 'desc')->Paginate(5);
        return view('answer.show', compact('info', 'data'));
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
        if(empty(\Auth::user()->nickname)){
            return redirect('/user/set');
        }
        if(empty(\Auth::user()->username)){
            return redirect('/user/set');
        }
        $ans = Answer::findOrFail($id);
        if(\Auth::user()->id != $ans->user_id){
            return '只能删自己的回复';
        }
        $ans->delete();
        return 1;
    }
}
