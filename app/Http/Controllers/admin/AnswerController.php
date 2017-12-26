<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Answer;
use App\Model\Question;
class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = Answer::get();
		//$data = $this->findSubTree($datas,0,0);
		/* dd($data); */
        return view('admin.answer.list',compact('data'));
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
	
	
    /**递归获取子孙栏目
     * @param $cates
     */
    protected function findSubTree($cates,$id=0,$lev=1){
        $subtree = [];//子孙数组
        foreach ($cates as $v) {
            if($v->pid==$id){
                $v->lev = $lev;
                $subtree[] = $v;
                $subtree = array_merge($subtree,$this->findSubTree($cates,$v->id,$lev+1));
            }
        }
        return $subtree;
    }
}
