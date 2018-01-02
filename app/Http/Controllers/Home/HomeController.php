<?php

namespace App\Http\Controllers\Home;

use App\Model\Question;
use App\Model\Topic;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * 显示首页
     *
     * @return questions问题对象；topics话题列表；
     */
    public function index(Request $request)
    {
        //    	dd($request);
        //搜索
	    $input = $request->input('keyword') ? $request->input('keyword') : '';
        //	    dd($input);
	    $questions = Question::where('title','like','%'.$input.'%')->latest('support')->Paginate(10);
        $topics = Topic::get();
	    return view('home.home', compact('questions', 'topics'));
    }

}
