<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Topic;
use App\Model\Question;
class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //多条件带分页搜索
        $topic = Topic::orderBy('id', 'asc')
            ->where(function($query) use($request){
                $name = $request->input('keywords1');
                if(!empty($name)){
                    $query->where('name', 'like', '%'.$name.'%');
                }
            })->paginate($request->input('num', 5));

        return view('admin.topic.list', ['topic'=>$topic, 'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topic.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => '话题名不能为空',
            'unique' => '话题名已存在',
            'between' => '话题名要在2到10个字之间',
        ];
        $this->validate($request,[
            'name'=>'unique:ask_topic|required|between:2,10',
        ], $messages);
        $data = $request->except('_token');
        $res = Topic::insertGetId($data);
        if($res > 0){
            return redirect('admin/topic')->with('msg', '添加成功');
        }else{
            return back()->with('msg', '添加失败');
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
        $topic = Topic::find($id);
        return view('admin.topic.edit',compact('topic'));
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
        $messages = [
            'required' => '话题名不能为空',
            'unique' => '话题名已存在',
            'between' => '话题名要在2到10个字之间',
        ];
        $this->validate($request,[
            'name'=>'unique:ask_topic|required|between:2,10',
        ], $messages);
          //通过$request获取要修改的值
          $input = $request->except('_token', '_method');
                //  dd($input);
                  //执行修改操作
                  $topic = Topic::find($id);
                  $res = $topic->update(['name'=>$input['name']]);
                  if($res){
                      return redirect('admin/topic') -> with('msg', '修改成功');
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
		$getTopic_id = Question::find($id)['topic_id'];
		//dd($id);
		//判断，如果话题的id等于问题表中的topic_id就说明这个话题下面有提问，不能删除
		if($getTopic_id == $id){
			return back()->with('msg','该话题下有提问，不能删除该话题');
		}else{
			 $res = Topic::where('id', $id)->delete();
			   if ($res > 0) {
					return redirect('admin/topic') -> with('msg', '删除成功'); 
			   }else{
				   return back() -> with('msg', '修改失败');
			   }
		}
		
      
    }
    
}
