<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Answer;
use App\Model\Question;
class AnswerController extends Controller
{
	public function del($id)
    {
		$res = Answer::where('id',$id)->delete();
		if ($res > 0) {
					return redirect('admin/answer/') -> with('msg', '删除成功'); 
			   }else{
				   return back() -> with('msg', '修改失败');
			   }
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$where = [];
        $db = Answer::with('user');
		if($request->has('answer_content')){
            $answer_content = $request->input('answer_content');
            $where['answer_content'] = $answer_content;
            $db->where('answer_content','like',"%{$answer_content}%");
        }
		$data = $db->paginate(3); 
		//$data = $this->findSubTree($datas,0,0);
		/* dd($data); */
        return view('admin.answer.list',compact('data','where'));
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
        $answer = Answer::findOrFail($id);
		$user = Answer::with('user');
		$answer_question = Answer::with('answer_question');
		return view('admin.answer.show', compact('answer','user','answer_question'));
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //取出回复的提问id，以便跳转
		$qid = Answer::find($id)['question_id'];
		//dd($qid);
		$res = Answer::where('id', $id)->delete();
		if ($res > 0) {
					return redirect('admin/question/'.$qid) -> with('msg', '删除成功'); 
			   }else{
				   return back() -> with('msg', '修改失败');
			   }
    }
	
	
}





