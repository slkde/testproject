<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Question;

class LikeController extends Controller
{


    /**
     * 点赞功能实现
     *
     * @return null;
     */
    public function like($id)
    {
        //
        Question::where('id',$id)->increment('support');
        return '点赞成功';
    }



}
