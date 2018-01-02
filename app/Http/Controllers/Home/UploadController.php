<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;

class UploadController extends Controller
{
    /**
     * AJAX上传图片
     *
     * @param  
     * @return 返回图片路径
     */
    public function upload(Request $request)
    {
        //
        // 表单提交的图片
        $file = $request->file('file');
        //验证上传类型
        $photo_check = \Validator::make([ 'image'=>$file ], ['image' => 'image']);
        if($photo_check->fails()){
            return [
                'success' => false,
                'errors'   => $photo_check->getMessageBag()->toArray()
            ];
        }
        
        // 上传路径
        $uppath = 'uploads/post/' . date('Ym') .'/' ;
        //活动原扩展名
        $ext = $file->getClientOriginalExtension();
        //拼接文件名
        $name = \Auth::user()->id . date('YmdHis'). '.' . $ext;
        //移动上传文件
        $file->move($uppath, $name);
        //调整图片大小
        Image::make($uppath.$name)->fit(200)->save();
        //返回路径
        return $uppath . $name;
    }

}
