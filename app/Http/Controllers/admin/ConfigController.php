<?php

namespace App\Http\Controllers\admin;

use App\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use DB;
use Image;

class ConfigController extends Controller
{
    /**
     * 将网站配置写入配置文件
     * @param name ; photo; content;
     *
     * @return array
     */


    public function putFile()
    {
       $conf =  Config::orderBy('order','asc')->lists('content','name')->toArray();
       $imgconf =  Config::orderBy('order','asc')->select('content','name')->get();
       $config = [];
       foreach($imgconf as $k => $v){
        //    dd($v);
        if($v['name'] == 'photo'){
            $config['photo'][] = $v['content'];
        }
       }
      //    $img = $imgconf->toArray();
        unset($conf['photo']);
       $conf = array_merge($config,$conf);
    //    dd($config);
    
        $c = '<?php return '.var_export($conf,true).';';


//        2.将数据写入文件

        file_put_contents(config_path().'/webconfig.php',$c);
    }
    
    /**
     * 
     * 
     * @param 
     *
     * @return 
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
         
         
        //获取网站配置数据
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

                    $v->content = '<input name="content[]" type="hidden" value="'.$v->content.'"/><img style="width:100px" name="content[]"  src="'. url($v->content) .'">';
                    break;
            }
        }

        return view('admin.config.list',compact('confs'));

    }

    /**
     * 显示配置文件添加页面
     *
     * @return 
     */
    public function create()
    {
        //
        return view('admin.config.add');

    }

    /**
     * 添加网站配置
     *
     * @param  name;title;photo;value;
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取用户提交的数据
        $input = $request->except('_token');
    // dd($input);
        if(!empty($input['photo'])){
            // dd($input);
            $input['content'] = $this->upimg($input['photo']);
            unset($input['photo']);
        }
        foreach($input as $k => $v){
            if(empty($input[$k])){
                unset($input[$k]);
            }
        }
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
     * 显示配置编辑页面
     *
     * @param  $id是当前配置的ID
     * @return array
     */
    public function edit($id)
    {
        // 通过传过来的id获取要修改的记录
        $conf = Config::find($id);
        // dd($conf);
        return view('admin.config.edit',compact('conf'));
    }

    /**
     * 更新配置文件
     *
     * @param  $id是当前配置的id
     * @return BOOL
     */
    public function update(Request $request, $id)
    {
        // return 111;
        //
        //通过$request获取要修改的值
        $input = $request->except('_token', '_method');
        if(!empty($input['photo'])){
            // dd($input);
            $res = Config::find($id);
            if($res->type == 'img'){
                unlink($res->content);
            }
            $input['content'] = $this->upimg($input['photo']);
            unset($input['photo']);
        }
        
        foreach($input as $k=>$v){
            if(empty($input[$k])){
                unset($input[$k]);
            }
        }
        

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
     * 删除配置
     *
     * @param  $id要删除的配置id
     * @return 
     */
    public function destroy($id)
    {
        //删除配置项内容
        $res = Config::find($id);
        if($res->type == 'img'){
            unlink($res->content);
        }
        $res->delete();
    }


    /**
     * 上传图片
     *
     * @param  $file表单提交的文件
     * @return 图片路径
     */
    public function upimg($file){
        //验证上传类型
        $photo_check = \Validator::make([ 'image'=>$file ], ['image' => 'image']);
        if($photo_check->fails()){
            return [
                'success' => false,
                'errors'   => $photo_check->getMessageBag()->toArray()
            ];
        }
        
        // 上传路径
        $uppath = 'uploads/config/' ;
        //活动原扩展名
        $ext = $file->getClientOriginalExtension();
        //拼接文件名
        $name = \Auth::user()->id . date('YmdHis'). '.' . $ext;
        //移动上传文件
        $file->move($uppath, $name);
        //调整图片大小
        // Image::make($uppath.$name)->fit(200)->save();
        //返回路径
        
        return $uppath . $name;
    }
}
