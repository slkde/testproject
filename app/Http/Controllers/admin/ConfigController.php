<?php

namespace App\Http\Controllers\admin;

use App\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use DB;

class ConfigController extends Controller
{
    /**
     * 这个方法的作用   批量修改配置项内容
     * @author   xxxx
     * @date     2017-12-19  9:14
     * 
     * @param Request $request 接收表单提交的内容
     * @param Request $request 接收表单提交的内容
     *
     * @return 如果修改成功重定向到配置项列表页，如果修改失败返回到原修改页面
     */

    //将网站配置表中的配置数据写入配置文件，后期直接从配置文件中取网站配置

    public function putFile()
    {
//
//        向配置文件中写入内容
//        Config::put('webconfig.a','aaaaaa');
//        从配置文件中读取配置项内容
//        Config::get('webconfig.a');
//        config('webconfig.a');

        //return 111;
        //1.获取要写入的数据

       $conf =  Config::orderBy('order','asc')->lists('content','name')->toArray();
       //dd($conf);
        $c = '<?php return '.var_export($conf,true).';';


//        2.将数据写入文件

        file_put_contents(config_path().'/webconfig.php',$c);
    }
    
    /**
     * 这个方法的作用   批量修改配置项内容
     * @author   xxxx
     * @date     2017-12-19  9:14
     * 
     * @param Request $request 接收表单提交的内容
     * @param Request $request 接收表单提交的内容
     *
     * @return 如果修改成功重定向到配置项列表页，如果修改失败返回到原修改页面
     */
    public function changeContent(Request $request)
    {
//        1.获取表单提交的数据
        $input = $request->all();
//        dd($input);


        $res = $this->tijiao($input);
        //执行成功了
        $this->putFile();
        if($res){
            return redirect('admin/config');
        }else{
            return back();
        }
//        dd($res);


//        3.根据修改是否成功，跳转到对应的路由
//        return redirect('admin/config');

    }


    public function tijiao($input)
    {
        try {
            // Transaction
            $exception = DB::transaction(function() use($input){

                foreach($input['id'] as $k=>$v){
                    //$v是每次要修改的记录的ID
                    $conf = Config::find($v);

                    //执行修改操作
                    $conf->update(['content'=>$input['content'][$k]]);
                }


            });

            if(is_null($exception)) {
                return true;
            } else {

                throw new Exception;
            }

        }
        catch(Exception $e) {
            return false;
        }
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //        获取网站配置数据
        // $confs = Config::get();
        // return view('admin.config.list',compact('confs'));
         
         
//        获取网站配置数据
        $confs = Config::orderBy('order','asc')->get();
       
        //对获取到的网站配置数据中的网站内容进行格式化
        foreach ($confs as $k=>$v){
            
            //判断此项配置的类型
            switch ($v->type){

                case 'input':
                    $v->content = '<input type="text" class="lg" name="content[]" value="'.$v->content.'">';

                    break;
                case 'textarea':

                    $v->content = '<textarea type="text" class="lg" name="content[]">'.$v->content.'</textarea>';
                    break;
                case 'radio':

                   $str = '';
                   $arr = explode(',',$v->value);

                   foreach ($arr as $m=>$n){
                      $a =  explode('|',$n);

                       if($n[0] == $v->content){
                           $str.= ' <input type="radio" name="content[]" checked value="'.$a[0].'">'.$a[1];
                       }else{
                           $str.= ' <input type="radio" name="content[]"  value="'.$a[0].'">'.$a[1];
                       }
                   }
                    $v->content = $str;
                    break;
                case 'img':

                    $v->content = '<input name="content[]" type="hidden" value="'.$v->content.'"/><img style="width:100px" name="content[]"  src="'.$v->content.'">';
                    break;
            }
        }

        return view('admin.config.list',compact('confs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.config.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取用户提交的数据
        $input = $request->except('_token');
    // dd($input);
        $res = Config::create($input);

        if($res){
            //如果网址配置项添加到数据库成功，同步到web_config配置文件
            $this->putFile();
            return redirect('admin/config');
        }else{
            return back();
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
        // 通过传过来的id获取要修改的记录
        $conf = Config::find($id);
        // dd($conf);
        return view('admin.config.edit',compact('conf'));
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
        // return 111;
        //
        //通过$request获取要修改的值
        $input = $request->except('_token', '_method');
        // dd($input);
        foreach($input as $k=>$v){
            if(empty($input[$k])){
                unset($input[$k]);
            }
        }
        
        //获取网站配置内容
        // $confs = Config::orderBy('order','asc')->get();
        // dd($confs);
        //对获取到的网站配置数据中的网站内容进行格式化
        // foreach ($confs as $k => $v) {
        //     if($k)
        // }

        //执行修改操作
        $conf = Config::find($id);
        $res = $conf->update($input);
        // dd($res);
        $this->putFile();
        if($res){
            return redirect('admin/config') -> with('msg', '修改成功');
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
        //删除配置项内容
        $res = Config::find($id)->delete();
    }
}
