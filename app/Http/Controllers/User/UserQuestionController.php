<?php

namespace App\Http\Controllers\User;

use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Question;
use App\Model\Answer;

class UserQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // session()->set('id',2);
        // $aa = session()->get('id');
        $id = \Auth::user()->id;
        //倒序、分页显示我的提问
        $question = Question::where('user_id',$id)->orderBy('created_at','desc')->paginate(1);
//        dd($question);
        return view('users.userquestion',compact('question'));
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
        //根据id确定问题
        $question = Question::find($id);
        //查找问题下对应的所有回复
        $user = Answer::where('question_id', '=', $id)->paginate(3);
//        dd($user);
        return view('users.userquestion_info', compact('question','user'));
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

        $res1 = Answer::where('question_id','=',$id)->delete();
        $res = Question::where('id', '=', $id)->delete();
        if($res)
        {
            $data = ['status'=>1, 'msg'=>'删除成功'];
        }else{
            $data = ['status'=>0, 'msg'=>'删除失败'];
        }
        return $data;
    }
}
