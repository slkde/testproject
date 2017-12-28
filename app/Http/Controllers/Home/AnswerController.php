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
        Answer::create(array_merge($request->all(),['user_id' => \Auth::user()->id]));
        return redirect('/');
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

        return view('answer.show', compact('info'));
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
